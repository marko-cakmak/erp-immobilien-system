@extends('layouts.admin')

@section('title', 'Wohnung Erstellen')
@section('hide-page-header', true)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartments/image-upload.css') }}">
@endpush

@section('content')

    @include('partials.shared.header', [
        'title'       => 'Wohnung Erstellen',
        'buttonText'  => 'Abbrechen',
        'buttonIcon'  => 'x-circle',
        'buttonUrl'   => route('apartments.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('partials.shared.alerts')
            @include('partials.shared.form-errors')

            <form method="POST" action="{{ route('apartments.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-5">
                        @include('apartments.partials.image-upload', ['mode' => 'create'])
                        @include('apartments.partials.form.form-description')
                    </div>

                    <div class="col-md-7">
                        @include('apartments.partials.form.form-basic-info', ['statuses' => $statuses])
                        @include('apartments.partials.form.form-financial')

                        <div class="card mb-4">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-check-circle"></i> Wohnung erstellen
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
    <script src="{{ asset('js/apartments/image-upload.js') }}"></script>
@endpush
