<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreBesichtigungRequest;
use App\Http\Requests\ChangeTaskStatusRequest;
use App\Models\Apartment;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    )
    {
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->search($request);

        return view('tasks.index', compact('tasks'));
    }

    public function create(Request $request)
    {
        $data = $this->taskService->getFormData();
        $data['selectedApartmentId'] = $request->input('apartment_id');
        $data['selectedApartment'] = $request->filled('apartment_id')
            ? Apartment::find($request->input('apartment_id'))
            : null;

        return view('tasks.create', $data);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->create($request->validated());

        return redirect()
            ->route('tasks.index', $task->id)
            ->with('success', 'Aufgabe wurde erfolgreich erstellt.');
    }

    public function show(Task $task)
    {
        $task = $this->taskService->findForShow($task);
        $users = $this->taskService->getAssignableUsers();
        $statuses = TaskStatus::orderBy('sort_order')->get();
        $interessenten = $task->apartment?->interestedPersons ?? collect();
        $allowedTransitions = $task->status->allowedTransitions;

        return view('tasks.show', compact(
            'task',
            'users',
            'statuses',
            'interessenten',
            'allowedTransitions'
        ));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->taskService->update($task, $request->validated());

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Aufgabe wurde aktualisiert.');
    }

    public function destroy(Task $task)
    {
        if (!auth()->user()->hasPermission('manage_aufgaben')) {
            abort(403);
        }

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich gelöscht.');
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
        $result = $this->taskService->storeBesichtigung(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('tasks.show', $task->id)
            ->withFragment('bearbeitung')
            ->with('success', 'Aufgabe wurde erfolgreich gespeichert'
                . ($result['newTaskStatus'] ? ' und Status auf "' . $result['newTaskStatus'] . '" gesetzt.' : '.'))
            ->with('info', $result['newApartmentStatus']
                ? 'Der Wohnungsstatus wurde aufgrund der Aufgabenstatusänderung automatisch auf "' . $result['newApartmentStatus'] . '" aktualisiert.'
                : null);
    }
}
