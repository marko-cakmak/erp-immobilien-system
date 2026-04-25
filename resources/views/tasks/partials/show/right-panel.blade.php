{{-- RIGHT PANEL: Tabs + Tab Content --}}
<div class="col-md-7">

    {{-- Tab navigacija --}}
    <div class="task-tabs-container mb-2">
        <ul class="nav nav-tabs" id="taskTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="info-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#info"
                        type="button"
                        role="tab">
                    Aufgabeninformationen
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="bearbeitung-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#bearbeitung"
                        type="button"
                        role="tab">
                    Aufgabenbearbeitung
                </button>
            </li>
        </ul>
    </div>

    <div class="card shadow-sm task-card-wrapper">
        <div class="card-body p-0">
            <div class="tab-content">

                {{-- Tab: Informationen --}}
                <div class="tab-pane fade show active p-3" id="info" role="tabpanel">
                    @if(auth()->check() && !auth()->user()->hasPermission('manage_aufgaben'))
                        <div class="tab-overlay"></div>
                    @endif
                    @include('tasks.partials.tabs.information', [
                        'task'            => $task,
                        'users'           => $users,
                        'statuses'        => $statuses,
                        'isActiveAssignee' => $isActiveAssignee
                    ])
                </div>

                {{-- Tab: Bearbeitung --}}
                <div class="tab-pane fade p-3" id="bearbeitung" role="tabpanel">
                    @if($task->type->key === 'besichtigung' && !$isActiveAssignee)
                        <div class="tab-overlay"></div>
                    @endif
                    @include('tasks.partials.tabs.bearbeitung', [
                        'task'            => $task,
                        'isActiveAssignee' => $isActiveAssignee,
                        'interessenten'   => $interessenten,
                        'statuses'        => $statuses
                    ])
                </div>

            </div>
        </div>
    </div>

</div>
