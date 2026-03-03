<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusTransitionAssigneeRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            ['transition_id' => 1, 'task_type_id' => 1, 'activate_role_id' => 3],
            ['transition_id' => 2, 'task_type_id' => 1, 'activate_role_id' => 2],
            ['transition_id' => 3, 'task_type_id' => 1, 'activate_role_id' => 2],
            ['transition_id' => 4, 'task_type_id' => 1, 'activate_role_id' => 3],
            ['transition_id' => 5, 'task_type_id' => 1, 'activate_role_id' => 2],
            ['transition_id' => 6, 'task_type_id' => 1, 'activate_role_id' => 2],
            ['transition_id' => 7, 'task_type_id' => 1, 'activate_role_id' => 2],
            ['transition_id' => 8, 'task_type_id' => 1, 'activate_role_id' => 2],
        ];

        foreach ($rules as $rule) {
            DB::table('task_status_transition_assignee_rules')->insert([
                ...$rule,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
