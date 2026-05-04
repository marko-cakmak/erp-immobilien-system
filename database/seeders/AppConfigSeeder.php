<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppConfigSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('app_config')->upsert(
            [
                [
                    'key' => 'app_version',
                    'value' => '1.0',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ],
            ['key'],
            ['value', 'updated_at']
        );
    }
}
