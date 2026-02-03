<div class="table-responsive">

    <form method="GET" action="{{ route('interested-persons.index') }}" id="searchForm"></form>

    <table class="table table-bordered table-hover">
        <thead>
        {{-- Header Row --}}
        <tr>
            <th class="text-start">Name</th>
            <th class="text-start">E-Mail</th>
            <th class="text-start">Telefon</th>
            <th class="text-start">Adresse</th>
            <th class="text-center">Stadt</th>
            <th class="text-center">Interessierte Wohnungen</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aktionen</th>
        </tr>

        {{-- Search Row --}}
        <tr class="table-light">
            {{-- Name --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="name"
                       value="{{ request('name') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- E-Mail --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="email"
                       value="{{ request('email') }}"
                       placeholder="Suchen..."
                       onchange="document.getElementById('searchForm').submit()">
            </th>

            {{-- Telefon --}}
            <th>
                <input form="searchForm" type="text"
                       class="form-control form-control-sm"
                       name="phone"
                       value="{{ request('phone') }}"
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

            {{-- Interessierte Wohnungen --}}
            <th></th>

            {{-- Status --}}
            <th>
                <select form="searchForm"
                        class="form-select form-select-sm"
                        name="is_active"
                        onchange="document.getElementById('searchForm').submit()">
                    <option value="">Alle</option>
                    <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktiv</option>
                    <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inaktiv</option>
                </select>
            </th>

            {{-- Aktionen (Reset button) --}}
            <th class="text-center">
                @if(request()->hasAny(['name', 'email', 'phone', 'address', 'city', 'is_active']))
                    <a href="{{ route('interested-persons.index') }}"
                       class="btn btn-sm btn-secondary"
                       title="Filter zurücksetzen">
                        <i class="bi bi-x-circle"></i>
                    </a>
                @endif
            </th>
        </tr>
        </thead>

        <tbody>
        @forelse($persons as $person)
            <tr class="align-middle">
                {{-- Name --}}
                <td class="text-start" data-label="Name">
                    <span class="fw-semibold">{{ $person->full_name }}</span>
                </td>

                {{-- Email --}}
                <td class="text-start" data-label="E-Mail">
                    {{ $person->email }}
                </td>

                {{-- Phone --}}
                <td class="text-start" data-label="Telefon">
                    {{ $person->phone }}
                </td>

                {{-- Address --}}
                <td class="text-start" data-label="Adresse">
                    @if($person->street_address)
                        {{ $person->street_address }}<br>
                        <small class="text-muted">{{ $person->postal_code }}</small>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                {{-- City --}}
                <td class="text-center" data-label="Stadt">
                    {{ $person->city ?? '-' }}
                </td>

                {{-- Interested Apartments --}}
                <td class="text-center" data-label="Interessierte Wohnungen">
                    @if($person->apartments->count() > 0)
                        <span class="badge bg-info">{{ $person->apartments->count() }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                {{-- Status --}}
                <td class="text-center" data-label="Status">
                    <span class="badge bg-{{ $person->is_active ? 'success' : 'secondary' }}">
                        {{ $person->is_active ? 'Aktiv' : 'Inaktiv' }}
                    </span>
                </td>

                {{-- Actions --}}
                <td class="text-center" data-label="Aktionen">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="{{ route('interested-persons.show', $person->id) }}"
                           class="btn btn-sm btn-info"
                           title="Anzeigen">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('interested-persons.edit', $person->id) }}"
                           class="btn btn-sm btn-warning"
                           title="Bearbeiten">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form method="POST"
                              action="{{ route('interested-persons.destroy', $person->id) }}"
                              onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Interessenten löschen möchten?')"
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
                    @if(request()->hasAny(['name', 'email', 'phone', 'address', 'city', 'is_active']))
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
