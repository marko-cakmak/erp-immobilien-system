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
            // BESICHTIGUNG
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

            // REPARATUR
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

        DB::table('task_type_assignment_role_config')->truncate();

        $now = now();

        foreach ($configs as $config) {
            DB::table('task_type_assignment_role_config')->insert([
                ...$config,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
