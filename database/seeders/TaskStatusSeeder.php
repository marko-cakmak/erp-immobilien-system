<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('task_statuses')->upsert(
            [
                [
                    'key' => 'neu',
                    'name' => 'Neu',
                    'color' => '#fa4d65',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'in_progress',
                    'name' => 'In Bearbeitung',
                    'color' => '#f9a55e',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'abgeschlossen',
                    'name' => 'Abgeschlossen',
                    'color' => '#72aadf',
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'canceled',
                    'name' => 'Abgebrochen',
                    'color' => '#adb8bf',
                    'sort_order' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ],
            ['key'],
            ['color', 'name', 'sort_order', 'updated_at']
        );
    }
}
