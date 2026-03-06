@if($person->apartments->count() > 0)
    <div class="list-group">
        @foreach($person->apartments as $apartment)
            <a href="{{ route('apartments.show', $apartment->id) }}"
               class="list-group-item list-group-item-action">
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
    <div class="alert alert-info mb-0">
        <i class="bi bi-info-circle"></i>
        Keine interessierten Wohnungen vorhanden.
    </div>
@endif
