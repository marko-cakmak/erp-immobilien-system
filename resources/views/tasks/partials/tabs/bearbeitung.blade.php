<link rel="stylesheet" href="{{ asset('css/task/task-besichtigung.css') }}">

<div class="p-3 task-card-body">

    @if($task->type->key === 'besichtigung' && !$isActiveAssignee)
        <div class="task-overlay"></div>
    @endif

    @if($task->type->key === 'besichtigung')

        @if(!$isActiveAssignee)
            <div class="task-overlay-alert">
                <div class="alert alert-warning d-flex align-items-center py-2 px-3" role="alert">
                    <small>
                        Diese Aufgabe wird aktuell bearbeitet von
                        <strong>{{ $task->activeAssignee->user->name }}</strong>.<br>
                        Sie haben nur Lesezugriff auf diese Aufgabe.
                    </small>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.besichtigung.store', $task->id) }}">
            @csrf

            {{-- TERMIN --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-2">Besichtigungstermin</h6>
                <input type="datetime-local"
                       name="besichtigung_at"
                       class="form-control form-control-sm"
                       value="{{ optional($task->besichtigung?->besichtigung_at)->format('Y-m-d\TH:i') }}">
            </div>

            <hr class="my-3">

            {{-- TEILNEHMER --}}
            <div class="mb-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                        <i class="bi bi-people text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Teilnehmer</h6>
                </div>

                <div class="ps-4">
                    <label class="text-muted small mb-1">Verfügbare Interessenten</label>
                    <input type="text"
                           id="searchInteressenten"
                           class="form-control form-control-sm mb-2"
                           placeholder="Nach Namen suchen...">

                    <div class="list-group mb-3" id="availableInteressenten">
                        @foreach($interessenten as $interessent)
                            <div class="list-group-item py-2 d-flex align-items-center justify-content-between"
                                 data-id="{{ $interessent->id }}"
                                 data-name="{{ $interessent->first_name }} {{ $interessent->last_name }}"
                                 data-email="{{ $interessent->email }}">

                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle text-primary me-2"></i>
                                    <div>
                                        <div class="fw-semibold small">
                                            {{ $interessent->first_name }} {{ $interessent->last_name }}
                                        </div>
                                        <small class="text-muted">{{ $interessent->email }}</small>
                                    </div>
                                </div>

                                <button type="button"
                                        class="btn btn-sm btn-outline-primary add-interessent">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <label class="text-muted small mb-1">Ausgewählte Teilnehmer</label>
                    <div class="list-group" id="selectedInteressenten">
                        <div class="text-muted small p-2 text-center" id="emptySelected">
                            <i class="bi bi-person-dash me-1"></i>
                            Noch keine Teilnehmer ausgewählt.
                        </div>
                    </div>

                    <div id="hiddenInputs"></div>
                </div>
            </div>

            <hr class="my-3">

            {{-- ERGEBNIS --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-2">Ergebnis</h6>

                @if($task->besichtigung?->ergebnis)
                    <div class="alert alert-success py-2 px-3 mb-2">
                        <strong>Wohnung vergeben an:</strong>
                        {{ $task->besichtigung->ergebnis->first_name }}
                        {{ $task->besichtigung->ergebnis->last_name }}
                    </div>
                @endif

                <label class="text-muted small mb-1">Wohnung vergeben an</label>
                <select name="result_interessent_id" class="form-select form-select-sm">
                    <option value="">Teilnehmer auswählen</option>
                    @foreach($interessenten as $interessent)
                        <option value="{{ $interessent->id }}"
                            @selected($task->besichtigung?->result_interessent_id == $interessent->id)>
                            {{ $interessent->first_name }} {{ $interessent->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr class="my-3">

            {{-- NOTIZEN --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-2">Notizen</h6>
                <textarea name="notes"
                          class="form-control form-control-sm"
                          rows="3"
                          placeholder="Optionale Notizen...">{{ $task->besichtigung?->notes }}</textarea>
            </div>

            <hr class="my-3">

            {{-- STATUS --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-2">Aufgabe Status</h6>

                <div class="mb-2">
                    <small class="text-muted">Aktueller Status</small><br>
                    <span class="badge bg-warning text-dark">
                        {{ $task->status->name }}
                    </span>
                </div>

                <label class="text-muted small mb-1">Status ändern</label>
                <select name="status_id" class="form-select form-select-sm">
                    <option value="">— Status wählen —</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-primary btn-sm px-4">
                    Speichern
                </button>
            </div>

        </form>

    @else
        <div class="text-muted">
            Für diesen Aufgabentyp ist noch keine Bearbeitungsansicht definiert.
        </div>
    @endif

</div>

<script src="{{ asset('js/task/task-besichtigung.js') }}"></script>
