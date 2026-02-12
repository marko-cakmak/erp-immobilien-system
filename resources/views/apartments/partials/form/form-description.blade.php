<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Beschreibung</h3>
    </div>
    <div class="card-body">
        <textarea class="form-control @error('notes') is-invalid @enderror"
                  name="notes"
                  rows="6">{{ old('notes', $apartment->notes ?? '') }}
        </textarea>
        @error('notes')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
