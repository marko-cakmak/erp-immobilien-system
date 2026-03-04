<div class="table-responsive">

    <form method="GET" action="{{ route('apartments.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
        {{-- Header Row --}}
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

        {{-- Search Row --}}
        <tr class="table-light">
            {{-- Wohnung --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="title"
                       value="{{ request('title') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Interne Nr. --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="internal_number"
                       value="{{ request('internal_number') }}"
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

            {{-- Interessenten --}}
            <th></th>

            {{-- Aufgaben --}}
            <th></th>

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
                @if(request()->hasAny(['internal_number', 'title', 'address', 'rooms', 'status']))
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

                {{-- Wohnung (Titel + Bild) --}}
                <td class="text-start" data-label="Wohnung">
                    <span class="fw-semibold">{{ $apartment->title }}</span>
                    <br>
                    @if($apartment->coverImage)
                        <img src="{{ asset('storage/' . $apartment->coverImage->path) }}"
                             class="img-thumbnail img-fluid apartment-cover-thumb mt-1"
                             alt="{{ $apartment->title }}">
                    @else
                        <span class="text-muted small">Kein Bild</span>
                    @endif
                </td>

                {{-- Internal Number --}}
                <td class="text-start" data-label="Interne Nr.">
                    <span class="badge bg-light text-dark border">{{ $apartment->internal_number }}</span>
                </td>

                {{-- Adresse (Straße + PLZ + Stadt) --}}
                <td class="text-start" data-label="Adresse">
                    {{ $apartment->street_address }}<br>
                    <small class="text-muted">{{ $apartment->postal_code }} {{ $apartment->city }}</small>
                </td>

                {{-- Rooms --}}
                <td class="text-center" data-label="Zimmer">{{ $apartment->rooms }}</td>

                {{-- Interessenten --}}
                <td class="text-center" data-label="Interessenten">
                    @if($apartment->interested_persons_count > 0)
                        <span class="badge bg-primary">{{ $apartment->interested_persons_count }}</span>
                    @else
                        <span class="text-muted">0</span>
                    @endif
                </td>

                {{-- Aufgaben --}}
                <td class="text-center" data-label="Aufgaben">
                    @if($apartment->tasks_count > 0)
                        <span class="badge bg-primary">{{ $apartment->tasks_count }}</span>
                    @else
                        <span class="text-muted">0</span>
                    @endif
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
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i>
                    @if(request()->hasAny(['internal_number', 'title', 'address', 'rooms', 'status']))
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
