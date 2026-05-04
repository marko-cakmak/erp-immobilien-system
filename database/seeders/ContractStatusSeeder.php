<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contract_statuses')->upsert(
            [
                [
                    'key' => 'offen',
                    'name' => 'Offen',
                    'color' => '#fa4d65',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'unterzeichnet',
                    'name' => 'Unterzeichnet',
                    'color' => '#48d597',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ],
            ['key'],
            ['name', 'color', 'sort_order', 'updated_at']
        );
    }
}
