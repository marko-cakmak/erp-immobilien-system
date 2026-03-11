<div class="table-responsive">

    <form method="GET" action="{{ route('apartments.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-start">Wohnung</th>
                <th class="text-start">Interne Nr.</th>
                <th class="text-start">Adresse</th>
                <th class="text-center">Zimmer</th>
                <th class="text-center">Interessenten</th>
                <th class="text-center">Aufgaben</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aktionen</th>
            </tr>

            @include('apartments.partials.table-filters')
        </thead>

        <tbody>
            @forelse($apartments as $apartment)
                @include('apartments.partials.table-row')
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-inbox"></i>
                        @if(request()->hasAny(['internal_number','title','address','rooms','status']))
                            Keine Wohnungen mit diesen Filtern gefunden
                        @else
                            Keine Wohnungen gefunden
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
