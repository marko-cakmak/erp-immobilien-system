<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->getUsersWithRoles();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $this->userService->create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Benutzer erfolgreich erstellt.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Benutzer erfolgreich aktualisiert.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'Sie können sich nicht selbst löschen.');
        }

        $this->userService->delete($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'Benutzer gelöscht.');
    }
}
