<div class="col-md-8">
    <div class="card mb-3">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Vertrag bearbeiten
            </h3>
            <span class="badge rounded-pill"
                  style="background-color: {{ $contract->status->color }}; color: #fff;">
                {{ $contract->status->name }}
            </span>
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
                           value="{{ old('start_date', $contract->start_date->format('Y-m-d')) }}"
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
                           value="{{ old('end_date', $contract->end_date?->format('Y-m-d')) }}"
                           autocomplete="off"
                        {{ $contract->end_date ? '' : 'disabled' }}>
                    <div class="form-check mt-1">
                        <input class="form-check-input"
                               type="checkbox"
                               id="unbefristet"
                               onchange="toggleEndDate(this)"
                            {{ !$contract->end_date ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small" for="unbefristet">
                            Unbefristet
                        </label>
                    </div>
                    @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ $contract->contract_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('contract_status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                              maxlength="2000">{{ old('notes', $contract->notes) }}</textarea>
                    <div class="form-text text-end">
                        <span id="charCount">{{ strlen($contract->notes ?? '') }}</span> / 2000
                    </div>
                    @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-danger me-2">
                <i class="bi bi-x me-1"></i> Abbrechen
            </a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i> Speichern
            </button>
        </div>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/contract/edit.js') }}"></script>
@endpush
