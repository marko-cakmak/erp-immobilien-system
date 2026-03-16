<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'geschaeftsfuehrer' => [
                'name' => 'Test Geschaeftsfuehrer',
                'username' => 'gf',
                'email' => 'gf@immobilien-erp.local',
            ],
            'koordinator' => [
                'name' => 'Test Koordinator',
                'username' => 'koord',
                'email' => 'koord@immobilien-erp.local',
            ],
            'besichtigungsmanager' => [
                'name' => 'Test Besichtigungsmanager',
                'username' => 'bm',
                'email' => 'bm@immobilien-erp.local',
            ],
            'hausmeister' => [
                'name' => 'Test Hausmeister',
                'username' => 'hm',
                'email' => 'hm@immobilien-erp.local',
            ],
        ];

        foreach ($users as $roleName => $data) {
            $role = Role::where('name', $roleName)->first();

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make('password'),
                    'role_id' => $role->id,
                ]
            );
        }
    }
}
