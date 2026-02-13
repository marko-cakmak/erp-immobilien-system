<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    public function index(Request $request)
    {
        $tasks = $this->taskService->search($request);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $data = $this->taskService->getFormData();

        return view('tasks.create', $data);
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->create($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich erstellt.');
    }
}
