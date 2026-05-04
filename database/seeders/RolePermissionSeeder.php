<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->syncPermissions('geschaeftsfuehrer', Permission::pluck('id')->toArray());

        $this->syncPermissions('koordinator', Permission::whereIn('name', [
            'view_wohnungen',
            'manage_wohnungen',
            'view_interessenten',
            'manage_interessenten',
            'manage_own_aufgaben',
            'manage_aufgaben',
        ])->pluck('id')->toArray());

        $this->syncPermissions('besichtigungsmanager', Permission::whereIn('name', [
            'view_wohnungen',
            'manage_own_aufgaben',
        ])->pluck('id')->toArray());

        $this->syncPermissions('hausmeister', Permission::whereIn('name', [
            'view_wohnungen',
            'manage_own_aufgaben',
        ])->pluck('id')->toArray());
    }

    private function syncPermissions(string $roleName, array $permissionIds): void
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->command?->warn("Role '{$roleName}' not found. Skipping.");
            return;
        }

        $role->permissions()->sync($permissionIds);
    }
}
