@if(auth()->user()->hasPermission('manage_wohnungen'))
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-grid gap-2">
                <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Wohnung bearbeiten
                </a>

                <form method="POST"
                      action="{{ route('apartments.destroy', $apartment->id) }}"
                      onsubmit="return confirm('Sind Sie sicher, dass Sie diese Wohnung löschen möchten?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-trash"></i> Wohnung löschen
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
