<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Imprimir</title>
    <link href="{{ asset('_dist/admin/css/themes/lite-purple-print.css') }}" rel="stylesheet"/>
    <!-- Styles -->
</head>
<body>
@yield('content')
</body>
</html>
