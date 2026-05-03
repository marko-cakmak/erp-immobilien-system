<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeAssignmentRoleConfigSeeder extends Seeder
{
    public function run(): void
    {
        $taskTypes = DB::table('task_types')->pluck('id', 'key');
        $assignmentRoles = DB::table('task_assignment_roles')->pluck('id', 'key');

        $configs = [
            [
                'task_type_id' => $taskTypes['besichtigung'],
                'assignment_role_id' => $assignmentRoles['besichtigung_bearbeiter'],
                'is_active_on_creation' => true,
            ],
            [
                'task_type_id' => $taskTypes['besichtigung'],
                'assignment_role_id' => $assignmentRoles['creator'],
                'is_active_on_creation' => false,
            ],
            [
                'task_type_id' => $taskTypes['reparatur'],
                'assignment_role_id' => $assignmentRoles['reparatur_bearbeiter'],
                'is_active_on_creation' => true,
            ],
            [
                'task_type_id' => $taskTypes['reparatur'],
                'assignment_role_id' => $assignmentRoles['creator'],
                'is_active_on_creation' => false,
            ],
        ];

        $now = now();

        foreach ($configs as $config) {
            DB::table('task_type_assignment_role_config')->updateOrInsert(
                [
                    'task_type_id' => $config['task_type_id'],
                    'assignment_role_id' => $config['assignment_role_id'],
                ],
                [
                    'is_active_on_creation' => $config['is_active_on_creation'],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
