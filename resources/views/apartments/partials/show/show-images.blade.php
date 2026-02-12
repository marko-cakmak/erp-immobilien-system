<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Bilder</h3>
    </div>
    <div class="card-body">
        @if($apartment->coverImage)
        <img src="{{ asset('storage/' . $apartment->coverImage->path) }}"
             class="img-fluid rounded mb-3 apartment-cover-image"
             alt="{{ $apartment->title }}"
             onclick="openImageModal(0)">
        @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Kein Titelbild vorhanden
        </div>
        @endif

        @if($apartment->images->count() > 1)
        <div class="row g-2">
            @php $imageIndex = 1; @endphp
            @foreach($apartment->images as $image)
            @if(!$image->is_cover)
            <div class="col-4">
                <img src="{{ asset('storage/' . $image->path) }}"
                     class="img-thumbnail apartment-gallery-thumb"
                     alt="Apartment image"
                     onclick="openImageModal({{ $imageIndex }})">
            </div>
            @php $imageIndex++; @endphp
            @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
