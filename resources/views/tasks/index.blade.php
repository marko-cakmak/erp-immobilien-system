@extends('layouts.admin')

@section('title', 'Aufgaben')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'      => 'Aufgabe Management',
        'buttonText' => 'Aufgabe Erstellen',
        'buttonIcon' => 'plus-circle',
        'buttonUrl'  => route('tasks.create')
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

                        <div class="card-footer clearfix">
                            <div class="text-muted">
                                Gesamt: {{ $tasks->total() }} Aufgabe(n)
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartments/apartments-index-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/task/task-table.css') }}">
@endpush
