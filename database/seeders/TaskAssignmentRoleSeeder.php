<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskAssignmentRoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $roles = [
            [
                'key' => 'creator',
                'name' => 'Creator',
            ],
            [
                'key' => 'besichtigung_bearbeiter',
                'name' => 'Besichtigung Bearbeiter',
            ],
            [
                'key' => 'reparatur_bearbeiter',
                'name' => 'Reparatur Bearbeiter',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('task_assignment_roles')->updateOrInsert(
                ['key' => $role['key']],
                [
                    'name' => $role['name'],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
