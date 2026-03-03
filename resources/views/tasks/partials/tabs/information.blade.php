<div style="position: relative;">


    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="p-3">
        @csrf
        @method('PUT')

        {{-- INFO SEKCIJA --}}
        <div class="border rounded p-3 mb-3 bg-light">
            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Erstellt am</div>
                <div class="col-8">{{ $task->created_at ? $task->created_at->format('d.m.Y H:i') : '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Typ</div>
                <div class="col-8">{{ $task->type->name }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-muted fw-semibold">Fällig am</div>
                <div class="col-8">{{ $task->deadline_at ? $task->deadline_at->format('d.m.Y H:i') : '-' }}</div>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="border rounded p-3 mb-3" style="background-color: #fffbf0;">
            <div class="d-flex align-items-center mb-3">
                <h6 class="fw-bold mb-0">Aufgabe Status</h6>
            </div>
            <div class="row">
                <div class="col-4 text-muted fw-semibold align-self-center">Status</div>
                <div class="col-8">
                    <select name="status_id" class="form-select form-select-sm">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- BEARBEITER --}}
        <div class="border rounded p-3 mb-3" style="background-color: #f0f7ff;">
            <div class="d-flex align-items-center mb-3">
                <h6 class="fw-bold mb-0">Bearbeiter</h6>
            </div>
            <div class="row">
                <div class="col-4 text-muted fw-semibold align-self-center">Zugewiesen an</div>
                <div class="col-8">
                    <select name="user_id" class="form-select form-select-sm">
                        @foreach($users as $user)
                            <option
                                value="{{ $user->id }}" {{ $task->activeAssignee?->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- HINWEIS --}}
        <div class="border rounded p-3 mb-3" style="background-color: #f5f5f5;">
            <div class="d-flex align-items-center mb-3">
                <h6 class="fw-bold mb-0">Hinweis</h6>
            </div>
            <textarea name="note" class="form-control form-control-sm" rows="3">{{ $task->message }}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm px-4">
                <i class="bi bi-check me-1"></i> Speichern
            </button>
        </div>

    </form>

</div>
