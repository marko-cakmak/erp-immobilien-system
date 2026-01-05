<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Geschäftsführer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Koordinator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Besichtigungsmanager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hausmeister',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
