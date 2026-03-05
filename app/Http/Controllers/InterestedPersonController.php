<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterestedPersonRequest;
use App\Http\Requests\UpdateInterestedPersonRequest;
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

    public function store(StoreInterestedPersonRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $this->interestedPersonService->create($data);

        return redirect()->route('interested-persons.index')
            ->with('success', 'Interessent erfolgreich hinzugefügt!');
    }


    public function edit(InterestedPerson $interestedPerson)
    {
        return view('interested-persons.edit', ['person' => $interestedPerson]);
    }

    public function update(UpdateInterestedPersonRequest $request, InterestedPerson $interestedPerson)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $this->interestedPersonService->update($interestedPerson, $data);

        return redirect()->route('interested-persons.show', $interestedPerson)
            ->with('success', 'Interessent erfolgreich aktualisiert!');
    }

    public function destroy(InterestedPerson $interestedPerson)
    {
        $this->interestedPersonService->delete($interestedPerson);

        return redirect()
            ->route('interested-persons.index')
            ->with('success', 'Interessent erfolgreich gelöscht!');
    }

    public function ajaxSearch(Request $request)
    {
        $results = $this->interestedPersonService->searchForAjax($request);

        return response()->json($results);
    }
}
