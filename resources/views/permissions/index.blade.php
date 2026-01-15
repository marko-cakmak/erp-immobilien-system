@extends('layouts.admin')

@section('title', 'Berechtigungen')
@section('hide-page-header', true)

@section('content')

    {{-- Page Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Berechtigungsverwaltung</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    {{-- Success/Error Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Permission Matrix Card --}}
                    <form method="POST" action="{{ route('permissions.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Rollen & Berechtigungen</h3>
                            </div>

                            {{-- Table Body --}}
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-start">Rolle</th>
                                        @foreach($groupedPermissions as $group => $permissions)
                                            @foreach($permissions as $permission)
                                                <th class="text-center" title="{{ $permission->name }}">
                                                    {{ $permission->display_name }}
                                                </th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr class="align-middle">
                                            {{-- Role name --}}
                                            <td class="text-start">
                                                <span class="text-primary fw-semibold">
                                                    {{ $role->name }}
                                                </span>
                                            </td>

                                            {{-- Permissions (grouped) --}}
                                            @foreach($groupedPermissions as $group => $permissions)
                                                @foreach($permissions as $permission)
                                                    <td class="text-center">
                                                        <input type="checkbox"
                                                               name="roles[{{ $role->id }}][permissions][]"
                                                               value="{{ $permission->id }}"
                                                               class="form-check-input"
                                                            @checked($role->permissions->contains($permission))>
                                                    </td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Footer with Save Button --}}
                            <div class="card-footer clearfix">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">
                                        Alle Änderungen speichern
                                    </button>
                                </div>
                                <div class="text-muted">
                                    {{ $roles->count() }} Rollen,
                                    {{ $groupedPermissions->flatten()->count() }} Berechtigungen
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
