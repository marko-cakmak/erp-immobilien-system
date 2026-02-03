<div class="table-responsive">

    <form method="GET" action="{{ route('apartments.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
        {{-- Header Row --}}
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

        {{-- Search Row --}}
        <tr class="table-light">
            {{-- Bild --}}
            <th></th>

            {{-- Interne Nr. --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="internal_number"
                       value="{{ request('internal_number') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Titel --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="title"
                       value="{{ request('title') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Adresse --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="address"
                       value="{{ request('address') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Stadt --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="city"
                       value="{{ request('city') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Zimmer --}}
            <th>
                <input form="searchForm" type="number"
                       step="0.5"
                       class="form-control form-control-sm"
                       name="rooms"
                       value="{{ request('rooms') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Größe --}}
            <th>
                <div class="d-flex gap-1">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="size_from"
                           value="{{ request('size_from') }}"
                           placeholder="Von"
                           onchange="document.getElementById('searchForm').submit()">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="size_to"
                           value="{{ request('size_to') }}"
                           placeholder="Bis"
                           onchange="document.getElementById('searchForm').submit()">
                </div>
            </th>

            {{-- Kaltmiete --}}
            <th>
                <div class="d-flex gap-1">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="rent_cold_from"
                           value="{{ request('rent_cold_from') }}"
                           placeholder="Von"
                           onchange="document.getElementById('searchForm').submit()">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="rent_cold_to"
                           value="{{ request('rent_cold_to') }}"
                           placeholder="Bis"
                           onchange="document.getElementById('searchForm').submit()">
                </div>
            </th>

            {{-- Warmmiete --}}
            <th>
                <div class="d-flex gap-1">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="rent_warm_from"
                           value="{{ request('rent_warm_from') }}"
                           placeholder="Von"
                           onchange="document.getElementById('searchForm').submit()">
                    <input form="searchForm" type="number"
                           class="form-control form-control-sm table-filter-range"
                           name="rent_warm_to"
                           value="{{ request('rent_warm_to') }}"
                           placeholder="Bis"
                           onchange="document.getElementById('searchForm').submit()">
                </div>
            </th>

            {{-- Status --}}
            <th>
                <select form="searchForm" class="form-select form-select-sm"
                        name="status"
                        onchange="document.getElementById('searchForm').submit()">
                    <option value="">Alle</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                            {{ $status->label }}
                        </option>
                    @endforeach
                </select>
            </th>

            {{-- Aktionen (Reset button) --}}
            <th class="text-center">
                @if(request()->hasAny([
                    'internal_number','title','address','city','rooms',
                    'size_from','size_to',
                    'rent_cold_from','rent_cold_to',
                    'rent_warm_from','rent_warm_to',
                    'status'
                ]))
                    <a href="{{ route('apartments.index') }}"
                       class="btn btn-sm btn-secondary"
                       title="Filter zurücksetzen">
                        <i class="bi bi-x-circle"></i>
                    </a>
                @endif
            </th>
        </tr>
        </thead>

        <tbody>
        @forelse($apartments as $apartment)
            <tr class="align-middle">
                {{-- Image --}}
                <td class="text-start" data-label="Bild">
                    @if($apartment->coverImage)
                        <img src="{{ asset('storage/' . $apartment->coverImage->path) }}"
                             class="img-thumbnail img-fluid apartment-cover-thumb"
                             alt="{{ $apartment->title }}">
                    @else
                        <span class="text-muted small">Kein Bild</span>
                    @endif
                </td>

                {{-- Internal Number --}}
                <td class="text-start" data-label="Interne Nr.">
                    <span class="badge bg-light text-dark border">{{ $apartment->internal_number }}</span>
                </td>

                {{-- Title --}}
                <td class="text-start" data-label="Titel">
                    <span class="fw-semibold">{{ $apartment->title }}</span>
                </td>

                {{-- Address --}}
                <td class="text-start" data-label="Adresse">
                    {{ $apartment->street_address }}<br>
                    <small class="text-muted">{{ $apartment->postal_code }}</small>
                </td>

                {{-- City --}}
                <td class="text-center" data-label="Stadt">{{ $apartment->city }}</td>

                {{-- Rooms --}}
                <td class="text-center" data-label="Zimmer">{{ $apartment->rooms }}</td>

                {{-- Size --}}
                <td class="text-center" data-label="Größe">{{ number_format($apartment->size_sqm, 2) }} m²</td>

                {{-- Cold Rent --}}
                <td class="text-center" data-label="Kaltmiete">
                    {{ number_format($apartment->rent_cold, 2) }} €
                </td>

                {{-- Warm Rent --}}
                <td class="text-center" data-label="Warmmiete">
                    {{ number_format($apartment->rent_warm, 2) }} €
                </td>

                {{-- Status --}}
                <td class="text-center" data-label="Status">
                    <span class="badge bg-{{ $apartment->status->color ?? 'secondary' }}">
                        {{ $apartment->status->label }}
                    </span>
                </td>

                {{-- Actions --}}
                <td class="text-center" data-label="Aktionen">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="{{ route('apartments.show', $apartment->id) }}"
                           class="btn btn-sm btn-info"
                           title="Anzeigen">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('apartments.edit', $apartment->id) }}"
                           class="btn btn-sm btn-warning"
                           title="Bearbeiten">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form method="POST"
                              action="{{ route('apartments.destroy', $apartment->id) }}"
                              onsubmit="return confirm('Sind Sie sicher, dass Sie diese Wohnung löschen möchten?')"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    title="Löschen">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i>
                    @if(request()->hasAny([
                        'internal_number','title','address','city','rooms',
                        'size_from','size_to',
                        'rent_cold_from','rent_cold_to',
                        'rent_warm_from','rent_warm_to',
                        'status'
                    ]))
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
