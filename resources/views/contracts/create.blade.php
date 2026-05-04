@extends('layouts.admin')

@section('title', 'Vertrag erstellen')
@section('hide-page-header', true)

@section('content')

    @include('partials.shared.header', [
        'title'      => 'Neuer Vertrag',
        'buttonText' => 'Zurück',
        'buttonIcon' => 'arrow-left',
        'buttonUrl'  => route('contracts.index')
    ])

    <div class="app-content">
        <div class="container-fluid px-4 pt-4">

            <form method="POST" action="{{ route('contracts.store') }}" id="contractForm" novalidate>
                @csrf
                <div class="row">
                    @include('contracts.partials.create.apartment-panel')
                    @include('contracts.partials.create.contract-form')
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/task/apartment-search.js') }}"></script>
    <script src="{{ asset('js/contract/person-search.js') }}"></script>
    <script src="{{ asset('js/contract/date-picker.js') }}"></script>
    <script src="{{ asset('js/contract/contract-create.js') }}"></script>
@endpush
