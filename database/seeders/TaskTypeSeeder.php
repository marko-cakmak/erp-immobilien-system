<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'key' => 'besichtigung',
                'name' => 'Besichtigung',
                'description' => 'Apartment viewing workflow',
            ],
            [
                'key' => 'reparatur',
                'name' => 'Reparatur',
                'description' => 'Repair or maintenance task',
            ],
        ];

        foreach ($types as $type) {

            DB::table('task_types')->updateOrInsert(
                ['key' => $type['key']],
                [
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

        }
    }
}
