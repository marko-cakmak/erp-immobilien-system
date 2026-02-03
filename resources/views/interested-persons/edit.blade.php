@extends('layouts.admin')

@section('title', 'Interessent Bearbeiten')
@section('hide-page-header', true)

@section('content')

    @include('interested-persons.partials.header', [
        'title' => 'Interessent Bearbeiten',
        'buttonText' => 'Abbrechen',
        'buttonIcon' => 'x-circle',
        'buttonUrl' => route('interested-persons.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('interested-persons.partials.alerts')

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> <strong>Es gibt Fehler im Formular:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('interested-persons.update', $person->id) }}">
                @csrf
                @method('PUT')

                @include('interested-persons.partials.form-fields', ['person' => $person])

                {{-- SUBMIT --}}
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
