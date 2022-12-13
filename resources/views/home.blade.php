<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Second page</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="alert alert-dark" role="alert">
        Dummy home page
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">logout</button>
    </form>
</div>

</body>
</html>
