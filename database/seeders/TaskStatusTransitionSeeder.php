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

        foreach ($transitions as $transition) {
            DB::table('task_status_transitions')->insert([
                ...$transition,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
