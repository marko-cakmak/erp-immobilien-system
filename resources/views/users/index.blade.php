@extends('layouts.admin')

@section('title', 'Benutzer & Rollen')
@section('hide-page-header', true)

@section('content')

    @include('users.partials.header', [
        'title'      => 'Benutzerverwaltung',
        'buttonText' => 'Neuer Benutzer',
        'buttonIcon' => 'plus-circle',
        'buttonUrl'  => route('users.create')
    ])

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('users.partials.alerts')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Benutzerliste</h3>
                        </div>

                        <div class="card-body">
                            @include('users.partials.table', ['users' => $users])
                        </div>

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
