<tr class="align-middle">
    {{-- Image --}}
    <td class="text-start">
        @if($apartment->coverImage)
            <img src="{{ asset('storage/' . $apartment->coverImage->path) }}"
                 class="img-thumbnail img-fluid apartment-cover-thumb"
                 alt="{{ $apartment->title }}">
        @else
            <span class="text-muted small">Kein Bild</span>
        @endif
    </td>

    {{-- Internal Number --}}
    <td class="text-start">
        <span class="badge bg-light text-dark border">{{ $apartment->internal_number }}</span>
    </td>

    {{-- Title --}}
    <td class="text-start">
        <span class="fw-semibold">{{ $apartment->title }}</span>
    </td>

    {{-- Address --}}
    <td class="text-start">
        {{ $apartment->street_address }}<br>
        <small class="text-muted">{{ $apartment->postal_code }}</small>
    </td>

    {{-- City --}}
    <td class="text-center">{{ $apartment->city }}</td>

    {{-- Rooms --}}
    <td class="text-center">{{ $apartment->rooms }}</td>

    {{-- Size --}}
    <td class="text-center">{{ number_format($apartment->size_sqm, 2) }}</td>

    {{-- Cold Rent --}}
    <td class="text-center">
        {{ number_format($apartment->rent_cold, 2) }} €
    </td>

    {{-- Warm Rent --}}
    <td class="text-center">
        {{ number_format($apartment->rent_warm, 2) }} €
    </td>

    {{-- Status --}}
    <td class="text-center">
        <span class="badge bg-{{ $apartment->status->color ?? 'secondary' }}">
            {{ $apartment->status->label }}
        </span>
    </td>

    {{-- Actions --}}
    <td class="text-center">
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
