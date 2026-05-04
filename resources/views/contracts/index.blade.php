@extends('layouts.admin')

@section('title', 'Verträge')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'            => 'Vertrags Management',
        'buttonText'       => 'Vertrag Erstellen',
        'buttonIcon'       => 'plus-circle',
        'buttonUrl'        => route('contracts.create'),
        'managePermission' => 'manage_contracts',
    ])

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.shared.alerts')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Vertragsliste</h3>
                        </div>

                        <div class="card-body">
                            @include('contracts.partials.table', ['contracts' => $contracts])
                        </div>

                        <div class="card-footer py-3 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-muted small">
                                    Gesamt: <span class="fw-semibold text-dark">{{ $contracts->total() }}</span>
                                    Vertrag(e)
                                </div>
                                <div>
                                    @include('partials.shared.pagination', ['paginator' => $contracts])
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
    <link rel="stylesheet" href="{{ asset('css/shared/modal.css') }}">
@endpush
