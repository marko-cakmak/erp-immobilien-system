<tr class="align-middle apartment-row"
    data-status-color="{{ $apartment->status->color }}"
    style="background-color: {{ $apartment->status->color }}">

    <td class="text-start" data-label="Wohnung">
        <a href="{{ route('apartments.show', $apartment->id) }}" class="link-primary">
            {{ $apartment->title }}
        </a>
    </td>

    <td class="text-start" data-label="Interne Nr.">
        {{ $apartment->internal_number }}
    </td>

    <td class="text-start" data-label="Adresse">
        {{ $apartment->street_address }}, {{ $apartment->postal_code }} {{ $apartment->city }}
    </td>

    <td class="text-center" data-label="Zimmer">
        {{ $apartment->rooms }}
    </td>

    <td class="text-center" data-label="Interessenten">
        {{ $apartment->interested_persons_count ?? 0 }}
    </td>

    <td class="text-center" data-label="Aufgaben">
        {{ $apartment->tasks_count ?? 0 }}
    </td>

    <td class="text-center" data-label="Status">
        {{ $apartment->status->label }}
    </td>

    <td class="text-center" data-label="Aktionen">
        <div class="d-flex justify-content-center gap-1">

            <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i>
            </a>

            @if(auth()->user()->hasPermission('manage_wohnungen'))
                <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>

                <form method="POST"
                      action="{{ route('apartments.destroy', $apartment->id) }}"
                      onsubmit="return confirm('Sind Sie sicher, dass Sie diese Wohnung löschen möchten?')"
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
