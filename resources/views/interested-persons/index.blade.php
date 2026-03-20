@extends('layouts.admin')

@section('title', 'Interessenten')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'      => 'Interessentenverwaltung',
        'buttonText' => 'Interessent hinzufügen',
        'buttonIcon' => 'plus-circle',
        'buttonUrl'  => route('interested-persons.create')
    ])

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.shared.alerts')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Interessentenliste</h3>
                        </div>

                        <div class="card-body">
                            @include('interested-persons.partials.table', ['persons' => $persons])
                        </div>

                        <div class="card-footer py-3 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-muted small">
                                    Gesamt: <span class="fw-semibold text-dark">{{ $persons->total() }}</span> Interessent(en)
                                </div>
                                <div>
                                    @include('partials.shared.pagination', ['paginator' => $persons])
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
