@extends('layouts.admin')
@section('title', 'Vertrag Bearbeiten')
@section('hide-page-header', true)

@section('content')
    @include('partials.shared.header', [
        'title'       => '',
        'buttonText'  => 'Zurück',
        'buttonIcon'  => 'arrow-left',
        'buttonUrl'   => route('contracts.show', $contract->id),
        'buttonClass' => 'btn-secondary'
    ])

    <div class="app-content">
        <div class="container-fluid">
            @include('partials.shared.alerts')
            <form method="POST" action="{{ route('contracts.update', $contract->id) }}" id="contractForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="apartment_id" value="{{ $contract->apartment_id }}">
                <input type="hidden" name="interested_person_id" value="{{ $contract->interested_person_id }}">
                <div class="row">
                    @include('contracts.partials.show.left-panel')
                    @include('contracts.partials.edit.contract-form')
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/contract/date-picker.js') }}"></script>
@endpush
