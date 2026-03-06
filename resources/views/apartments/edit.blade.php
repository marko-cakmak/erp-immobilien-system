@extends('layouts.admin')

@section('title', 'Wohnung Bearbeiten')
@section('hide-page-header', true)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartments/image-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apartments/interessenten-edit.css') }}">
@endpush

@section('content')

    @include('apartments.partials.common.header', [
        'title' => 'Wohnung Bearbeiten',
        'buttonText' => 'Abbrechen',
        'buttonIcon' => 'x-circle',
        'buttonUrl' => route('apartments.show', $apartment->id),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('apartments.partials.common.alerts')
            @include('apartments.partials.common.form-errors')

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

                        @include('apartments.partials.form.form-description',[
                            'apartment' => $apartment
                        ])
                    </div>

                    {{-- RIGHT COLUMN --}}
                    <div class="col-md-7">

                        @include('apartments.partials.form.form-basic-info', [
                            'statuses' => $statuses,
                            'apartment' => $apartment
                        ])

                        @include('apartments.partials.form.form-financial', [
                            'apartment' => $apartment
                        ])

                        @include('apartments.partials.interessenten-list', [
                            'mode' => 'edit',
                            'interessenten' => $apartment->interestedPersons
                        ])

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
    <script
        src="{{ asset('js/apartments/interessenten-edit.js') }}"
        data-all-interessenten='@json($allInteressenten)'
        data-assigned-ids='@json($assignedIds)'
    ></script>
    <script src="{{ asset('js/apartments/interessenten-search.js') }}"></script>
    <script src="{{ asset('js/apartments/apartments-edit.js') }}"></script>
@endpush

