<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Second page</title>
    <!-- Scripts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <example-component></example-component>
</div>

</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
