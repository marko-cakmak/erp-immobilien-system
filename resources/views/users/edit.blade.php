@extends('layouts.admin')

@section('title', 'Benutzer bearbeiten')
@section('hide-page-header', true)

@section('content')

    {{-- Page Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Benutzer bearbeiten</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">
                                <i class="bi bi-exclamation-triangle"></i> Fehler
                            </h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- User Edit Form Card --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Benutzerinformationen</h3>
                        </div>

                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                {{-- Basic Information --}}
                                <div class="row">
                                    {{-- Name Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', $user->name) }}"
                                                   required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Username Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">
                                                Benutzername <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   id="username"
                                                   name="username"
                                                   value="{{ old('username', $user->username) }}"
                                                   required>
                                            @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                E-Mail <span class="text-danger">*</span>
                                            </label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email', $user->email) }}"
                                                   required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Role Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role_id" class="form-label">
                                                Rolle <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('role_id') is-invalid @enderror"
                                                    id="role_id"
                                                    name="role_id"
                                                    required>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Password Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">
                                                Neues Passwort
                                            </label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   autocomplete="new-password">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Mindestens 8 Zeichen
                                            </small>
                                        </div>
                                    </div>

                                    {{-- Password Confirmation Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">
                                                Passwort bestätigen
                                            </label>
                                            <input type="password"
                                                   class="form-control"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Form Actions --}}
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Aktualisieren
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Abbrechen
                                </a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
