<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-start">Bild</th>
            <th class="text-start">Interne Nr.</th>
            <th class="text-start">Titel</th>
            <th class="text-start">Adresse</th>
            <th class="text-center">Stadt</th>
            <th class="text-center">Zimmer</th>
            <th class="text-center">Größe (m²)</th>
            <th class="text-center">Kaltmiete</th>
            <th class="text-center">Warmmiete</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        @forelse($apartments as $apartment)
            @include('apartments.partials.table-row', ['apartment' => $apartment])
        @empty
            <tr>
                <td colspan="11" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Keine Wohnungen gefunden
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
