@php $editable = ($mode ?? 'show') === 'edit'; @endphp

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-people-fill"></i> Interessenten
        </h3>
    </div>
    <div class="card-body">

        <div id="assignedList" class="list-group">
            @if(!$editable)
                @forelse($interessenten as $interessent)
                    <a href="/interested-persons/{{ $interessent->id }}"
                       class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-person-circle fs-3 text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    {{ $interessent->first_name }} {{ $interessent->last_name }}
                                </h6>
                                <small class="text-muted d-block">
                                    <i class="bi bi-envelope"></i> {{ $interessent->email }}
                                </small>
                                <small class="text-muted d-block">
                                    <i class="bi bi-telephone"></i> {{ $interessent->phone }}
                                </small>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i>
                        Keine Interessenten für diese Wohnung.
                    </div>
                @endforelse
            @endif
        </div>

        @if($editable)
            <div id="emptyMessage" class="alert alert-info" style="display: none;">
                <i class="bi bi-info-circle"></i>
                Keine Interessenten für diese Wohnung.
            </div>

            <hr class="my-3">

            {{-- Search i dostupni interessenten --}}
            <div>
                <h6 class="text-muted mb-3">
                    <i class="bi bi-plus-circle-fill text-success"></i>
                    Interessenten hinzufügen:
                </h6>

                <div class="search-box mb-3">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text"
                           class="form-control search-input"
                           id="searchInput"
                           placeholder="Nach Namen suchen...">
                </div>

                <div id="availableList"></div>
                <div id="noResults" class="alert alert-warning" style="display: none;">
                    <i class="bi bi-search"></i>
                    Keine Ergebnisse gefunden.
                </div>

                <div class="text-center mt-3" id="loadMoreContainer" style="display: none;">
                    <button type="button"
                            class="btn btn-outline-primary load-more-btn"
                            id="loadMoreBtn">
                        <i class="bi bi-arrow-down-circle"></i> Mehr laden
                    </button>
                </div>
            </div>

            <input type="hidden" name="interessent_ids" value="">
            <div id="hiddenInputs"></div>
        @endif

    </div>
</div>
