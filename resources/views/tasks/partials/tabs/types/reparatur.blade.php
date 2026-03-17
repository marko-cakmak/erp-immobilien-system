<link rel="stylesheet" href="{{ asset('css/task/task-reparatur.css') }}">

<div class="p-3 task-card-body">

    @if(!$isActiveAssignee)
        <div class="task-overlay-alert">
            <div class="alert alert-warning d-flex align-items-center py-2 px-3">
                <small>
                    Diese Aufgabe wird aktuell bearbeitet von
                    <strong>{{ $task->activeAssignee->user->name }}</strong>.<br>
                    Sie haben nur Lesezugriff auf diese Aufgabe.
                </small>
            </div>
        </div>
        <div class="task-overlay"></div>  {{-- OVO NEDOSTAJE --}}
    @endif

        <form method="POST"
              action="{{ route('tasks.repair.store', $task->id) }}"
              enctype="multipart/form-data">
        @csrf

        {{-- REPARATUR INFORMATION --}}
        <div class="task-section">

            <div class="task-section-header">
                <h6>Reparaturinformation</h6>
            </div>

            <div class="task-box-light">

                <div class="mb-2">
                    <label class="fw-semibold">Reparaturtyp</label>
                    <div class="task-readonly-field">
                        {{ $task->repair?->type?->name ?? '—' }}
                    </div>
                </div>

                <div>
                    <label class="fw-semibold">Aufgabebeschreibung</label>
                    <div class="task-readonly-field task-description">
                        {{ $task->message ?? 'Keine Beschreibung vorhanden.' }}
                    </div>
                </div>

            </div>

        </div>

        <hr class="task-divider">


        {{-- ARBEITSNOTIZEN --}}
        <div class="task-section">

            <div class="task-section-header">
                <h6>Arbeitsnotizen</h6>
            </div>

            <div class="task-box">

                <label class="fw-semibold">Notizen zur Reparatur</label>

                <textarea
                    name="notes"
                    class="form-control form-control-sm task-autogrow"
                    rows="5"
                    placeholder="Beschreibung der durchgeführten Arbeiten...">{{ $task->repair?->notes }}</textarea>

            </div>

        </div>

        {{-- FOTOS --}}
        <div class="task-section">

            <div class="task-section-header">
                <h6>Fotos</h6>
            </div>

            <div class="task-box">

                <label class="fw-semibold mb-1">Bilder hinzufügen</label>

                <input
                    type="file"
                    name="photos[]"
                    id="repairPhotosInput"
                    class="form-control form-control-sm"
                    multiple
                    accept="image/*"
                >

                <small class="text-muted d-block mt-1">
                    Mehrere Bilder möglich.
                </small>

                <div id="repairPhotosPreview" class="repair-photo-preview-grid mt-3">
                    @foreach($task->repair?->images ?? [] as $image)
                        <div class="repair-photo-item" id="photo-{{ $image->id }}">
                            <img
                                src="{{ asset('storage/' . $image->path) }}"
                                class="img-fluid rounded"
                                alt="Repair photo"
                                style="cursor: pointer;"
                                data-bs-toggle="modal"
                                data-bs-target="#photoModal"
                                data-src="{{ asset('storage/' . $image->path) }}"
                            >
                            <div class="text-center mt-1">
                                <button type="button"
                                        class="btn btn-sm btn-danger repair-photo-delete w-100"
                                        data-id="{{ $image->id }}"
                                        style="padding: 1px 0; font-size: 0.7rem; line-height: 1.2;">
                                    Bild entfernen
                                </button>
                            </div>
                            <input type="hidden" name="delete_photos[]" class="delete-photo-input" value="{{ $image->id }}" disabled>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

        <hr class="task-divider">

        {{-- STATUS --}}
        <div class="task-section">

            <div class="task-section-header">
                <h6>Aufgabe Status</h6>
            </div>

            <div class="task-status-box">

                <div class="mb-3">
                    <label class="fw-semibold d-block">Aktueller Status</label>

                    <span class="badge"
                          style="background-color: {{ $task->status->color }};">
                        {{ $task->status->name }}
                    </span>
                </div>

                <label class="fw-semibold">Status ändern</label>

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

        <div class="text-end pt-2">
            <button type="submit" class="btn btn-primary btn-sm px-4">
                Speichern
            </button>
        </div>

    </form>

        {{-- LIGHTBOX MODAL --}}
        <div class="modal fade" id="photoModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body p-0 text-center">
                        <img id="photoModalImg" src="" class="img-fluid rounded" alt="">
                    </div>
                </div>
            </div>
        </div>

</div>

<script src="{{ asset('js/task/task-reparatur.js') }}"></script>
