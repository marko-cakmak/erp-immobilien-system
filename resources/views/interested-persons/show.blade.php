@extends('layouts.admin')

@section('title', 'Interessent Details')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'       => 'Interessent Details',
        'buttonText'  => 'Bearbeiten',
        'buttonIcon'  => 'pencil',
        'buttonUrl'   => route('interested-persons.edit', $person->id),
        'buttonClass' => 'btn-warning',
        'managePermission' => 'manage_interessenten',
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('partials.shared.alerts')

            <div class="row">
                @include('interested-persons.partials.show.left-panel')
                @include('interested-persons.partials.show.right-panel')
            </div>

        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/task/task-tabs.css') }}">
@endpush
