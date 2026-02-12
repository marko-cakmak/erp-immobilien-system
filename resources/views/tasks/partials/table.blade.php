<div class="table-responsive">

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-start">Aufgabe ID</th>
            <th class="text-start">Aufgabe Type</th>
            <th class="text-start">Aufgabe Status</th>
            <th class="text-start">Apartment Bild</th>
            <th class="text-start">Apartment Titel</th>
            <th class="text-start">Aufgabe Deadline</th>
            <th class="text-center">Created</th>
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

                {{-- Image --}}
                <td>
                    @if($task->apartment && $task->apartment->coverImage)
                        <img src="{{ asset('storage/' . $task->apartment->coverImage->path) }}"
                             class="img-thumbnail img-fluid apartment-cover-thumb"
                             alt="{{ $task->apartment->title }}">
                    @else
                        <span class="text-muted small">Kein Bild</span>
                    @endif
                </td>

                {{-- Title --}}
                <td>
                    @if($task->apartment)
                        <span class="fw-semibold">
                            {{ $task->apartment->title }}
                        </span>
                        <br>
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
                <td>
                    {{ $task->created_at->format('d.m.Y') }}
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
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
