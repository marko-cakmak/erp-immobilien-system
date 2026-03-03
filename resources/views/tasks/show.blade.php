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
                        <div class="card-body p-0">

                            {{-- TAB CONTENT --}}
                            <div class="tab-content">

                                <div class="tab-pane fade show active p-3" id="info" role="tabpanel"
                                     style="position: relative;">
                                    @if(auth()->check() && !auth()->user()->hasPermission('manage_aufgaben'))
                                        <div
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(150, 150, 150, 0.15); z-index: 10; cursor: not-allowed; pointer-events: all;"></div>
                                    @endif
                                    @include('tasks.partials.tabs.information', [
                                        'task' => $task,
                                        'users' => $users,
                                        'statuses' => $statuses,
                                        'isActiveAssignee' => $isActiveAssignee
                                    ])
                                </div>

                                <div class="tab-pane fade p-3" id="bearbeitung" role="tabpanel"
                                     style="position: relative;">
                                    @if($task->type->key === 'besichtigung' && !$isActiveAssignee)
                                        <div
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(150, 150, 150, 0.15); z-index: 10; cursor: not-allowed; pointer-events: all;"></div>
                                    @endif
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
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Aktiviraj tab iz URL fragmenta
        const hash = window.location.hash;
        if (hash) {
            const tab = document.querySelector(`[data-bs-target="${hash}"]`);
            if (tab) {
                bootstrap.Tab.getOrCreateInstance(tab).show();
            }
        }

        // Ažuriraj URL fragment pri promeni taba
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function () {
                history.replaceState(null, null, this.dataset.bsTarget);
            });
        });

    });
</script>
