<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Persönliche Informationen</h3>
    </div>
    <div class="card-body">

        {{-- Vorname --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Vorname:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('first_name') is-invalid @enderror"
                       name="first_name"
                       value="{{ old('first_name', $person->first_name ?? '') }}"
                       required>
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Nachname --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Nachname:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('last_name') is-invalid @enderror"
                       name="last_name"
                       value="{{ old('last_name', $person->last_name ?? '') }}"
                       required>
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- E-Mail --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">E-Mail:</label>
            <div class="col-sm-9">
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email', $person->email ?? '') }}"
                       required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Telefon --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Telefon:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('phone') is-invalid @enderror"
                       name="phone"
                       value="{{ old('phone', $person->phone ?? '') }}"
                       required>
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Straße --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Straße:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('street_address') is-invalid @enderror"
                       name="street_address"
                       value="{{ old('street_address', $person->street_address ?? '') }}">
                @error('street_address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- PLZ & Stadt --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">PLZ:</label>
            <div class="col-sm-4">
                <input type="text"
                       class="form-control @error('postal_code') is-invalid @enderror"
                       name="postal_code"
                       value="{{ old('postal_code', $person->postal_code ?? '') }}">
                @error('postal_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <label class="col-sm-2 col-form-label text-muted">Stadt:</label>
            <div class="col-sm-3">
                <input type="text"
                       class="form-control @error('city') is-invalid @enderror"
                       name="city"
                       value="{{ old('city', $person->city ?? '') }}">
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Notizen --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Notizen:</label>
            <div class="col-sm-9">
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          name="notes"
                          rows="4">{{ old('notes', $person->notes ?? '') }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>
