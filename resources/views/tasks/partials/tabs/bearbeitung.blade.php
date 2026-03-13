<link rel="stylesheet" href="{{ asset('css/task/task-besichtigung.css') }}">

<div class="p-3 task-card-body">

    @if($task->type->key === 'besichtigung')
        @include('tasks.partials.tabs.types.besichtigung')
    @elseif($task->type->key === 'reparatur')
        @include('tasks.partials.tabs.types.reparatur')
    @else
        <div class="text-muted">
            Für diesen Aufgabentyp ist noch keine Bearbeitungsansicht definiert.
        </div>
    @endif

</div>
<script src="{{ asset('js/task/task-besichtigung.js') }}"></script>
<script src="{{ asset('js/task/task-edit.js') }}"></script>
