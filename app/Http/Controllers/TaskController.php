<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreBesichtigungRequest;
use App\Http\Requests\ChangeTaskStatusRequest;
use App\Models\Task;
use App\Models\TaskStatus;
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

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich erstellt.');
    }

    public function show(Task $task)
    {
        $task = $this->taskService->findForShow($task);
        $users = $this->taskService->getAssignableUsers();
        $statuses = TaskStatus::orderBy('name')->get();
        $interessenten = $task->apartment?->interestedPersons ?? collect();

        return view('tasks.show', compact(
            'task',
            'users',
            'statuses',
            'interessenten'
        ));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->taskService->update($task, $request->validated());

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Aufgabe wurde aktualisiert.');
    }

    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        $this->taskService->changeStatus(
            $task,
            $request->validated('status')
        );

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Status wurde aktualisiert.');
    }

    public function storeBesichtigung(StoreBesichtigungRequest $request, Task $task)
    {
        $this->taskService->storeBesichtigung(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Besichtigung wurde gespeichert.');
    }
}
