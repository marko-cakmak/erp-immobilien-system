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
                'name' => 'test_geschaeftsfuehrer',
                'username' => 'test-gf',
                'email' => 'test-gf@immobilien-erp.local',
            ],
            'koordinator' => [
                'name' => 'test_koordinator',
                'username' => 'test-koord',
                'email' => 'test-koord@immobilien-erp.local',
            ],
            'besichtigungsmanager' => [
                'name' => 'test_besichtigungsmanager',
                'username' => 'test-bm',
                'email' => 'test-bm@immobilien-erp.local',
            ],
            'hausmeister' => [
                'name' => 'test_hausmeister',
                'username' => 'test-hm',
                'email' => 'test-hm@immobilien-erp.local',
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
