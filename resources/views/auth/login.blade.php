@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="split-login-container">
        <div class="left-side">
            <div class="text-center">
                <div class="logo-icon">
                    <i class="bi bi-building"></i>
                </div>
                <h1><b>Immobilien</b> ERP</h1>
                <p>Verwaltungssystem für Immobilien</p>
            </div>
        </div>

        <div class="right-side">
            <div class="login-card">
                <div class="card">
                    <div class="card-body">
                        <h2>Willkommen zurück</h2>
                        <p class="subtitle">Bitte melden Sie sich an</p>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group">
                                <input type="text"
                                       name="login"
                                       class="form-control @error('login') is-invalid @enderror"
                                       placeholder="E-Mail oder Benutzername"
                                       value="{{ old('login') }}"
                                       required
                                       autofocus>
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                @error('login')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Passwort"
                                       required>
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Anmelden
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
