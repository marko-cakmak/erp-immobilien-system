<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
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

    public function show(Task $task)
    {
        $task = $this->taskService->findForShow($task);

        $users = $this->taskService->getAssignableUsers();

        $statuses = TaskStatus::orderBy('name')->get();

        $interessenten = $task->apartment?->interestedPersons ?? collect();

        return view('tasks.show', compact('task', 'users', 'statuses', 'interessenten'));
    }

    public function changeStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => ['required', 'string']
        ]);

        $this->taskService->changeStatus($task, $request->status);

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Status wurde aktualisiert.');
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

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status_id' => ['required', 'exists:task_statuses,id'],
            'user_id'   => ['required', 'exists:users,id'],
            'note'      => ['nullable', 'string'],
        ]);

        $this->taskService->update($task, $request->only('status_id', 'user_id', 'note'));

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Aufgabe wurde aktualisiert.');
    }
}
