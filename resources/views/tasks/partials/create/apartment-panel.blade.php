{{-- LEFT PANEL - Wohnung wählen --}}
<div class="col-md-4">
    <div class="card mb-3">
        <div class="card-body">
            <label for="apartmentSelect" class="form-label fw-semibold">
                Wohnung wählen <span class="text-danger">*</span>
            </label>
            <select
                id="apartmentSelect"
                name="apartment_id"
                class="form-select @error('apartment_id') is-invalid @enderror"
                required
            >
                <option value="">— Bitte wählen —</option>
                @foreach($apartments as $apartment)
                    <option
                        value="{{ $apartment->id }}"
                        {{ old('apartment_id') == $apartment->id ? 'selected' : '' }}
                    >
                        {{ $apartment->title }} — {{ $apartment->street_address }}, {{ $apartment->city }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="apartmentSelect-error" @error('apartment_id') data-server-error="1" @enderror>
                @error('apartment_id'){{ $message }}@else Bitte eine Wohnung auswählen. @enderror
            </div>
        </div>
    </div>
</div>
