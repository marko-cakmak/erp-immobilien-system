@extends('layouts.admin')

@section('title', 'Aufgabe Anzeigen')
@section('hide-page-header', true)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/task/task-tabs.css') }}">
@endpush

@php
    $isActiveAssignee = $task->activeAssignee?->user_id === auth()->id();
@endphp

@section('content')

    @include('tasks.partials.header', [
        'title'       => '',
        'buttonText'  => 'Zurück',
        'buttonIcon'  => 'arrow-left',
        'buttonUrl'   => route('tasks.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('tasks.partials.alerts')

            <div class="row">
                @include('tasks.partials.show.left-panel')
                @include('tasks.partials.show.right-panel')
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/task/task-show.js') }}"></script>
@endpush
