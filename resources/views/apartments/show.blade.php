@extends('layouts.admin')

@section('title', 'Wohnung Details')
@section('hide-page-header', true)

@section('content')

    @include('apartments.partials.header', [
        'title' => 'Wohnung Details',
        'buttonText' => 'Bearbeiten',
        'buttonIcon' => 'pencil',
        'buttonUrl' => route('apartments.edit', $apartment->id),
        'buttonClass' => 'btn-warning'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('apartments.partials.alerts')

            <div class="row">

                {{-- Left Column - Images --}}
                <div class="col-md-5">

                    {{-- Cover Image Card --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bilder</h3>
                        </div>
                        <div class="card-body">
                            @if($apartment->coverImage)
                                <img src="{{ asset('storage/' . $apartment->coverImage->path) }}"
                                     class="img-fluid rounded mb-3"
                                     alt="{{ $apartment->title }}"
                                     style="max-height: 400px; width: 100%; object-fit: cover; cursor: pointer;"
                                     onclick="openImageModal(0)">
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> Kein Titelbild vorhanden
                                </div>
                            @endif

                            {{-- Image Gallery --}}
                            @if($apartment->images->count() > 1)
                                <div class="row g-2">
                                    @php $imageIndex = 1; @endphp
                                    @foreach($apartment->images as $image)
                                        @if(!$image->is_cover)
                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $image->path) }}"
                                                     class="img-thumbnail"
                                                     alt="Apartment image"
                                                     style="cursor: pointer; height: 80px; width: 100%; object-fit: cover;"
                                                     onclick="openImageModal({{ $imageIndex }})">
                                            </div>
                                            @php $imageIndex++; @endphp
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Description Card --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Beschreibung</h3>
                        </div>
                        <div class="card-body">
                            @if($apartment->notes)
                                <p>{{ $apartment->notes }}</p>
                            @else
                                <p class="text-muted">Keine Beschreibung vorhanden</p>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Right Column - Details --}}
                <div class="col-md-7">

                    {{-- Basic Info Card --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Grundinformationen</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted">Anzeigenstatus:</td>
                                    <td class="d-flex align-items-center gap-2">
                                        <span class="rounded-circle" style="width:8px; height:8px; background-color: {{ $apartment->is_active ? '#28a745' : '#adb5bd' }};"></span>
                                        <span class="text-muted">
                                            {{ $apartment->is_active ? 'Aktiv' : 'Inaktiv' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Wohnungsstatus:</td>
                                    <td>
                                        <span class="badge bg-{{ $apartment->status->color ?? 'secondary' }}">
                                            {{ $apartment->status->label }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Interne Nr.:</td>
                                    <td><strong>{{ $apartment->internal_number }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Titel:</td>
                                    <td><strong>{{ $apartment->title }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Adresse:</td>
                                    <td>
                                        {{ $apartment->street_address }}, {{ $apartment->postal_code }} {{ $apartment->city }}@if($apartment->state), {{ $apartment->state }}@endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Zimmer:</td>
                                    <td>{{ $apartment->rooms }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Größe:</td>
                                    <td>{{ number_format($apartment->size_sqm, 2) }} m²</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Etage:</td>
                                    <td>{{ $apartment->floor ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Baujahr:</td>
                                    <td>{{ $apartment->year_built ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Financial Info Card --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Finanzielle Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td class="text-muted">Kaltmiete:</td>
                                    <td class="text-end">
                                        <strong>{{ number_format($apartment->rent_cold, 2) }} €</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nebenkosten:</td>
                                    <td class="text-end">
                                        <strong>{{ number_format($apartment->rent_warm - $apartment->rent_cold, 2) }} €</strong>
                                    </td>
                                </tr>
                                <tr class="table-active">
                                    <td><strong>Warmmiete:</strong></td>
                                    <td class="text-end">
                                        <strong class="text-primary">{{ number_format($apartment->rent_warm, 2) }} €</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kaution:</td>
                                    <td class="text-end">
                                        <strong>{{ number_format($apartment->deposit, 2) }} €</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Actions Card --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Wohnung bearbeiten
                                </a>
                                <form method="POST"
                                      action="{{ route('apartments.destroy', $apartment->id) }}"
                                      onsubmit="return confirm('Sind Sie sicher, dass Sie diese Wohnung löschen möchten?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger w-100">
                                        <i class="bi bi-trash"></i> Wohnung löschen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Image Modal --}}
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
