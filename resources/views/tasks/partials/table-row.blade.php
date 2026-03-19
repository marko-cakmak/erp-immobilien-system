<tr class="align-middle" style="background-color: {{ $task->status->color }}80;">

    <td data-label="Aufgabe ID">{{ $task->id }}</td>

    <td data-label="Aufgabe Type">{{ $task->type->name }}</td>

    <td data-label="Aufgabe Status">{{ $task->status->name }}</td>

    <td data-label="Bearbeiter">
        @if($task->activeAssignee)
            {{ $task->activeAssignee->user->name }}
        @else
            <span class="text-muted">—</span>
        @endif
    </td>

    <td data-label="Wohnung">
        @if($task->apartment)
            <a href="{{ route('apartments.show', $task->apartment->id) }}" class="apartment-link">
                {{ $task->apartment->title }}
            </a>
        @else
            <span class="text-muted">Keine Wohnung</span>
        @endif
    </td>

    <td data-label="Fällig am">
        @if($task->deadline_at)
            {{ $task->deadline_at->format('d.m.Y H:i') }}
        @else
            <span class="text-muted">—</span>
        @endif
    </td>

    <td class="text-center" data-label="Aktionen">
        <div class="d-flex justify-content-center gap-1">

            @if($task->activeAssignee?->user_id === auth()->id())
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-warning" title="Bearbeiten">
                    <i class="bi bi-pencil"></i>
                </a>
            @else
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info" title="Anzeigen">
                    <i class="bi bi-eye"></i>
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_aufgaben'))
                <form action="{{ route('tasks.destroy', $task->id) }}"
                      method="POST"
                      onsubmit="return confirm('Aufgabe #{{ $task->id }} wirklich löschen?')"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Löschen">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif

        </div>
    </td>

</tr>
