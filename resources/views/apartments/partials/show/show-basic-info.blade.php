<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Grundinformationen</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm table-borderless">

            {{-- Titel --}}
            <tr>
                <td class="text-muted">Titel:</td>
                <td><strong>{{ $apartment->title }}</strong></td>
            </tr>

            {{-- Interne Nr --}}
            <tr>
                <td class="text-muted">Interne Nr.:</td>
                <td><strong>{{ $apartment->internal_number }}</strong></td>
            </tr>

            {{-- Wohnungsstatus --}}
            <tr>
                <td class="text-muted">Wohnungsstatus:</td>
                <td>
                    <span class="badge" style="background-color: {{ $apartment->status->color ?? '#6c757d' }};">
                        {{ $apartment->status->label }}
                    </span>
                </td>
            </tr>

            {{-- Adresse --}}
            <tr>
                <td class="text-muted">Adresse:</td>
                <td>
                    {{ $apartment->street_address }},
                    {{ $apartment->postal_code }} {{ $apartment->city }}
                    @if($apartment->state)
                        , {{ $apartment->state }}
                    @endif
                </td>
            </tr>

            {{-- Zimmer --}}
            <tr>
                <td class="text-muted">Zimmer:</td>
                <td>{{ $apartment->rooms }}</td>
            </tr>

            {{-- Größe --}}
            <tr>
                <td class="text-muted">Größe:</td>
                <td>{{ number_format($apartment->size_sqm, 2) }} m²</td>
            </tr>

            {{-- Etage --}}
            <tr>
                <td class="text-muted">Etage:</td>
                <td>{{ $apartment->floor ?? 'N/A' }}</td>
            </tr>

            {{-- Baujahr --}}
            <tr>
                <td class="text-muted">Baujahr:</td>
                <td>{{ $apartment->year_built ?? 'N/A' }}</td>
            </tr>

        </table>
    </div>
</div>
