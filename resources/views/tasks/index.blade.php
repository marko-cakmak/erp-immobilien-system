@extends('layouts.admin')

@section('title', 'Aufgaben')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'      => 'Aufgabe Management',
        'buttonText' => 'Aufgabe Erstellen',
        'buttonIcon' => 'plus-circle',
        'buttonUrl'  => route('tasks.create'),
        'managePermission' => 'manage_task',
    ])

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.shared.alerts')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Aufgabenliste</h3>
                        </div>

                        <div class="card-body">
                            @include('tasks.partials.table', ['tasks' => $tasks])
                        </div>

                        <div class="card-footer py-3 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-muted small">
                                    Gesamt: <span class="fw-semibold text-dark">{{ $tasks->total() }}</span> Wohnung(en)
                                </div>
                                <div>
                                    @include('partials.shared.pagination', ['paginator' => $tasks])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/shared/links.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared/status.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared/table-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared/table-images.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared/modal.css') }}">
@endpush
