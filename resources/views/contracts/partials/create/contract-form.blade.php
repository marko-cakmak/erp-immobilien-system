{{-- RIGHT PANEL - Vertrag Formular --}}
<div class="col-md-8">
    <div class="card mb-3">

        <div class="card-header">
            <h3 class="card-title mb-0">Vertrag erstellen</h3>
        </div>

        <div class="card-body">
            <div class="row">

                {{-- Mietbeginn --}}
                <div class="col-md-6 mb-3">
                    <label for="startDate" class="form-label fw-semibold">
                        Mietbeginn <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="start_date"
                           id="startDate"
                           class="form-control js-date-only @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date') }}"
                           autocomplete="off"
                           required>
                    @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mietende --}}
                <div class="col-md-6 mb-3">
                    <label for="endDate" class="form-label fw-semibold">
                        Mietende
                    </label>
                    <input type="text"
                           name="end_date"
                           id="endDate"
                           class="form-control js-date-only @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date') }}"
                           autocomplete="off">
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="unbefristet" onchange="toggleEndDate(this)">
                        <label class="form-check-label text-muted small" for="unbefristet">
                            Unbefristet
                        </label>
                    </div>
                    @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kaltmiete --}}
                <div class="col-md-6 mb-3">
                    <label for="rentCold" class="form-label fw-semibold">Kaltmiete</label>
                    <div class="input-group">
                        <input type="number" step="0.01" id="rentCold" class="form-control" placeholder="—" readonly>
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                {{-- Warmmiete --}}
                <div class="col-md-6 mb-3">
                    <label for="rentWarm" class="form-label fw-semibold">Warmmiete</label>
                    <div class="input-group">
                        <input type="number" step="0.01" id="rentWarm" class="form-control" placeholder="—" readonly>
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                {{-- Kaution --}}
                <div class="col-md-6 mb-3">
                    <label for="deposit" class="form-label fw-semibold">Kaution</label>
                    <div class="input-group">
                        <input type="number" step="0.01" id="deposit" class="form-control" placeholder="—" readonly>
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                {{-- Vertragsstatus --}}
                <div class="col-md-6 mb-3">
                    <label for="contractStatus" class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="contract_status_id"
                            id="contractStatus"
                            class="form-select @error('contract_status_id') is-invalid @enderror"
                            required>
                        <option value="">— Bitte wählen —</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('contract_status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('contract_status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-2">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> Kaltmiete, Warmmiete und Kaution werden automatisch aus der
                        Wohnung übernommen
                    </small>
                </div>

                {{-- Notizen --}}
                <div class="col-md-12 mb-3">
                    <label for="notesInput" class="form-label fw-semibold">
                        Notizen
                    </label>
                    <textarea rows="4"
                              name="notes"
                              id="notesInput"
                              class="form-control @error('notes') is-invalid @enderror"
                              placeholder="Zusätzliche Informationen zum Vertrag..."
                              maxlength="2000">{{ old('notes') }}</textarea>
                    <div class="form-text text-end">
                        <span id="charCount">0</span> / 2000
                    </div>
                    @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="card-footer text-end bg-white">
            <a href="{{ route('contracts.index') }}" class="btn btn-danger me-2">
                Abbrechen
            </a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i>
                Vertrag speichern
            </button>
        </div>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/contract/date-picker.js') }}"></script>
    <script>
        function toggleEndDate(checkbox) {
            const endDate = document.getElementById('endDate');
            if (checkbox.checked) {
                endDate._flatpickr?.clear();
                endDate._flatpickr?.destroy();
                endDate.disabled = true;
                endDate.value = '';
            } else {
                endDate.disabled = false;
                flatpickr(endDate, {
                    enableTime: false,
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'd.m.Y',
                    locale: 'de',
                });
            }
        }
    </script>
@endpush


