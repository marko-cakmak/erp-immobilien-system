<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use App\Models\ApartmentStatus;
use App\Services\Apartment\ApartmentService;

class ApartmentController extends Controller
{
    public function __construct(
        protected ApartmentService $apartmentService
    ) {}

    public function index()
    {
        $apartments = $this->apartmentService->getAll();

        return view('apartments.index', compact('apartments'));
    }

    public function show(Apartment $apartment)
    {
        $apartment = $this->apartmentService->getForShow($apartment);

        return view('apartments.show', compact('apartment'));
    }

    public function create()
    {
        $statuses = ApartmentStatus::all();

        return view('apartments.create', compact('statuses'));
    }


    public function edit(Apartment $apartment)
    {
        $apartment->load(['status', 'images', 'coverImage']);
        $statuses = ApartmentStatus::all();

        return view('apartments.edit', compact('apartment', 'statuses'));
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
