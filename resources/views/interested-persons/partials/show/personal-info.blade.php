<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">Vorname:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->first_name }}</p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">Nachname:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->last_name }}</p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">E-Mail:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->email }}</p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">Telefon:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->phone }}</p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">Straße:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->street_address ?? '-' }}</p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">PLZ & Stadt:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">
            @if($person->postal_code || $person->city)
                {{ $person->postal_code }} {{ $person->city }}
            @else
                -
            @endif
        </p>
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-4 col-form-label text-muted">Notizen:</label>
    <div class="col-sm-8">
        <p class="form-control-plaintext">{{ $person->notes ?? '-' }}</p>
    </div>
</div>

<hr>

<div class="d-grid gap-2">
    <a href="{{ route('interested-persons.edit', $person->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil"></i> Interessent bearbeiten
    </a>

    <form method="POST"
          action="{{ route('interested-persons.destroy', $person->id) }}"
          onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Interessenten löschen möchten?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-100">
            <i class="bi bi-trash"></i> Interessent löschen
        </button>
    </form>
</div>
