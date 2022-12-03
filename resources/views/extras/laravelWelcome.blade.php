<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Ευρετήριο</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        :root {
            --demo-weight: 900;
            --demo-size: 44px;
        }
        .variable-font-weight {
            font-size: var(--demo-size);
            font-weight: var(--demo-weight);
        }
        dd > dl { margin-left: 2rem; }
        dl {
            margin-top: 1em;
        }
        dl, dd {font-size: 0.9rem;}
        .error {
            color: white;
            background-color :crimson;
            opacity: 0.9;
        }
        .todo::before {
            content: "@";
        }
        .todo {
            color: white;
            background-color:darkturquoise;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Success! Please select one of the following routes:
        </div>
        <h1>Routes</h2>
        <small style="border-bottom: 1px solid #000;">Make your browser's window as small as this little line of text...</small>
        <h3 class="mt-4">Login & on-boarding</h3>
        <small>Privacy icon on password fields has been removed as it should be controlled by browser.</small>
        <dl>
            <dt><a href="{{ url('register') }}">Registration page</a></dt>
            <dd>✔️ <span class="todo">Add CAPTCHA.</span> Variable width & height interpretation of the mock-up with an additional h1 header (Νέος χρήστης). Background retained. Fully responsive (320px - 1320px).</dd>
            <dt><a href="{{ url('login') }}">Login page</a></dt>
            <dd>✔️ Variable width & height interpretation of the mock-up with an additional h1 header (Καλωσόρισες!). Same layout as login page. Fully responsive (320px - 1320px).
                <dl>
                    <dt><a href="{{ url('demo/login/error') }}">Variation: Login page with <span class="error">ERROR</span> (modal)</a></dt>
                    <dd>✔️ Same as the login page with an additional, triggered off-canvas bottom-bar that displays an imaginary login error. Fully responsive. Includes demo JavaScript that sets and triggers the off-canvas element.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('password/reset') }}">Password reset</a></dt>
            <dd>✔️ Same as the login page with additional text and partially hidden decoration on small viewports. Fully responsive.</dd>
            <dt><a href="{{ url('password/reset/change') }}">Password reset: Change password</a></dt>
            <dd>✔️ Same as the login page with additional text and partially hidden decoration on small viewports. Text should probably be rephrased. Fully responsive.</dd>
            <dt><a href="{{ url('success') }}">Success!</a></dt>
            <dd>✔️ <span class="todo">Needs small adjustments.</span> Successfull message with a fully responsive "full screen" background.</dd>
        </dl>
        <h3 class="mt-4">Create new player</h3>
        <small>Privacy icon on password fields has been removed as it should be controlled by browser.</small>
        <dl>
            <dt><a href="{{ url('/profiles/new') }}">New player profile Step 1 of 3</a></dt>
            <dd>✔️ <span class="todo">Under construction.</span>
                <dl>
                    <dt><a href="{{ url('/profiles/new/error') }}">Variation: New player profile Step 1 of 3 with <span class="error">ERROR</span></a></dt>
                    <dd>✔️ <span class="todo">Under construction.</span></dd>
                    <dt><a href="{{ url('/profiles/new/error') }}">Variation: New player profile Step 1 of 3 (no error)</a></dt>
                    <dd>✔️ <span class="todo">Under construction.</span></dd>
                </dl>
            </dd>
            <dt><a href="{{ url('/') }}">New player profile Step 2 of 3</a></dt>
            <dd>✔️ <span class="todo">Under construction.</span></dd>
            <dt><a href="{{ url('/') }}">New player profile Step 3 of 3</a></dt>
            <dd>✔️ <span class="todo">Under construction.</span></dd>
        </dl>
        <hr />
        <h1>How to use this repository</h1>
        <p class="lead">Some notes about the use of this repository.</p>
        <p>
            I am pretty sure I will forget everything in a week, so here's
            some useful notes in case you are still reading this document.
        </p>
        <p>
            <ul>
                <li>Start webserver: <code>php artisan serve</code></li>
                <li>Run and build, continiously: <code>npm run watch</code></li>
            </ul>
        </p>
        <h1>Extras</h1>
        <div>
            <a href="{{ url('extras/font-tester') }}">Font Tester</a>
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
