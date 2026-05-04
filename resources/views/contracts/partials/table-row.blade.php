<tr class="align-middle" style="background-color: {{ $contract->status->color }}">

    <td data-label="ID">{{ $contract->id }}</td>

    <td data-label="Wohnung">
        @if($contract->apartment)
            <a href="{{ route('apartments.show', $contract->apartment->id) }}" class="link-primary">
                {{ $contract->apartment->title }}
            </a>
        @else
            <span class="text-muted">—</span>
        @endif
    </td>

    <td data-label="Mieter">
        {{ $contract->interestedPerson->full_name }}
    </td>

    <td data-label="Status">
        {{ $contract->status->name }}
    </td>

    <td data-label="Mietbeginn">
        {{ $contract->start_date->format('d.m.Y') }}
    </td>

    <td data-label="Mietende">
        @if($contract->end_date)
            {{ $contract->end_date->format('d.m.Y') }}
        @else
            <span class="text-muted">Unbefristet</span>
        @endif
    </td>

    <td class="text-center" data-label="Aktionen">
        <div class="d-flex justify-content-center gap-1">

            <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-sm btn-info" title="Ansehen">
                <i class="bi bi-eye"></i>
            </a>

            @if(auth()->user()->hasPermission('manage_contracts'))
                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-sm btn-warning"
                   title="Bearbeiten">
                    <i class="bi bi-pencil"></i>
                </a>

                <form method="POST"
                      action="{{ route('contracts.destroy', $contract->id) }}"
                      onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Vertrag löschen möchten?')"
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
