<!doctype html>
<html lang="de">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Immobilien ERP')</title>

    <!--begin::Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--end::Meta Tags-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
          integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
          crossorigin="anonymous" media="print" onload="this.media='all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <!--end::Third Party Plugins-->

    <!--begin::AdminLTE CSS-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!--end::AdminLTE CSS-->

    <!--begin::ApexCharts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
          integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!--end::ApexCharts-->

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">

    <!--begin::Header-->
    @include('partials.header')
    <!--end::Header-->

    <!--begin::Sidebar-->
    @include('partials.sidebar')
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">@yield('page-title', 'Dashboard')</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->

    <!--begin::Footer-->
    @include('partials.footer')
    <!--end::Footer-->

</div>
<!--end::App Wrapper-->

<!--begin::Scripts-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<!--begin::ApexCharts-->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<!--end::ApexCharts-->

@stack('scripts')
<!--end::Scripts-->

</body>
</html>
