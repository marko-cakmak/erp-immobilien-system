<?php

namespace App\Http\Controllers;

use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionService $permissionService
    ) {}

    public function index()
    {
        return view('permissions.index', [
            'roles' => $this->permissionService->getRolesWithPermissions(),
            'groupedPermissions' => $this->permissionService->getGroupedPermissions(),
        ]);
    }

    public function update(Request $request)
    {
        try {
            $this->permissionService->syncRolePermissions(
                $request->input('roles', [])
            );

            return back()->with(
                'success',
                'Berechtigungen wurden erfolgreich aktualisiert.'
            );
        } catch (\Throwable $e) {
            return back()->with(
                'error',
                'Fehler beim Speichern der Berechtigungen.'
            );
        }
    }
}
