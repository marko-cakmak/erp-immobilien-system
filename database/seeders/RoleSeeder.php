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
                'name' => 'geschaeftsfuehrer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'koordinator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'besichtigungsmanager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'hausmeister',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
