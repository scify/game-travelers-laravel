<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Hello World</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="alert alert-success" role="alert">
        This is a success alert—check it out!
    </div>
    <div>
        <a href="{{ url('testRoute') }}">Go to secondPageTest</a>
    </div>
    <div>
        <a href="{{ url('testVue') }}">Go to testVueJSPage</a>
    </div>
</div>

</body>
</html>
