<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('task_statuses')->insert([
            [
                'key' => 'neu',
                'name' => 'Neu',
                'color' => '#dc3545',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'geplant',
                'name' => 'Geplant',
                'color' => '#fd7e14',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'abgeschlossen',
                'name' => 'Abgeschlossen',
                'color' => '#0d6efd',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'canceled',
                'name' => 'Abgebrochen',
                'color' => '#6c757d',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
