{{-- Aufgaben Tab --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Aufgaben für diese Wohnung</h5>
    @if(auth()->user()->hasPermission('manage_aufgaben'))
        <a href="{{ route('tasks.create', ['apartment_id' => $apartment->id]) }}"
           class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Neue Aufgabe
        </a>
    @endif
</div>

@if($tasks->isEmpty())
    <div class="text-center text-muted py-4">
        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
        Keine Aufgaben vorhanden
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Typ</th>
                <th>Status</th>
                <th>Bearbeiter</th>
                <th>Deadline</th>
                <th class="text-center">Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="align-middle">
                    <td>{{ $task->id }}</td>
                    <td><span class="fw-semibold">{{ $task->type->name }}</span></td>
                    <td>
                            <span class="badge" style="background-color: {{ $task->status->color }}; color: white;">
                                {{ $task->status->name }}
                            </span>
                    </td>
                    <td>{{ $task->activeAssignee?->user->name ?? '—' }}</td>
                    <td>
                        @if($task->deadline_at)
                            {{ $task->deadline_at->format('d.m.Y H:i') }}
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('tasks.show', $task->id) }}"
                           class="btn btn-sm btn-info"
                           title="Anzeigen">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
