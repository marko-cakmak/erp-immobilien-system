@extends('layouts.admin')

@section('title', 'Interessent Details')
@section('hide-page-header', true)

@section('content')

    @include('interested-persons.partials.header', [
        'title' => 'Interessent Details',
        'buttonText' => 'Bearbeiten',
        'buttonIcon' => 'pencil',
        'buttonUrl' => route('interested-persons.edit', $person->id),
        'buttonClass' => 'btn-warning'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('interested-persons.partials.alerts')

            {{-- Details Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Persönliche Informationen</h3>
                </div>
                <div class="card-body">

                    {{-- Status --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Status:</label>
                        <div class="col-sm-9">
                            <span class="badge bg-{{ $person->is_active ? 'success' : 'secondary' }} mt-2">
                                {{ $person->is_active ? 'Aktiv' : 'Inaktiv' }}
                            </span>
                        </div>
                    </div>

                    {{-- Vorname --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Vorname:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->first_name }}</p>
                        </div>
                    </div>

                    {{-- Nachname --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Nachname:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->last_name }}</p>
                        </div>
                    </div>

                    {{-- E-Mail --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">E-Mail:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->email }}</p>
                        </div>
                    </div>

                    {{-- Telefon --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Telefon:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->phone }}</p>
                        </div>
                    </div>

                    {{-- Straße --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Straße:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->street_address ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- PLZ & Stadt --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">PLZ & Stadt:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">
                                @if($person->postal_code || $person->city)
                                    {{ $person->postal_code }} {{ $person->city }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Notizen --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-muted">Notizen:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $person->notes ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Interested Apartments Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Interessierte Wohnungen</h3>
                </div>
                <div class="card-body">
                    @if($person->apartments->count() > 0)
                        <div class="list-group">
                            @foreach($person->apartments as $apartment)
                                <a href="{{ route('apartments.show', $apartment->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $apartment->title }}</h6>
                                            <small class="text-muted">
                                                {{ $apartment->street_address }}, {{ $apartment->postal_code }} {{ $apartment->city }}
                                            </small>
                                        </div>
                                        <span class="badge bg-{{ $apartment->status->color ?? 'secondary' }}">
                                            {{ $apartment->status->label }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Keine interessierten Wohnungen</p>
                    @endif
                </div>
            </div>

            {{-- Actions Card --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('interested-persons.edit', $person->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Interessent bearbeiten
                        </a>

                        <form method="POST"
                              action="{{ route('interested-persons.destroy', $person->id) }}"
                              onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Interessenten löschen möchten?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i> Interessent löschen
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
