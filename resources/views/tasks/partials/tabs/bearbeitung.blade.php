<div class="card shadow-sm">
    <div class="card-body">

        @if($task->type->key === 'besichtigung')

            <div class="text-muted">
                Derzeit sind keine Informationen zur Besichtigung vorhanden.
            </div>

        @else

            <div class="text-muted">
                Für diesen Aufgabentyp ist noch keine Bearbeitungsansicht definiert.
            </div>

        @endif

    </div>
</div>
