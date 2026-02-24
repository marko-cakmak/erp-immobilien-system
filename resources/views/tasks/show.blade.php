@extends('layouts.admin')

@section('title', 'Aufgabe Anzeigen')
@section('hide-page-header', true)

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

                {{-- RIGHT: TASK TABS --}}
                <div class="col-md-7">
                    <div class="card shadow-sm">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs border-0" id="taskTabs" role="tablist">
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

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    @include('tasks.partials.tabs.information', [
                                        'task' => $task,
                                        'users' => $users,
                                        'statuses' => $statuses
                                    ])
                                </div>
                                <div class="tab-pane fade" id="bearbeitung" role="tabpanel">
                                    @include('tasks.partials.tabs.bearbeitung', [
                                        'task' => $task
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
