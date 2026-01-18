@extends('layouts.admin')

@section('title', 'Wohnungen')
@section('hide-page-header', true)

@section('content')

    @include('apartments.partials.header', [
        'title' => 'Wohnungsverwaltung',
        'buttonText' => 'Wohnung hinzufügen',
        'buttonIcon' => 'plus-circle',
        'buttonUrl' => '/apartments/create'
    ])

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('apartments.partials.alerts')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Wohnungsliste</h3>
                        </div>

                        <div class="card-body">
                            @include('apartments.partials.table', ['apartments' => $apartments])
                        </div>

                        <div class="card-footer clearfix">
                            <div class="text-muted">
                                Gesamt: {{ $apartments->count() }} Wohnung(en)
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
