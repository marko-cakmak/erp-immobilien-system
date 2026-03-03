<?php

namespace App\Services\Task;

use App\Models\Apartment;
use App\Models\Besichtigung;
use App\Models\Task;
use App\Models\TaskAssignee;
use App\Models\TaskStatus;
use App\Models\TaskStatusTransition;
use App\Models\TaskStatusTransitionAssigneeRule;
use App\Models\TaskType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /*
    |--------------------------------------------------------------------------
    | Query / Read
    |--------------------------------------------------------------------------
    */

    public function search(Request $request)
    {
        return Task::with([
            'type',
            'status',
            'apartment',
            'activeAssignee.user'
        ])
            ->latest()
            ->paginate(15);
    }

    public function findForShow(Task $task): Task
    {
        return $task->load([
            'type',
            'status.allowedTransitions',
            'apartment.coverImage',
            'apartment.interestedPersons',
            'activeAssignee.user',
            'assignees.user',
            'besichtigung.teilnehmer',
            'besichtigung.ergebnis',
        ]);
    }

    public function getFormData(): array
    {
        $apartments = Apartment::with(['coverImage', 'interestedPersons'])
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return [
            'apartments' => $apartments,
            'types' => TaskType::orderBy('name')->get(),
            'users' => User::orderBy('name')->get(),
        ];
    }

    public function getAssignableUsers()
    {
        return User::orderBy('name')->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Standard CRUD
    |--------------------------------------------------------------------------
    */

    public function create(array $data): Task
    {
        return DB::transaction(function () use ($data) {

            $data['status_id'] = TaskStatus::where('key', 'neu')->firstOrFail()->id;
            $data['created_by'] = auth()->id();

            $task = Task::create($data);

            TaskAssignee::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'is_active' => false,
            ]);

            TaskAssignee::create([
                'task_id' => $task->id,
                'user_id' => $data['assigned_to'],
                'is_active' => true,
            ]);

            return $task;
        });
    }

    public function update(Task $task, array $data): Task
    {
        return DB::transaction(function () use ($task, $data) {

            $task->update([
                'status_id' => $data['status_id'],
                'message' => $data['note'] ?? $task->message,
            ]);

            if ($task->activeAssignee?->user_id != $data['user_id']) {

                $existingAssignee = $task->assignees()
                    ->where('user_id', $data['user_id'])
                    ->first();

                if ($existingAssignee) {
                    $task->activeAssignee->update(['is_active' => false]);
                    $existingAssignee->update(['is_active' => true]);
                } else {
                    $task->activeAssignee->update(['user_id' => $data['user_id']]);
                }
            }

            return $task->fresh();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Business Logic
    |--------------------------------------------------------------------------
    */

    public function changeStatus(Task $task, string $newStatusKey): Task
    {
        if (
            !$task->activeAssignee ||
            $task->activeAssignee->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $newStatus = TaskStatus::where('key', $newStatusKey)->firstOrFail();

        $transition = TaskStatusTransition::where('from_status_id', $task->status_id)
            ->where('to_status_id', $newStatus->id)
            ->first();

        if (!$transition) {
            abort(422, 'Statuswechsel nicht erlaubt.');
        }

        return DB::transaction(function () use ($task, $newStatus, $transition) {

            $task->update([
                'status_id' => $newStatus->id,
                'closed_at' => in_array($newStatus->key, ['abgeschlossen', 'abgebrochen'])
                    ? now()
                    : null,
            ]);

            $rule = TaskStatusTransitionAssigneeRule::where('transition_id', $transition->id)
                ->where('task_type_id', $task->type_id)
                ->first();

            if ($rule) {
                $newActiveAssignee = $task->assignees()
                    ->whereHas('user.role', function ($q) use ($rule) {
                        $q->where('roles.id', $rule->activate_role_id);
                    })
                    ->first();

                if ($newActiveAssignee) {
                    if ($task->activeAssignee->id !== $newActiveAssignee->id) {
                        $task->activeAssignee->update(['is_active' => false]);
                        $newActiveAssignee->update(['is_active' => true]);
                    }
                }
            }

            return $task->fresh();
        });
    }

    public function storeBesichtigung(Task $task, array $data): void
    {
        DB::transaction(function () use ($task, $data) {

            $besichtigung = Besichtigung::updateOrCreate(
                ['task_id' => $task->id],
                [
                    'besichtigung_at' => $data['besichtigung_at'] ?? null,
                    'result_interessent_id' => $data['result_interessent_id'] ?? null,
                    'notes' => $data['notes'] ?? null,
                ]
            );

            $besichtigung->teilnehmer()->sync($data['interessent_ids'] ?? []);

            if (!empty($data['status_id'])) {
                $newStatus = TaskStatus::findOrFail($data['status_id']);
                $this->changeStatus($task, $newStatus->key);
            }
        });
    }
}
