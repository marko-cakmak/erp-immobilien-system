<tr class="align-middle">

    <td class="text-start" data-label="Wohnung">

        <a href="{{ route('apartments.show',$apartment->id) }}"
           class="apartment-link fw-semibold">

            {{ $apartment->title }}

        </a>

        <br>

        @if($apartment->coverImage)

            <img src="{{ asset('storage/'.$apartment->coverImage->path) }}"
                 class="img-thumbnail img-fluid apartment-cover-thumb mt-1"
                 alt="{{ $apartment->title }}">

        @else

            <span class="text-muted small">Kein Bild</span>

        @endif

    </td>

    <td class="text-start" data-label="Interne Nr.">

<span class="badge bg-light text-dark border">

{{ $apartment->internal_number }}

</span>

    </td>

    <td class="text-start" data-label="Adresse">

        {{ $apartment->street_address }}

        <br>

        <small class="text-muted">

            {{ $apartment->postal_code }} {{ $apartment->city }}

        </small>

    </td>

    <td class="text-center" data-label="Zimmer">

        {{ $apartment->rooms }}

    </td>

    <td class="text-center" data-label="Interessenten">

<span class="badge bg-primary-subtle text-dark">

{{ $apartment->interested_persons_count ?? 0 }}

</span>

    </td>

    <td class="text-center" data-label="Aufgaben">

<span class="badge bg-primary-subtle text-dark">

{{ $apartment->tasks_count ?? 0 }}

</span>

    </td>

    <td class="text-center" data-label="Status">

<span class="badge" style="background-color: {{ $apartment->status->color }};">
    {{ $apartment->status->label }}
</span>

    </td>

    <td class="text-center" data-label="Aktionen">

        <div class="d-flex justify-content-center gap-1">

            <a href="{{ route('apartments.show',$apartment->id) }}"
               class="btn btn-sm btn-info">

                <i class="bi bi-eye"></i>

            </a>

            <a href="{{ route('apartments.edit',$apartment->id) }}"
               class="btn btn-sm btn-warning">

                <i class="bi bi-pencil"></i>

            </a>

            <form method="POST"
                  action="{{ route('apartments.destroy',$apartment->id) }}"
                  onsubmit="return confirm('Sind Sie sicher, dass Sie diese Wohnung löschen möchten?')"
                  class="d-inline">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-sm btn-danger">

                    <i class="bi bi-trash"></i>

                </button>

            </form>

        </div>

    </td>

</tr>
