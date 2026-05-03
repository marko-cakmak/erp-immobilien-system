<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusTransitionAssigneeRuleSeeder extends Seeder
{
    public function run(): void
    {
        $assignmentRoles = DB::table('task_assignment_roles')->pluck('id', 'key');
        $transitions = DB::table('task_status_transitions')->get();

        $findTransitionId = function (int $fromStatusId, int $toStatusId) use ($transitions) {
            $transition = $transitions
                ->first(fn($item) => $item->from_status_id === $fromStatusId && $item->to_status_id === $toStatusId);

            if (!$transition) {
                throw new \RuntimeException("Transition {$fromStatusId} -> {$toStatusId} nije pronađen.");
            }

            return $transition->id;
        };

        $rules = [
            // BESICHTIGUNG (task_type_id = 1)
            [
                'transition_id' => $findTransitionId(1, 2),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['besichtigung_bearbeiter'],
            ],
            [
                'transition_id' => $findTransitionId(1, 3),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(1, 4),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(2, 2),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['besichtigung_bearbeiter'],
            ],
            [
                'transition_id' => $findTransitionId(2, 3),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(2, 4),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(3, 3),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(3, 4),
                'task_type_id' => 1,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],

            // REPARATUR (task_type_id = 2)
            [
                'transition_id' => $findTransitionId(1, 2),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['reparatur_bearbeiter'],
            ],
            [
                'transition_id' => $findTransitionId(1, 3),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(1, 4),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(2, 2),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['reparatur_bearbeiter'],
            ],
            [
                'transition_id' => $findTransitionId(2, 3),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(2, 4),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(3, 3),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
            [
                'transition_id' => $findTransitionId(3, 4),
                'task_type_id' => 2,
                'assignment_role_id' => $assignmentRoles['creator'],
            ],
        ];

        $now = now();

        foreach ($rules as $rule) {
            DB::table('task_status_transition_assignee_rules')->updateOrInsert(
                [
                    'transition_id' => $rule['transition_id'],
                    'task_type_id' => $rule['task_type_id'],
                ],
                [
                    'assignment_role_id' => $rule['assignment_role_id'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
