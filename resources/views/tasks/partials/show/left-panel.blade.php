{{-- LEFT PANEL: Wohnung + Interessenten --}}
<div class="col-md-5">
    @include('tasks.partials.apartment-card', [
        'task' => $task
    ])

    @include('apartments.partials.interessenten-list', [
        'mode'          => 'show',
        'interessenten' => $interessenten
    ])
</div>
