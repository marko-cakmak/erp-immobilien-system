<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('task_types')->insert([
            [
                'key' => 'besichtigung',
                'name' => 'Besichtigung',
                'description' => 'Apartment viewing workflow',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
