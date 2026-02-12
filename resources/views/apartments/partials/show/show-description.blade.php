<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Beschreibung</h3>
    </div>
    <div class="card-body">
        @if($apartment->notes)
            <p>{{ $apartment->notes }}</p>
        @else
            <p class="text-muted">Keine Beschreibung vorhanden</p>
        @endif
    </div>
</div>
