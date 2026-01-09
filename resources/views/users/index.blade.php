@extends('layouts.admin')

@section('title', 'Benutzer & Rollen')
@section('hide-page-header', true)

@section('content')

    {{-- Page Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Benutzerverwaltung</h3>
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

                    {{-- Users Table Card --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Benutzerliste</h3>

                            <div class="card-tools">
                                @if(auth()->user()->hasPermission('manage_users'))
                                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i>
                                        Neuer Benutzer
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Table Body --}}
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Benutzername</th>
                                    <th>E-Mail</th>
                                    <th>Rolle</th>
                                    <th style="width: 150px">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr class="align-middle">
                                        {{-- Row Number --}}
                                        <td>{{ $users->firstItem() + $loop->index }}</td>

                                        {{-- Name --}}
                                        <td>
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                                <span class="badge bg-info text-dark ms-1">Sie</span>
                                            @endif
                                        </td>

                                        {{-- Username --}}
                                        <td>
                                                <span class="text-primary fw-semibold">
                                                    {{ $user->username ?? '–' }}
                                                </span>
                                        </td>

                                        {{-- Email --}}
                                        <td>{{ $user->email }}</td>

                                        {{-- Role --}}
                                        <td>
                                            @if($user->role)
                                                <span class="text-primary fw-semibold">
                                                        {{ $user->role->name }}
                                                    </span>
                                            @else
                                                <span class="text-muted">–</span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            {{-- Edit Button --}}
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="btn btn-sm btn-info me-1"
                                               title="Bearbeiten">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- Delete Button --}}
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            title="Löschen">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Empty State --}}
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                            <p class="mb-0 mt-2">Keine Benutzer gefunden.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Footer --}}
                        <div class="card-footer clearfix">
                            <div class="float-end">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                            <div class="text-muted">
                                Zeige {{ $users->firstItem() ?? 0 }} bis {{ $users->lastItem() ?? 0 }}
                                von {{ $users->total() }} Einträgen
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
