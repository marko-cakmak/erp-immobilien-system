<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-person-circle"></i>
            {{ $person->first_name }} {{ $person->last_name }}
        </h3>
    </div>
    <div class="card-body">

        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-muted">Status:</label>
            <div class="col-sm-8">
                <span class="badge bg-{{ $person->is_active ? 'success' : 'secondary' }} mt-2">
                    {{ $person->is_active ? 'Aktiv' : 'Inaktiv' }}
                </span>
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

    </div>
</div>
