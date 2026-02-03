<?php

namespace App\Http\Controllers;

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
}
