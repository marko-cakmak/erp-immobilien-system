@extends('layouts.admin')

@section('title', 'Aufgabe Anzeigen')
@section('hide-page-header', true)

<link rel="stylesheet" href="{{ asset('css/task/task-tabs.css') }}">

@php
    $isActiveAssignee = $task->activeAssignee?->user_id === auth()->id();
@endphp

@section('content')

    @include('tasks.partials.header', [
        'title' =>  "",
        'buttonText' => 'Zurück',
        'buttonIcon' => 'arrow-left',
        'buttonUrl' => route('tasks.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('tasks.partials.alerts')

            <div class="row">

                {{-- LEFT: Wohnung --}}
                <div class="col-md-5">
                    @include('tasks.partials.apartment-card', [
                        'task' => $task
                    ])

                    @include('apartments.partials.interessenten-list', [
                        'mode' => 'show',
                        'interessenten' => $interessenten
                    ])
                </div>

                <div class="col-md-7">

                    {{-- TABOVI IZVAN CARDA --}}
                    <div class="task-tabs-container mb-2">
                        <ul class="nav nav-tabs" id="taskTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active"
                                        id="info-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#info"
                                        type="button"
                                        role="tab">
                                    Aufgabeninformationen
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                        id="bearbeitung-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#bearbeitung"
                                        type="button"
                                        role="tab">
                                    Aufgabenbearbeitung
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card shadow-sm task-card-wrapper">
                        <div class="card-body">

                            {{-- TAB CONTENT --}}
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    @include('tasks.partials.tabs.information', [
                                        'task' => $task,
                                        'users' => $users,
                                        'statuses' => $statuses,
                                        'isActiveAssignee' => $isActiveAssignee
                                    ])
                                </div>

                                <div class="tab-pane fade" id="bearbeitung" role="tabpanel">
                                    @include('tasks.partials.tabs.bearbeitung', [
                                        'task' => $task,
                                        'isActiveAssignee' => $isActiveAssignee,
                                        'interessenten' => $interessenten,
                                        'statuses' => $statuses
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
