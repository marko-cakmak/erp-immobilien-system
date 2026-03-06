@extends('layouts.admin')

@section('title', 'Interessent Details')
@section('hide-page-header', true)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/task/task-tabs.css') }}">
@endpush

@section('content')

    @include('interested-persons.partials.header', [
        'title'       => 'Interessent Details',
        'buttonText'  => 'Bearbeiten',
        'buttonIcon'  => 'pencil',
        'buttonUrl'   => route('interested-persons.edit', $person->id),
        'buttonClass' => 'btn-warning'
    ])

    <div class="app-content">
        <div class="container-fluid">

            @include('interested-persons.partials.alerts')

            <div class="row">
                @include('interested-persons.partials.show.left-panel')
                @include('interested-persons.partials.show.right-panel')
            </div>

        </div>
    </div>

@endsection
