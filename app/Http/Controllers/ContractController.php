<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\ContractStatus;
use App\Services\Contract\ContractService;
use Illuminate\Http\Request;
use App\Models\Apartment;

class ContractController extends Controller
{
    public function __construct(
        protected ContractService $contractService
    )
    {
    }

    public function index(Request $request)
    {
        $contracts = $this->contractService->search($request);
        $statuses = ContractStatus::orderBy('sort_order')->get();

        return view('contracts.index', compact('contracts', 'statuses'));
    }

    public function create()
    {
        $formData = $this->contractService->getFormData();
        $statuses = ContractStatus::orderBy('sort_order')->get();

        return view('contracts.create', compact('formData', 'statuses'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = $this->contractService->create($request->validated());

        return redirect()
            ->route('contracts.show', $contract)
            ->with('success', 'Vertrag erfolgreich erstellt.');
    }

    public function show(Contract $contract)
    {
        $contract = $this->contractService->getForShow($contract);

        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $formData = $this->contractService->getFormData($contract);
        $statuses = ContractStatus::orderBy('sort_order')->get();

        return view('contracts.edit', compact('contract', 'formData', 'statuses'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $oldContractStatusId = $contract->contract_status_id;
        $oldApartmentStatusId = $contract->apartment->apartment_status_id;

        $contract = $this->contractService->update($contract, $request->validated());

        $contractStatusChanged = $contract->contract_status_id != $oldContractStatusId;
        $apartmentStatusChanged = $contract->apartment->fresh()->apartment_status_id != $oldApartmentStatusId;

        return redirect()
            ->route('contracts.show', $contract)
            ->with('success', 'Vertrag wurde erfolgreich gespeichert'
                . ($contractStatusChanged ? ' und Status auf "' . $contract->status->name . '" gesetzt.' : '.'))
            ->with('info', $apartmentStatusChanged
                ? 'Der Wohnungsstatus wurde automatisch auf "' . $contract->apartment->fresh()->status->label . '" aktualisiert.'
                : null);
    }

    public function destroy(Contract $contract)
    {
        $this->contractService->delete($contract);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Vertrag erfolgreich gelöscht.');
    }

    public function sign(Contract $contract)
    {
        $this->contractService->sign($contract);

        return redirect()
            ->route('contracts.show', $contract)
            ->with('success', 'Vertrag erfolgreich unterzeichnet.');
    }

    public function getApartmentPersons(Apartment $apartment)
    {
        $ergebnis = $this->contractService->getErgebnisForApartment($apartment);

        return response()->json($ergebnis);
    }

    public function preview(Contract $contract)
    {
        $contract = $this->contractService->getForShow($contract);

        return view('contracts.preview', compact('contract'));
    }
}
