@extends('layouts.admin')

@section('title', 'Wohnung Bearbeiten')
@section('hide-page-header', true)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartments/image-upload.css') }}">
@endpush

@section('content')

    @include('apartments.partials.header', [
        'title' => 'Wohnung Bearbeiten',
        'buttonText' => 'Abbrechen',
        'buttonIcon' => 'x-circle',
        'buttonUrl' => route('apartments.show', $apartment->id),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('apartments.partials.alerts')

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

            <form method="POST" action="{{ route('apartments.update', $apartment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- LEFT COLUMN --}}
                    <div class="col-md-5">

                        @include('apartments.partials.image-upload', [
                            'mode' => 'edit',
                            'images' => $apartment->images
                        ])

                        {{-- BESCHREIBUNG --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Beschreibung</h3>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control @error('notes') is-invalid @enderror"
                                          name="notes"
                                          rows="6">{{ old('notes', $apartment->notes) }}</textarea>
                                @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT COLUMN --}}
                    <div class="col-md-7">

                        @include('apartments.partials.form-basic-info', [
                            'statuses' => $statuses,
                            'apartment' => $apartment
                        ])

                        @include('apartments.partials.form-financial', ['apartment' => $apartment])

                        {{-- SUBMIT --}}
                        <div class="card mb-4">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-check-circle"></i> Änderungen speichern
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/apartments/image-upload-edit.js') }}"></script>
@endpush
