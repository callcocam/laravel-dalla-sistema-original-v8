<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $tenant->name }}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('_dist/admin/css/themes/lite-purple.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('_dist/admin/css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('_dist/admin/css/plugins/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('styles')
    @notify_css
    <!-- Styles -->
</head>
<body class="text-left">
<div class="app-admin-wrap layout-sidebar-vertical sidebar-compact-onhover sidebar-closed sidebar-compact">


    @include("admin.includes.sidebar-other")
    <div class="switch-overlay"></div>
    <!-- =============== Left side End ================-->
    <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
    @include("admin.includes.main-header-other")
        <!-- ============ Body content start ============= -->

        <div id="app" class="main-content pt-4">
            @yield('breadcrumb')
            <div class="separator-breadcrumb border-top"></div>
        @yield('content')
            <!-- end of main-content -->

        </div><!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <!-- fotter end -->
    </div>
</div>
<!-- ============ Search UI Start ============= -->
@include("admin.includes.form-logout")
<script src="{{ asset('_dist/admin/js/plugins/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/scripts/script.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/scripts/script_2.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/scripts/sidebar.large.script.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/plugins/metisMenu.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/scripts/layout-sidebar-vertical.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/plugins/tagging.min.js') }}"></script>
<script src="{{ asset('_dist/admin/js/formatCurrency.js') }}"></script>
<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

<script src="https://kit.fontawesome.com/f248d703d3.js" crossorigin="anonymous"></script>

@notify_js
@notify_render
@stack('scripts')
@stack('chartsJs')
</body>
</html>
