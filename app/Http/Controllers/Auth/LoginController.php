<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function show()
    {
        $appVersion = DB::table('app_config')->where('key', 'app_version')->value('value');

        return view('auth.login', compact('appVersion'));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $success = $this->authService->attemptLogin(
            $validated['login'],
            $validated['password'],
            $request->boolean('remember')
        );

        if ($success) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Login-Daten sind ungültig.',
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return redirect()->route('login');
    }
}
