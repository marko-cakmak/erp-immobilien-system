@extends('layouts.admin')

@section('title', 'Aufgabe erstellen')
@section('hide-page-header', true)

@section('content')

    @include('tasks.partials.header', [
        'title' => 'Neue Aufgabe',
        'buttonText' => 'Zurück',
        'buttonIcon' => 'arrow-left',
        'buttonUrl' => route('tasks.index')
    ])

    <div class="app-content">
        <div class="container-fluid px-4 pt-4">

            <form method="POST" action="{{ route('tasks.store') }}" id="taskForm">
                @csrf
                <div class="row">

                    {{-- LEFT PANEL --}}
                    <div class="col-md-4">

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label fw-semibold">Wohnung wählen</label>
                                <select id="apartmentSelect" name="apartment_id" class="form-select">
                                    <option value="">— Bitte wählen —</option>
                                    @foreach($apartments as $apartment)
                                        <option value="{{ $apartment->id }}">
                                            {{ $apartment->title }} — {{ $apartment->street_address }}, {{ $apartment->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT PANEL --}}
                    <div class="col-md-8">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Aufgabe erstellen</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    {{-- type_id --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Aufgabentyp</label>
                                        <select class="form-select" name="type_id" id="typeSelect">
                                            <option value="">— Bitte wählen —</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- assigned_to --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Bearbeiter</label>
                                        <select class="form-select" name="assigned_to">
                                            <option value="">— Bitte wählen —</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- deadline_at --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Fällig am</label>
                                        <input type="datetime-local" name="deadline_at" class="form-control">
                                    </div>

                                    {{-- message --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Nachricht</label>
                                        <textarea rows="4" name="message" class="form-control" placeholder="Beschreibung der Aufgabe..."></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end bg-white">
                                <a href="{{ route('tasks.index') }}" class="btn btn-danger me-2">Abbrechen</a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-lg me-1"></i> Aufgabe speichern
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection
