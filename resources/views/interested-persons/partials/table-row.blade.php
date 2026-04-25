<tr class="align-middle">

    <td class="text-start" data-label="Name">
        <span class="fw-semibold">{{ $person->full_name }}</span>
    </td>

    <td class="text-start" data-label="E-Mail">
        {{ $person->email }}
    </td>

    <td class="text-start" data-label="Telefon">
        {{ $person->phone }}
    </td>

    <td class="text-start" data-label="Adresse">
        @if($person->street_address)
            {{ $person->street_address }}
            <br>
            <small class="text-muted">{{ $person->postal_code }}</small>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>

    <td class="text-center" data-label="Stadt">
        {{ $person->city ?? '-' }}
    </td>

    <td class="text-center" data-label="Interessierte Wohnungen">
        <span class="badge bg-primary-subtle text-dark">
            {{ $person->apartments->count() }}
        </span>
    </td>

    <td class="text-center" data-label="Status">
        <span class="badge bg-{{ $person->is_active ? 'success' : 'secondary' }}">
            {{ $person->is_active ? 'Aktiv' : 'Inaktiv' }}
        </span>
    </td>

    <td class="text-center" data-label="Aktionen">
        <div class="d-flex justify-content-center gap-1">

            <a href="{{ route('interested-persons.show', $person->id) }}" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i>
            </a>

            @if(auth()->user()->hasPermission('manage_interessenten'))
                <a href="{{ route('interested-persons.edit', $person->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>

                <form method="POST"
                      action="{{ route('interested-persons.destroy', $person->id) }}"
                      onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Interessenten löschen möchten?')"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif

        </div>
    </td>

</tr>
