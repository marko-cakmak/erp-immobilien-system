@extends('layouts.admin')

@section('title', 'Aufgabe erstellen')
@section('hide-page-header', true)

@section('content')

    @include('tasks.partials.header', [
        'title' => 'Neue Aufgabe',
        'buttonText' => 'Zurück',
        'buttonIcon' => 'arrow-left',
        'buttonUrl' => route('tasks.index')
    ])

    <div class="app-content">
        <div class="container-fluid px-4 pt-4">

            <form method="POST" action="{{ route('tasks.store') }}" id="taskForm" novalidate>
                @csrf
                <div class="row">
                    @include('tasks.partials.create.apartment-panel')
                    @include('tasks.partials.create.task-form')
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/tasks/task-create.js') }}"></script>
@endpush
