@extends('layouts.admin')
@section('title', 'Vertrag Anzeigen')
@section('hide-page-header', true)

@section('content')
    @include('partials.shared.header', [
        'title'       => '',
        'buttonText'  => 'Zurück',
        'buttonIcon'  => 'arrow-left',
        'buttonUrl'   => route('contracts.index'),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('partials.shared.alerts')
            <div class="row">
                @include('contracts.partials.show.left-panel')
                @include('contracts.partials.show.right-panel')
            </div>
        </div>
    </div>
@endsection
