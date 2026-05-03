<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage_users', 'display_name' => 'Benutzer verwalten'],
            ['name' => 'manage_permissions', 'display_name' => 'Berechtigungen verwalten'],

            ['name' => 'view_wohnungen', 'display_name' => 'Wohnungen ansehen'],
            ['name' => 'manage_wohnungen', 'display_name' => 'Wohnungen verwalten'],

            ['name' => 'view_interessenten', 'display_name' => 'Interessenten ansehen'],
            ['name' => 'manage_interessenten', 'display_name' => 'Interessenten verwalten'],

            ['name' => 'manage_aufgaben', 'display_name' => 'Alle Aufgaben verwalten'],
            ['name' => 'manage_own_aufgaben', 'display_name' => 'Eigene Aufgaben verwalten'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']], // unique key
                ['display_name' => $permission['display_name']]
            );
        }
    }
}
