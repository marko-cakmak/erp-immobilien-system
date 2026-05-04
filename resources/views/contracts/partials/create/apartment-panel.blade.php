{{-- LEFT PANEL - Wohnung wählen --}}
<div class="col-md-4">

    {{-- Wohnung --}}
    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label fw-semibold">
                Wohnung wählen <span class="text-danger">*</span>
            </label>
            <div class="input-group mb-1">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                       class="form-control"
                       id="apartmentSearchInput"
                       placeholder="Nach Wohnung suchen..."
                       autocomplete="off"
                       data-url="{{ route('apartments.search') }}">
                <button type="button" class="btn btn-primary" id="apartmentSearchBtn">
                    <i class="bi bi-search"></i> Suchen
                </button>
            </div>
            <small id="apartmentSearchSpinner" class="text-center py-2" style="display: none;">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </small>
            <div id="apartmentResults" class="list-group mt-2"></div>
            <div id="selectedApartmentBox" class="mt-2" style="display: none;">
                <div class="d-flex align-items-center gap-2">
                    <div class="list-group-item list-group-item-success flex-grow-1">
                        <span id="selectedApartmentName"></span>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm py-0 px-1" id="clearApartmentBtn">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="apartment_id" id="apartmentId" value="{{ old('apartment_id') }}">
            @error('apartment_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Interessent --}}
    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label fw-semibold">
                Mieter wählen <span class="text-danger">*</span>
            </label>
            <div class="input-group mb-1">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                       class="form-control"
                       id="personSearchInput"
                       placeholder="Nach Mieter suchen..."
                       autocomplete="off"
                       data-url="{{ route('interested-persons.search') }}">
                <button type="button" class="btn btn-primary" id="personSearchBtn">
                    <i class="bi bi-search"></i> Suchen
                </button>
            </div>
            <small id="personSearchSpinner" class="text-center py-2" style="display: none;">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </small>
            <div id="personResults" class="list-group mt-2"></div>
            <div id="selectedPersonBox" class="mt-2" style="display: none;">
                <div class="d-flex align-items-center gap-2">
                    <div class="list-group-item list-group-item-success flex-grow-1">
                        <span id="selectedPersonName"></span>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm py-0 px-1" id="clearPersonBtn">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="interested_person_id" id="personId" value="{{ old('interested_person_id') }}">
            @error('interested_person_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
