<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Ευρετήριο</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="alert alert-success" role="alert">
        Success! Please select one of the following routes:
    </div>
    <div>
        <h2>Fixed width & height HTML</h2>
        <dl>
            <dt><a href="{{ url('fixedRegister') }}">Registration page</a></dt>
            <dd>This is an accurate recreation of the mock-up, exluding the privacy setting for passwords which probably should not be implemented.</dd>
        </dl>
        <h2>Variable width & height HTML</h2>
        <dl>
            <dt><a href="{{ url('register') }}">Registration page</a></dt>
            <dd>✔️ Variable width & height interpretation of the mock-up with an additional h1 header (Νέος χρήστης). Background retained. Fully responsive (320px - 1320px).</dd>
            <dt><a href="{{ url('login') }}">Login page</a></dt>
            <dd>✔️ Variable width & height interpretation of the mock-up with an additional h1 header (Καλωσόρισες!). Same layout as login page. Fully responsive (320px - 1320px).</dd>
        </dl>
    </div>
    <div>
        <a href="{{ url('testRoute') }}" style="text-decoration:line-through">Go to secondPageTest</a>
    </div>
    <div>
        <a href="{{ url('testVue') }}" style="text-decoration:line-through">Go to testVueJSPage</a>
    </div>
</div>

</body>
</html>
