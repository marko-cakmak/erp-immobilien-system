<link rel="stylesheet" href="{{ asset('css/task/task-besichtigung.css') }}">

<div class="p-3 task-card-body">

    {{--    @if($task->type->key === 'besichtigung' && !$isActiveAssignee)--}}
    {{--        <div class="task-overlay"></div>--}}
    {{--    @endif--}}

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

        @php
            $selectedIds = $task->besichtigung?->teilnehmer->pluck('id')->toArray() ?? [];
        @endphp

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

                    {{-- AVAILABLE --}}
                    <div class="border rounded p-2 mb-3 bg-light">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-lines-fill text-primary me-2"></i>
                            <span class="text-muted small fw-semibold">Verfügbare Interessenten</span>
                        </div>
                        <input type="text"
                               id="searchInteressenten"
                               class="form-control form-control-sm mb-2"
                               placeholder="Nach Namen suchen...">

                        <div class="list-group d-flex flex-column gap-2" id="availableInteressenten">
                            @foreach($interessenten as $interessent)
                                <div
                                    class="list-group-item list-group-item-action py-2 d-flex align-items-center justify-content-between"
                                    data-id="{{ $interessent->id }}"
                                    data-name="{{ $interessent->first_name }} {{ $interessent->last_name }}"
                                    data-email="{{ $interessent->email }}"
                                    @if(in_array($interessent->id, $selectedIds)) style="display:none !important;" @endif>

                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle text-primary me-2"></i>
                                        <div>
                                            <div class="fw-semibold small">
                                                {{ $interessent->first_name }} {{ $interessent->last_name }}
                                            </div>
                                            <small class="text-muted">{{ $interessent->email }}</small>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary add-interessent">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SELECTED --}}
                    <div class="border rounded p-2 border-success" style="background-color: #fffdf0;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-check-fill text-success me-2"></i>
                            <span class="text-muted small fw-semibold">Ausgewählte Teilnehmer</span>
                        </div>

                        <div class="list-group d-flex flex-column gap-2" id="selectedInteressenten">
                            @if(empty($selectedIds))
                                <div class="text-muted small p-2 text-center" id="emptySelected">
                                    <i class="bi bi-person-dash me-1"></i>
                                    Noch keine Teilnehmer ausgewählt.
                                </div>
                            @else
                                @foreach($interessenten->whereIn('id', $selectedIds) as $interessent)
                                    <div
                                        class="list-group-item py-2 d-flex align-items-center justify-content-between selected-item"
                                        data-id="{{ $interessent->id }}"
                                        data-name="{{ $interessent->first_name }} {{ $interessent->last_name }}"
                                        data-email="{{ $interessent->email }}">

                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle text-success me-2"></i>
                                            <div>
                                                <div class="fw-semibold small">
                                                    {{ $interessent->first_name }} {{ $interessent->last_name }}
                                                </div>
                                                <small class="text-muted">{{ $interessent->email }}</small>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-sm btn-outline-danger remove-interessent">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div id="hiddenInputs">
                        @foreach($selectedIds as $id)
                            <input type="hidden" name="interessent_ids[]" value="{{ $id }}">
                        @endforeach
                    </div>

                </div>
            </div>

            <hr class="my-3">

            {{-- ERGEBNIS --}}
            <div class="mb-3">
                <div class="d-flex align-items-center mb-2">
                    <h6 class="fw-bold mb-0">Ergebnis</h6>
                </div>

                <div class="border rounded p-3" style="background-color: #edf4ed;">

                    <label class="fw-semibold mb-1">Wohnung vergeben an</label>
                    <select name="result_interessent_id" class="form-select form-select-sm">
                        <option value="">Teilnehmer auswählen</option>
                        @foreach($task->besichtigung?->teilnehmer ?? [] as $interessent)
                            <option value="{{ $interessent->id }}"
                                @selected($task->besichtigung?->result_interessent_id == $interessent->id)>
                                {{ $interessent->first_name }} {{ $interessent->last_name }}
                            </option>
                        @endforeach
                    </select>

                    @if($task->besichtigung?->result_interessent_id)
                        <button type="button"
                                class="btn btn-sm btn-outline-danger mt-2"
                                id="clearErgebnis">
                            <i class="bi bi-x-circle me-1"></i> Ergebnis löschen
                        </button>
                    @endif

                    <div class="my-3"></div>

                    <label class="fw-semibold mb-1">Notizen</label>
                    <textarea name="notes"
                              class="form-control form-control-sm"
                              rows="3"
                              placeholder="Optionale Notizen...">{{ $task->besichtigung?->notes }}</textarea>

                </div>
            </div>

            <hr class="my-3">

            {{-- STATUS --}}
            <div class="mb-3">
                <div class="d-flex align-items-center mb-2">
                    <h6 class="fw-bold mb-0">Aufgabe Status</h6>
                </div>

                <div class="border rounded p-3" style="background-color: #fffbf0;">

                    <div class="mb-3">
                        <label class="fw-semibold mb-1 d-block">Aktueller Status</label>
                        <span class="badge"
                              style="background-color: {{ $task->status->color }}; color: white;">{{ $task->status->name }}</span>
                    </div>

                    <label class="fw-semibold mb-1">Status ändern</label>
                    <select name="status_id" class="form-select form-select-sm">
                        <option value="">— Status wählen —</option>
                        @foreach($task->status->allowedTransitions as $status)
                            <option value="{{ $status->id }}">
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
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
