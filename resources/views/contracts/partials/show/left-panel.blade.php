<div class="col-md-4">

    {{-- Wohnung Info --}}
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title mb-0">
                <i class="bi bi-building me-2"></i>Wohnung
            </h3>
        </div>
        <div class="card-body">
            <p class="fw-semibold mb-1">
                <a href="{{ route('apartments.show', $contract->apartment->id) }}" class="link-primary">
                    {{ $contract->apartment->title }}
                </a>
            </p>
            <p class="text-muted small mb-1">{{ $contract->apartment->street_address }}</p>
            <p class="text-muted small mb-1">{{ $contract->apartment->postal_code }} {{ $contract->apartment->city }}</p>
            <hr>
            <div class="row text-center">
                <div class="col-4">
                    <div class="fw-semibold">{{ number_format($contract->apartment->rent_cold, 2, ',', '.') }} €</div>
                    <small class="text-muted">Kaltmiete</small>
                </div>
                <div class="col-4">
                    <div class="fw-semibold">{{ number_format($contract->apartment->rent_warm, 2, ',', '.') }} €</div>
                    <small class="text-muted">Warmmiete</small>
                </div>
                <div class="col-4">
                    <div class="fw-semibold">{{ number_format($contract->apartment->deposit, 2, ',', '.') }} €</div>
                    <small class="text-muted">Kaution</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Mieter Info --}}
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title mb-0">
                <i class="bi bi-person me-2"></i>Mieter
            </h3>
        </div>
        <div class="card-body">
            <p class="fw-semibold mb-1">
                <a href="{{ route('interested-persons.show', $contract->interestedPerson->id) }}" class="link-primary">
                    {{ $contract->interestedPerson->full_name }}
                </a>
            </p>
            <p class="text-muted small mb-1">
                <i class="bi bi-envelope me-1"></i>{{ $contract->interestedPerson->email }}
            </p>
            <p class="text-muted small mb-1">
                <i class="bi bi-telephone me-1"></i>{{ $contract->interestedPerson->phone }}
            </p>
            <p class="text-muted small mb-0">
                <i class="bi bi-geo-alt me-1"></i>
                {{ $contract->interestedPerson->street_address }},
                {{ $contract->interestedPerson->postal_code }}
                {{ $contract->interestedPerson->city }}
            </p>
        </div>
    </div>

</div>
