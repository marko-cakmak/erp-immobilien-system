<div class="table-responsive">

    <form method="GET" action="{{ route('interested-persons.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-start">Name</th>
            <th class="text-start">E-Mail</th>
            <th class="text-start">Telefon</th>
            <th class="text-start">Adresse</th>
            <th class="text-center">Interessierte Wohnungen</th>
            <th class="text-center">Aktionen</th>
        </tr>

        @include('interested-persons.partials.table-filters')
        </thead>

        <tbody>
        @forelse($persons as $person)
            @include('interested-persons.partials.table-row')
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i>
                    @if(request()->hasAny(['name','email','phone','address','city','is_active']))
                        Keine Interessenten mit diesen Filtern gefunden
                    @else
                        Keine Interessenten gefunden
                    @endif
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
