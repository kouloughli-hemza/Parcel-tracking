<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Décharge de paiement Partenaire - {{ setting('app_name') }}</title>
    {!! HTML::style('assets/css/vendor.css') !!}
    {!! HTML::style('assets/css/app.css') !!}
    {!! HTML::style('assets/css/export.css') !!}
    @yield('styles')
</head>
<body class="bg-white" >
@yield('content')
</body>
</html>
