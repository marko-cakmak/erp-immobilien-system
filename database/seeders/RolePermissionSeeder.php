<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $geschaeftsfuehrer = Role::where('name', 'geschaeftsfuehrer')->first();
        $geschaeftsfuehrer->permissions()->sync(
            Permission::all()
        );

        $koordinator = Role::where('name', 'koordinator')->first();
        $koordinator->permissions()->sync(
            Permission::whereIn('name', [
                'view_wohnungen',
                'manage_wohnungen',

                'view_interessenten',
                'manage_interessenten',

                'view_all_aufgaben',
                'view_own_aufgaben',
                'manage_aufgaben',
            ])->get()
        );

        $besichtigungsmanager = Role::where('name', 'besichtigungsmanager')->first();
        $besichtigungsmanager->permissions()->sync(
            Permission::whereIn('name', [
                'view_wohnungen',
                'view_own_aufgaben',
            ])->get()
        );

        $hausmeister = Role::where('name', 'hausmeister')->first();
        $hausmeister->permissions()->sync(
            Permission::whereIn('name', [
                'view_own_aufgaben',
            ])->get()
        );
    }
}
