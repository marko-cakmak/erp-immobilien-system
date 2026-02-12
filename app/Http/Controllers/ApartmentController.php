<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use App\Models\ApartmentStatus;
use App\Services\Apartment\ApartmentService;
use App\Services\InterestedPerson\InterestedPersonService;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function __construct(
        protected ApartmentService $apartmentService,
        protected InterestedPersonService $interestedPersonService
    ) {}

    public function index(Request $request)
    {
        $apartments = $this->apartmentService->search($request);
        $statuses = ApartmentStatus::all();

        return view('apartments.index', compact('apartments', 'statuses'));
    }

    public function show(Apartment $apartment)
    {
        $apartment = $this->apartmentService->getForShow($apartment);
        $apartment->load('interestedPersons');

        return view('apartments.show', [
            'apartment' => $apartment,
            'interessenten' => $apartment->interestedPersons,
        ]);
    }

    public function create()
    {
        $statuses = ApartmentStatus::all();

        return view('apartments.create', compact('statuses'));
    }

    public function edit(Apartment $apartment)
    {
        $apartment->load(['status', 'images', 'coverImage', 'interestedPersons']);
        $statuses = ApartmentStatus::all();
        $allInteressenten = $this->interestedPersonService->getActive();
        $assignedIds = $apartment->interestedPersons->pluck('id')->toArray();

        return view('apartments.edit', compact('apartment', 'statuses', 'allInteressenten', 'assignedIds'));
    }

    public function store(ApartmentRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $apartment = $this->apartmentService->create($validated);

        session()->forget('apartment_temp_images');

        return redirect()
            ->route('apartments.show', $apartment->id)
            ->with('success', 'Wohnung erfolgreich erstellt!');
    }

    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $this->apartmentService->update($apartment, $validated, $request);

        $apartment->interestedPersons()->sync($request->input('interessent_ids', []));

        return redirect()
            ->route('apartments.show', $apartment->id)
            ->with('success', 'Wohnung erfolgreich aktualisiert!');
    }

    public function destroy(Apartment $apartment)
    {
        $this->apartmentService->delete($apartment);

        return redirect()
            ->route('apartments.index')
            ->with('success', 'Wohnung erfolgreich gelöscht!');
    }
}
