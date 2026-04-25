@extends('layouts.admin')

@section('title', 'Wohnung Details')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'       => 'Wohnung Details',
        'buttonText'  => 'Bearbeiten',
        'buttonIcon'  => 'pencil',
        'buttonUrl'   => route('apartments.edit', $apartment->id),
        'buttonClass' => 'btn-warning',
        'managePermission' => 'manage_wohnungen',
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('partials.shared.alerts')

            <div class="row">
                @include('apartments.partials.show.left-panel')
                @include('apartments.partials.show.right-panel')
            </div>
        </div>
    </div>

    @include('apartments.partials.image-modal', ['imageCount' => $apartment->images->count()])

@endsection

@push('scripts')
    <script>
        window.apartmentImages = [
            @if($apartment->coverImage)
                "{{ asset('storage/' . $apartment->coverImage->path) }}",
            @endif
                @foreach($apartment->images as $image)
                @if(!$image->is_cover)
                "{{ asset('storage/' . $image->path) }}",
            @endif
            @endforeach
        ];
    </script>
    <script src="{{ asset('js/apartments/image-gallery.js') }}"></script>
    <script src="{{ asset('js/apartments/apartment-show.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/task/task-tabs.css') }}">
@endpush
