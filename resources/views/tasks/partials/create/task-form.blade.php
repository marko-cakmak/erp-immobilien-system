{{-- RIGHT PANEL - Aufgabe Formular --}}
<div class="col-md-8">
    <div class="card mb-3">

        <div class="card-header">
            <h3 class="card-title mb-0">Aufgabe erstellen</h3>
        </div>

        <div class="card-body">
            <div class="row">

                {{-- Aufgabentyp --}}
                <div class="col-md-6 mb-3">
                    <label for="typeSelect" class="form-label fw-semibold">
                        Aufgabentyp <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select @error('type_id') is-invalid @enderror"
                        name="type_id"
                        id="typeSelect"
                        required
                    >
                        <option value="">— Bitte wählen —</option>

                        @foreach($types as $type)
                            <option
                                value="{{ $type->id }}"
                                data-key="{{ $type->key }}"
                                {{ old('type_id') == $type->id ? 'selected' : '' }}
                            >
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback" id="typeSelect-error">
                        Bitte einen Aufgabentyp wählen.
                    </div>
                </div>


                {{-- Reparaturtyp --}}
                <div class="col-md-6 mb-3" id="repairTypeWrapper" style="visibility:none;">

                    <label for="repairTypeSelect" class="form-label fw-semibold">
                        Reparaturtyp
                    </label>

                    <select
                        class="form-select @error('repair_type_id') is-invalid @enderror"
                        name="repair_type_id"
                        id="repairTypeSelect"
                        disabled
                    >
                        <option value="">— Bitte wählen —</option>

                        @foreach($repairTypes as $type)
                            <option
                                value="{{ $type->id }}"
                                {{ old('repair_type_id') == $type->id ? 'selected' : '' }}
                            >
                                {{ $type->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- Bearbeiter --}}
                <div class="col-md-6 mb-3">

                    <label for="assignedTo" class="form-label fw-semibold">
                        Bearbeiter <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select @error('assigned_to') is-invalid @enderror"
                        name="assigned_to"
                        id="assignedTo"
                        required
                    >
                        <option value="">— Bitte wählen —</option>

                        @foreach($users as $user)
                            <option
                                value="{{ $user->id }}"
                                {{ old('assigned_to') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback" id="assignedTo-error">
                        Bitte einen Bearbeiter auswählen.
                    </div>

                </div>


                {{-- Fällig am --}}
                <div class="col-md-6 mb-3">

                    <label for="deadlineAt" class="form-label fw-semibold">
                        Fällig am
                    </label>

                    <input
                        type="text"
                        name="deadline_at"
                        id="deadlineAt"
                        class="form-control js-datetime-24h @error('deadline_at') is-invalid @enderror"
                        value="{{ old('deadline_at') }}"
                        autocomplete="off"
                    >

                    <div class="invalid-feedback" id="deadlineAt-error">
                        Das Datum muss in der Zukunft liegen.
                    </div>

                </div>


                {{-- Nachricht --}}
                <div class="col-md-12 mb-3">

                    <label for="messageInput" class="form-label fw-semibold">
                        Aufgabebeschreibung
                    </label>

                    <textarea
                        rows="4"
                        name="message"
                        id="messageInput"
                        class="form-control @error('message') is-invalid @enderror"
                        placeholder="Beschreibung der Aufgabe..."
                        maxlength="2000"
                    >{{ old('message') }}</textarea>

                    <div class="form-text text-end">
                        <span id="charCount">0</span> / 2000
                    </div>

                </div>

            </div>
        </div>


        <div class="card-footer text-end bg-white">

            <a href="{{ route('tasks.index') }}" class="btn btn-danger me-2">
                Abbrechen
            </a>

            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                <i class="bi bi-check-lg me-1"></i>
                Aufgabe speichern
            </button>

        </div>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/task/datetime-picker.js') }}"></script>
@endpush
