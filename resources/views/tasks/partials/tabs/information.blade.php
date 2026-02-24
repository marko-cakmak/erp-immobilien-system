<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Erstellt am</div>
                <div class="col-8">{{ $task->created_at ? $task->created_at->format('d.m.Y H:i') : '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Typ</div>
                <div class="col-8">{{ $task->type->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Fällig am</div>
                <div class="col-8">{{ $task->deadline_at ? $task->deadline_at->format('d.m.Y H:i') : '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Aufgabe Status</div>
                <div class="col-8">
                    <select name="status_id" class="form-select">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4 text-muted fw-semibold">Bearbeiter</div>
                <div class="col-8">
                    <select name="user_id" class="form-select">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $task->activeAssignee?->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-4 text-muted fw-semibold">Hinweis</div>
                <div class="col-8">
                    <textarea name="note" class="form-control" rows="3">{{ $task->message }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check me-1"></i> Speichern
                </button>
            </div>

        </form>

    </div>
</div>
