<?php

namespace App\Services\Permission;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    public function getRolesWithPermissions(): Collection
    {
        return Role::with('permissions')->get();
    }

    public function getGroupedPermissions(): Collection
    {
        $permissions = Permission::orderBy('name')->get();

        $grouped = collect();

        foreach ($permissions as $permission) {
            $group = $this->resolvePermissionGroup($permission);

            if (! isset($grouped[$group])) {
                $grouped[$group] = collect();
            }

            $grouped[$group]->push($permission);
        }

        $order = [
            'aufgaben' => 1,
            'interessenten' => 2,
            'benutzer' => 3,
            'wohnungen' => 4,
            'berechtigungen' => 5,
        ];

        return $grouped->sortBy(fn ($_, $key) => $order[$key] ?? 999);
    }

    public function syncRolePermissions(array $rolesData): void
    {
        DB::transaction(function () use ($rolesData) {
            foreach ($rolesData as $roleId => $data) {
                $role = Role::findOrFail($roleId);
                $permissionIds = $data['permissions'] ?? [];
                $role->permissions()->sync($permissionIds);
            }
        });
    }

    protected function resolvePermissionGroup(Permission $permission): string
    {
        $parts = explode('_', $permission->name);

        return end($parts);
    }
}
