@extends('layouts.admin')

@section('title', 'Interessent Bearbeiten')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'       => 'Interessent Bearbeiten',
        'buttonText'  => 'Abbrechen',
        'buttonIcon'  => 'x-circle',
        'buttonUrl'   => route('interested-persons.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('partials.shared.alerts')
            @include('partials.shared.form-errors')

            <form method="POST" action="{{ route('interested-persons.update', $person->id) }}">
                @csrf
                @method('PUT')

                @include('interested-persons.partials.form-fields', ['person' => $person])

                <div class="card mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-check-circle"></i> Änderungen speichern
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
