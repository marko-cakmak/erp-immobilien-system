<div class="card mb-3 shadow-sm">

    <div class="card-body">

        @if($task->apartment)

            {{-- TITLE --}}
            <h6 class="fw-bold mb-2">
                {{ $task->apartment->title }}
                <span class="badge bg-{{ $task->apartment->status->color ?? 'secondary' }} ms-1">
                    {{ $task->apartment->status->label ?? '—' }}
                </span>
            </h6>

            {{-- ADDRESS --}}
            <div class="text-muted small mb-2">
                {{ $task->apartment->street_address }}<br>
                {{ $task->apartment->postal_code }}
                {{ $task->apartment->city }}
            </div>

            <a href="{{ route('apartments.show', $task->apartment->id) }}" class="text-muted small d-block mb-3">
                <i class="fas fa-arrow-right me-1"></i> Zur Wohnung
            </a>

            {{-- IMAGE --}}
            @if($task->apartment->coverImage)
                <img src="{{ asset('storage/' . $task->apartment->coverImage->path) }}"
                     class="img-fluid rounded mb-3"
                     alt="{{ $task->apartment->title }}">
            @endif

            <hr class="my-3">

            {{-- KEY DATA --}}
            <div class="row text-center g-2">

                <div class="col-4">
                    <div class="small text-muted">Zimmer</div>
                    <div class="fw-semibold">
                        {{ $task->apartment->rooms ?? '—' }}
                    </div>
                </div>

                <div class="col-4">
                    <div class="small text-muted">Größe</div>
                    <div class="fw-semibold">
                        {{ $task->apartment->size_sqm ?? '—' }} m²
                    </div>
                </div>

                <div class="col-4">
                    <div class="small text-muted">Warmmiete</div>
                    <div class="fw-semibold">
                        {{ $task->apartment->rent_warm ?? '—' }} €
                    </div>
                </div>

            </div>

        @else

            <div class="text-muted">
                Keine Wohnung zugeordnet.
            </div>

        @endif

    </div>

</div>
