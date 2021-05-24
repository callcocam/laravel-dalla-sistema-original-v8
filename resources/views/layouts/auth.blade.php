<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ sprintf("%s-%s", get_tenant()->name, __("Login")) }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>{{ config('app.name', 'Signin | Gull Admin Template') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('_dist/admin/css/themes/lite-purple.min.css') }}" rel="stylesheet">
</head>
<body class="auth-layout-wrap" style="background-image: url({{ asset('_dist/admin/images/photo-wide-4.jpg')}}) ">
<div id="app">
    <div class="login_wrapper">
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('_dist/admin/js/app.js') }}" defer></script>
</body>
</html>
