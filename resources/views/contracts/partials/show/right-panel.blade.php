<div class="col-md-8">
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="bi bi-file-earmark-text me-2"></i>Vertragsinformationen
            </h3>
            <span class="badge rounded-pill"
                  style="background-color: {{ $contract->status->color }}; color: #fff;">
                {{ $contract->status->name }}
            </span>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Mietbeginn</label>
                    <div class="fw-semibold">{{ $contract->start_date->format('d.m.Y') }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Mietende</label>
                    <div class="fw-semibold">
                        {{ $contract->end_date ? $contract->end_date->format('d.m.Y') : 'Unbefristet' }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Status</label>
                    <div class="fw-semibold">{{ $contract->status->name }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Erstellt von</label>
                    <div class="fw-semibold">{{ $contract->creator->name }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">Erstellt am</label>
                    <div class="fw-semibold">{{ $contract->created_at->format('d.m.Y H:i') }}</div>
                </div>

                @if($contract->signed_at)
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Unterzeichnet am</label>
                        <div class="fw-semibold">{{ $contract->signed_at->format('d.m.Y H:i') }}</div>
                    </div>
                @endif

                @if($contract->notes)
                    <div class="col-md-12 mb-3">
                        <label class="form-label text-muted small">Notizen</label>
                        <div class="fw-semibold">{{ $contract->notes }}</div>
                    </div>
                @endif

            </div>
        </div>

        <div class="card-footer d-flex align-items-center">
            <a href="{{ route('contracts.preview', $contract->id) }}"
               target="_blank"
               class="btn btn-secondary">
                <i class="bi bi-file-earmark-text me-1"></i> Vorschau / PDF
            </a>

            @if(auth()->user()->hasPermission('manage_contracts'))
                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning ms-auto">
                    <i class="bi bi-pencil me-1"></i> Bearbeiten
                </a>
            @endif
        </div>

    </div>
</div>
