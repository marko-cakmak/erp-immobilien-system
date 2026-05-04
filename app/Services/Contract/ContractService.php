<?php

namespace App\Services\Contract;

use App\Models\Apartment;
use App\Models\ApartmentStatus;
use App\Models\Contract;
use App\Models\ContractStatus;
use App\Models\InterestedPerson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractService
{
    protected array $allowedFields = [
        'apartment_id',
        'interested_person_id',
        'contract_status_id',
        'start_date',
        'end_date',
        'notes',
    ];

    /*
    |--------------------------------------------------------------------------
    | Query / Read
    |--------------------------------------------------------------------------
    */

    public function search(Request $request)
    {
        $query = Contract::with([
            'status',
            'apartment',
            'interestedPerson',
            'creator',
        ]);

        if ($request->filled('apartment')) {
            $query->whereHas('apartment', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->apartment . '%');
            });
        }

        if ($request->filled('interested_person')) {
            $query->whereHas('interestedPerson', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->interested_person . '%')
                    ->orWhere('last_name', 'like', '%' . $request->interested_person . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('contract_status_id', $request->status);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function getForShow(Contract $contract): Contract
    {
        return $contract->load([
            'status',
            'apartment.status',
            'interestedPerson',
            'creator',
        ]);
    }

    public function getFormData(?Contract $contract = null): array
    {
        $apartmentsQuery = Apartment::where('is_active', true)
            ->whereHas('status', fn($q) => $q->where('code', 'reserved'))
            ->orderBy('title');

        if ($contract?->apartment_id) {
            $apartmentsQuery->orWhere('id', $contract->apartment_id);
        }

        return [
            'apartments' => $apartmentsQuery->get(),
            'interestedPersons' => [],
        ];
    }

    public function getErgebnisForApartment(Apartment $apartment): ?InterestedPerson
    {
        return $apartment->tasks()
            ->whereHas('type', fn($q) => $q->where('key', 'besichtigung'))
            ->whereHas('status', fn($q) => $q->where('key', 'abgeschlossen'))
            ->with('besichtigung.ergebnis')
            ->latest()
            ->first()
            ?->besichtigung
            ?->ergebnis;
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function create(array $data): Contract
    {
        return DB::transaction(function () use ($data) {

            $data = $this->filterData($data);
            $data['contract_status_id'] = ContractStatus::where('key', 'offen')->firstOrFail()->id;
            $data['created_by'] = auth()->id();

            return Contract::create($data);
        });
    }

    public function update(Contract $contract, array $data): Contract
    {
        return DB::transaction(function () use ($contract, $data) {

            $data = $this->filterData($data);
            
            $contract->update($data);

            if (isset($data['contract_status_id'])) {
                $newStatus = ContractStatus::find($data['contract_status_id']);

                if ($newStatus?->key === 'unterzeichnet' && is_null($contract->fresh()->signed_at)) {
                    $contract->update(['signed_at' => now()]);

                    $vermietetStatus = ApartmentStatus::where('code', 'rented')->firstOrFail();

                    $contract->load('apartment');
                    $contract->apartment->update([
                        'apartment_status_id' => $vermietetStatus->id,
                    ]);
                }
            }

            return $contract->refresh();
        });
    }

    public function delete(Contract $contract): void
    {
        DB::transaction(fn() => $contract->delete());
    }

    /*
    |--------------------------------------------------------------------------
    | Business Logic
    |--------------------------------------------------------------------------
    */

    public function sign(Contract $contract): Contract
    {
        return DB::transaction(function () use ($contract) {

            $signedStatus = ContractStatus::where('key', 'unterzeichnet')->firstOrFail();

            $contract->update([
                'contract_status_id' => $signedStatus->id,
                'signed_at' => now(),
            ]);

            $vermietetStatus = ApartmentStatus::where('code', 'rented')->firstOrFail();

            $contract->apartment->update([
                'apartment_status_id' => $vermietetStatus->id,
            ]);

            return $contract->refresh();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    protected function filterData(array $data): array
    {
        return array_intersect_key(
            $data,
            array_flip($this->allowedFields)
        );
    }
}
