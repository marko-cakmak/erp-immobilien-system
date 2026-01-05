@extends('layouts.admin')

@section('title', 'Dashboard - Immobilien ERP')

@section('page-title', 'Dashboard')

@section('content')

    @include('dashboard.components.info-boxes')

    <div class="row mt-4">
        @include('dashboard.components.chart-section')
        @include('dashboard.components.status-overview')
    </div>

    <div class="row">
        @include('dashboard.components.upcoming-viewings')
        @include('dashboard.components.recent-tasks')
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="{{ asset('js/dashboard/besichtigungen-chart.js') }}"></script>
@endpush
