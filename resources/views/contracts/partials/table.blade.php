<div class="table-responsive">

    <form method="GET" action="{{ route('contracts.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-start">ID</th>
            <th class="text-start">Wohnung</th>
            <th class="text-start">Mieter</th>
            <th class="text-start">Status</th>
            <th class="text-start">Mietbeginn</th>
            <th class="text-start">Mietende</th>
            <th class="text-center">Aktionen</th>
        </tr>

        @include('contracts.partials.table-filters')
        </thead>

        <tbody>
        @forelse($contracts as $contract)
            @include('contracts.partials.table-row')
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i>
                    @if(request()->hasAny(['apartment', 'interested_person', 'status']))
                        Keine Verträge mit diesen Filtern gefunden
                    @else
                        Keine Verträge gefunden
                    @endif
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
