<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Grundinformationen</h3>
    </div>
    <div class="card-body">

        {{-- Anzeigenstatus --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Anzeigenstatus:</label>
            <div class="col-sm-9">
                <div class="form-check form-switch mt-1">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                        {{ old('is_active', $apartment->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label text-muted">
                        Anzeige ist aktiv
                    </label>
                </div>
            </div>
        </div>

        {{-- Wohnungsstatus --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Wohnungsstatus:</label>
            <div class="col-sm-9">
                <select class="form-select" name="apartment_status_id" required>
                    @if(!isset($apartment))
                        <option value="">Status auswählen</option>
                    @endif
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('apartment_status_id', $apartment->apartment_status_id ?? '') == $status->id ? 'selected' : '' }}>
                            {{ $status->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Interne Nr --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Interne Nr.:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('internal_number') is-invalid @enderror"
                       name="internal_number"
                       value="{{ old('internal_number', $apartment->internal_number ?? '') }}"
                       required>
                @error('internal_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Titel --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Titel:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       name="title"
                       value="{{ old('title', $apartment->title ?? '') }}"
                       required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Straße --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Straße:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control"
                       name="street_address"
                       value="{{ old('street_address', $apartment->street_address ?? '') }}"
                       required>
            </div>
        </div>

        {{-- PLZ & Stadt --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">PLZ:</label>
            <div class="col-sm-4">
                <input type="text"
                       class="form-control"
                       name="postal_code"
                       value="{{ old('postal_code', $apartment->postal_code ?? '') }}"
                       required>
            </div>
            <label class="col-sm-2 col-form-label text-muted">Stadt:</label>
            <div class="col-sm-3">
                <input type="text"
                       class="form-control"
                       name="city"
                       value="{{ old('city', $apartment->city ?? '') }}"
                       required>
            </div>
        </div>

        {{-- Bundesland --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Bundesland:</label>
            <div class="col-sm-9">
                <input type="text"
                       class="form-control"
                       name="state"
                       value="{{ old('state', $apartment->state ?? '') }}">
            </div>
        </div>

        {{-- Zimmer --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Zimmer:</label>
            <div class="col-sm-9">
                <input type="number"
                       step="0.5"
                       class="form-control"
                       name="rooms"
                       value="{{ old('rooms', $apartment->rooms ?? '') }}"
                       required>
            </div>
        </div>

        {{-- Größe --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Größe (m²):</label>
            <div class="col-sm-9">
                <input type="number"
                       step="0.01"
                       class="form-control"
                       name="size_sqm"
                       value="{{ old('size_sqm', $apartment->size_sqm ?? '') }}"
                       required>
            </div>
        </div>

        {{-- Etage --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Etage:</label>
            <div class="col-sm-9">
                <input type="number"
                       class="form-control"
                       name="floor"
                       value="{{ old('floor', $apartment->floor ?? '') }}">
            </div>
        </div>

        {{-- Baujahr --}}
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label text-muted">Baujahr:</label>
            <div class="col-sm-9">
                <input type="number"
                       class="form-control"
                       name="year_built"
                       value="{{ old('year_built', $apartment->year_built ?? '') }}">
            </div>
        </div>

    </div>
</div>
