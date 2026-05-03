<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusTransitionSeeder extends Seeder
{
    public function run(): void
    {
        $transitions = [
            ['from_status_id' => 1, 'to_status_id' => 2],
            ['from_status_id' => 1, 'to_status_id' => 3],
            ['from_status_id' => 1, 'to_status_id' => 4],

            ['from_status_id' => 2, 'to_status_id' => 2],
            ['from_status_id' => 2, 'to_status_id' => 3],
            ['from_status_id' => 2, 'to_status_id' => 4],

            ['from_status_id' => 3, 'to_status_id' => 3],
            ['from_status_id' => 3, 'to_status_id' => 4],
        ];

        $now = now();

        foreach ($transitions as $transition) {
            DB::table('task_status_transitions')->updateOrInsert(
                [
                    'from_status_id' => $transition['from_status_id'],
                    'to_status_id' => $transition['to_status_id'],
                ],
                [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
