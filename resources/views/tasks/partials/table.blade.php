<div class="table-responsive">

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-start">Aufgabe ID</th>
            <th class="text-start">Aufgabe Type</th>
            <th class="text-start">Aufgabe Status</th>
            <th class="text-start">Bearbeiter</th>
            <th class="text-start">Wohnung</th>
            <th class="text-start">Fällig am</th>
            <th class="text-center">Created</th>
            <th class="text-center">Aktionen</th>
        </tr>
        </thead>

        <tbody>
        @forelse($tasks as $task)
            <tr class="align-middle">

                {{-- ID --}}
                <td>{{ $task->id }}</td>

                {{-- Type --}}
                <td>
                    <span class="fw-semibold">{{ $task->type->name }}</span>
                </td>

                {{-- Status --}}
                <td>
                    <span class="badge"
                          style="background-color: {{ $task->status->color }}; color: white;">
                        {{ $task->status->name }}
                    </span>
                </td>

                {{-- Bearbeiter --}}
                <td>
                    @if($task->activeAssignee)
                        {{ $task->activeAssignee->user->name }}
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>

                {{-- Wohnung --}}
                <td>
                    @if($task->apartment)
                        <a href="{{ route('apartments.show', $task->apartment->id) }}"
                           class="fw-semibold text-decoration-none">
                            {{ $task->apartment->title }}
                        </a>
                        <br>
                        @if($task->apartment->coverImage)
                            <img src="{{ asset('storage/' . $task->apartment->coverImage->path) }}"
                                 class="img-thumbnail img-fluid apartment-cover-thumb mt-1"
                                 alt="{{ $task->apartment->title }}">
                        @else
                            <span class="text-muted small">Kein Bild</span>
                        @endif
                    @else
                        <span class="text-muted">Apartment missing</span>
                    @endif
                </td>

                {{-- Deadline --}}
                <td>
                    @if($task->deadline_at)
                        {{ $task->deadline_at->format('d.m.Y H:i') }}
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>

                {{-- Created --}}
                <td class="text-center">
                    {{ $task->created_at->format('d.m.Y') }}
                </td>

                {{-- Aktionen --}}
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">

                        @if($task->activeAssignee && $task->activeAssignee->user_id === auth()->id())
                            <a href="{{ route('tasks.update', $task->id) }}"
                               class="btn btn-sm btn-warning"
                               title="Bearbeiten">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @else
                            <a href="{{ route('tasks.show', $task->id) }}"
                               class="btn btn-sm btn-info"
                               title="Anzeigen">
                                <i class="bi bi-eye"></i>
                            </a>
                        @endif

                        @if(auth()->user()->hasPermission('manage_aufgaben'))
                            <form action="{{ route('tasks.destroy', $task->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Aufgabe #{{ $task->id }} wirklich löschen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Löschen">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif

                    </div>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i>
                    No tasks found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links() }}
    </div>

</div>
