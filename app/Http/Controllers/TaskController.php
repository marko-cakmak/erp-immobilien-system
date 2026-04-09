<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreBesichtigungRequest;
use App\Http\Requests\ChangeTaskStatusRequest;
use App\Models\Apartment;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\RepairType;
use App\Models\TaskType;
use App\Models\TaskTypeAssignmentRoleConfig;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    )
    {
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->search($request, Auth::user());

        $statuses = TaskStatus::all();

        return view('tasks.index', compact('tasks', 'statuses'));
    }

    public function create(Request $request)
    {
        $data = $this->taskService->getFormData();

        $data['repairTypes'] = RepairType::orderBy('sort_order')->get();

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
        $repairTypes = RepairType::all();

        $interessenten = $task->apartment?->interestedPersons ?? collect();

        $processingRoleId = TaskTypeAssignmentRoleConfig::where('task_type_id', $task->type_id)
            ->where('is_active_on_creation', true)
            ->value('assignment_role_id');

        $processingAssignee = $task->assignees
            ->firstWhere('assignment_role_id', $processingRoleId);

        return view('tasks.show', compact(
            'task',
            'users',
            'statuses',
            'repairTypes',
            'interessenten',
            'processingAssignee'
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

    public function storeRepair(StoreRepairRequest $request, Task $task)
    {
        $this->taskService->storeRepair(
            $task,
            array_merge($request->validated(), [
                'photos' => $request->file('photos', []),
            ])
        );

        return redirect()
            ->route('tasks.show', $task->id)
            ->withFragment('bearbeitung')
            ->with('success', 'Aufgabe wurde gespeichert.');
    }
}
