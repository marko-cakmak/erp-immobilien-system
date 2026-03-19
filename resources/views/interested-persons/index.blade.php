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

                        <div class="card-footer clearfix">
                            <div class="text-muted">
                                Gesamt: {{ $persons->count() }} Interessent(en)
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
