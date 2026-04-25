<div class="col-md-7">

    <div class="task-tabs-container mb-2">
        <ul class="nav nav-tabs" id="apartmentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="info-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#info"
                        type="button"
                        role="tab">
                    Informationen
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="aufgaben-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#aufgaben"
                        type="button"
                        role="tab">
                    Aufgaben
                    <span class="badge bg-secondary ms-1">{{ $tasks->count() }}</span>
                </button>
            </li>
        </ul>
    </div>

    <div class="card shadow-sm task-card-wrapper">
        <div class="card-body p-0">
            <div class="tab-content">

                {{-- Tab: Informationen --}}
                <div class="tab-pane fade show active p-3" id="info" role="tabpanel">
                    @include('apartments.partials.show.show-basic-info', ['apartment' => $apartment])
                    @include('apartments.partials.show.show-financial', ['apartment' => $apartment])
                    @include('apartments.partials.interessenten-list', [
                        'mode'          => 'show',
                        'interessenten' => $interessenten
                    ])
                    @include('apartments.partials.show.show-actions', ['apartment' => $apartment])
                </div>

                {{-- Tab: Aufgaben --}}
                <div class="tab-pane fade p-3" id="aufgaben" role="tabpanel">
                    @include('apartments.partials.show.show-tasks', [
                        'tasks'     => $tasks,
                        'apartment' => $apartment
                    ])
                </div>

            </div>
        </div>
    </div>

</div>
