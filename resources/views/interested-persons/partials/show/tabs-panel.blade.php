<div class="col-md-12">

    <div class="task-tabs-container mb-2">
        <ul class="nav nav-tabs" id="personTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="info-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#info"
                        type="button"
                        role="tab">
                    Persönliche Informationen
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="wohnungen-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#wohnungen"
                        type="button"
                        role="tab">
                    Interessierte Wohnungen
                    <span class="badge bg-secondary ms-1">{{ $person->apartments->count() }}</span>
                </button>
            </li>
        </ul>
    </div>

    <div class="card shadow-sm task-card-wrapper">
        <div class="card-body p-0">
            <div class="tab-content">

                {{-- Tab: Informationen --}}
                <div class="tab-pane fade show active p-3" id="info" role="tabpanel">
                    @include('interested-persons.partials.show.personal-info', ['person' => $person])
                </div>

                {{-- Tab: Wohnungen --}}
                <div class="tab-pane fade p-3" id="wohnungen" role="tabpanel">
                    @include('interested-persons.partials.show.assigned-apartments', ['person' => $person])
                </div>

            </div>
        </div>
    </div>

</div>
