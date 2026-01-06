<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin(string $login, string $password, bool $remember = false): bool
    {
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        return Auth::attempt([
            $loginType => $login,
            'password' => $password,
        ], $remember);
    }

    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
