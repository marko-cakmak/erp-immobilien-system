<?php

namespace App\Http\Controllers;

use App\Models\InterestedPerson;
use App\Services\InterestedPerson\InterestedPersonService;
use Illuminate\Http\Request;

class InterestedPersonController extends Controller
{
    public function __construct(
        protected InterestedPersonService $interestedPersonService
    ) {}

    public function index(Request $request)
    {
        $persons = $this->interestedPersonService->search($request);

        return view('interested-persons.index', compact('persons'));
    }

    public function create()
    {
        return view('interested-persons.create');
    }

    public function show(InterestedPerson $interestedPerson)
    {
        $interestedPerson = $this->interestedPersonService->getForShow($interestedPerson);

        return view('interested-persons.show', ['person' => $interestedPerson]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:interested_persons,email',
            'phone' => 'required|string|max:255',
            'street_address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $this->interestedPersonService->create($validated);

        return redirect()
            ->route('interested-persons.index')
            ->with('success', 'Interessent erfolgreich hinzugefügt!');
    }

    public function edit(InterestedPerson $interestedPerson)
    {
        return view('interested-persons.edit', ['person' => $interestedPerson]);
    }

    public function update(Request $request, InterestedPerson $interestedPerson)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:interested_persons,email,' . $interestedPerson->id,
            'phone' => 'required|string|max:255',
            'street_address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $this->interestedPersonService->update($interestedPerson, $validated);

        return redirect()
            ->route('interested-persons.show', $interestedPerson->id)
            ->with('success', 'Interessent erfolgreich aktualisiert!');
    }

    public function destroy(InterestedPerson $interestedPerson)
    {
        $this->interestedPersonService->delete($interestedPerson);

        return redirect()
            ->route('interested-persons.index')
            ->with('success', 'Interessent erfolgreich gelöscht!');
    }
}
