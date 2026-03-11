<div class="table-responsive">

    <form method="GET" action="{{ route('tasks.index') }}" id="searchForm"></form>

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

            @include('tasks.partials.table-filters')
        </thead>

        <tbody>
            @forelse($tasks as $task)
                @include('tasks.partials.table-row')
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
