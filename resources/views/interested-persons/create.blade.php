@extends('layouts.admin')

@section('title', 'Interessent Erstellen')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'       => 'Interessent Erstellen',
        'buttonText'  => 'Abbrechen',
        'buttonIcon'  => 'x-circle',
        'buttonUrl'   => route('interested-persons.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('partials.shared.alerts')
            @include('partials.shared.form-errors')

            <form method="POST" action="{{ route('interested-persons.store') }}">
                @csrf

                @include('interested-persons.partials.form-fields')

                <div class="card mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-check-circle"></i> Interessent erstellen
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
