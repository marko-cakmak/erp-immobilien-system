@extends('layouts.admin')

@section('title', 'Wohnung Details')
@section('hide-page-header', true)

@section('content')

    @include('apartments.partials.common.header', [
        'title' => 'Wohnung Details',
        'buttonText' => 'Bearbeiten',
        'buttonIcon' => 'pencil',
        'buttonUrl' => route('apartments.edit', $apartment->id),
        'buttonClass' => 'btn-warning'
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('apartments.partials.common.alerts')

            <div class="row">

                {{-- Left Column --}}
                <div class="col-md-5">
                    @include('apartments.partials.show.show-images', ['apartment' => $apartment])
                    @include('apartments.partials.show.show-description', ['apartment' => $apartment])
                </div>

                {{-- Right Column --}}
                <div class="col-md-7">
                    @include('apartments.partials.show.show-basic-info', ['apartment' => $apartment])
                    @include('apartments.partials.show.show-financial', ['apartment' => $apartment])

                    @include('apartments.partials.interessenten-list', [
                        'mode' => 'show',
                        'interessenten' => $interessenten
                    ])

                    @include('apartments.partials.show.show-actions', ['apartment' => $apartment])
                </div>

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
@endpush
