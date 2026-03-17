<!--begin::My Tasks-->
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Ihre neuen Aufgaben</h5>
        </div>
        <div class="card-body p-0">

            <ul class="list-group list-group-flush">
                @forelse($meineAufgaben as $aufgabe)
                    <a href="{{ route('tasks.show', $aufgabe->id) }}"
                       class="list-group-item list-group-item-action px-3 py-2 text-decoration-none text-dark">
                        <div class="d-flex align-items-center gap-3">

                            <div style="width: 4px; height: 40px; border-radius: 2px; background-color: {{ $aufgabe->status->color }}; flex-shrink: 0;"></div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 0.875rem;">
                                    {{ $aufgabe->type->name }}
                                </div>
                                <small class="text-muted">
                                    {{ $aufgabe->apartment?->title ?? '—' }}
                                </small>
                            </div>

                            <small class="text-muted">
                                Zugewiesen am {{ $aufgabe->created_at->format('d.m.Y') }}
                            </small>

                        </div>
                    </a>
                @empty
                    <li class="list-group-item py-5 text-center">
                        <i class="bi bi-check2-circle text-success" style="font-size: 2rem;"></i>
                        <div class="mt-2 fw-semibold">Keine neuen Aufgaben</div>
                        <small class="text-muted">Ihnen wurden noch keine Aufgaben zugewiesen.</small>
                    </li>
                @endforelse
            </ul>

        </div>
        <div class="card-footer clearfix">
            <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary float-end">Meine Aufgaben anzeigen</a>
        </div>
    </div>
</div>
<!--end::My Tasks-->
