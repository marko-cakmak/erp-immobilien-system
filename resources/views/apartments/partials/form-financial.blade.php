<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Finanzielle Details</h3>
    </div>
    <div class="card-body">

        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-muted">Kaltmiete (€):</label>
            <div class="col-sm-8">
                <input type="number"
                       step="0.01"
                       class="form-control"
                       name="rent_cold"
                       value="{{ old('rent_cold', $apartment->rent_cold ?? '') }}"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-muted">Warmmiete (€):</label>
            <div class="col-sm-8">
                <input type="number"
                       step="0.01"
                       class="form-control"
                       name="rent_warm"
                       value="{{ old('rent_warm', $apartment->rent_warm ?? '') }}"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-4 col-form-label text-muted">Kaution (€):</label>
            <div class="col-sm-8">
                <input type="number"
                       step="0.01"
                       class="form-control"
                       name="deposit"
                       value="{{ old('deposit', $apartment->deposit ?? '') }}"
                       required>
            </div>
        </div>

    </div>
</div>
