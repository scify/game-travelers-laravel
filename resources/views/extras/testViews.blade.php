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
        .upd {
            color: white;
            background-color: darkslategray;
        }
        .new {
            color: white;
            background-color: darkseagreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Success! Updated December 8, 2022, 04:59. Please select one of the following routes.
        </div>
        <h1>Routes</h2>
        <small style="border-bottom: 1px solid #000;">Make your browser's window as small as this little line of text...</small>
        <h3 class="mt-4">Login & on-boarding</h3>
        <small>Privacy icon on password fields has been removed as it should be controlled by browser.</small>
        <dl>
            <dt><a href="{{ url('register') }}">Registration page</a></dt>
            <dd>✔️ <span class="upd">Final</span> Variable width interpretation of the mock-up with an additional h1 header (Νέος χρήστης), Laravel @@error responses & CAPTCHA! Background retained. Fully responsive (320px - 1320px).</dd>
            <dt><a href="{{ url('login') }}">Login page</a></dt>
            <dd>✔️ <span class="upd">Final</span> Variable width interpretation of the mock-up with an additional h1 header (Καλωσόρισες!), Laravel @@error handling and custom JavaScript as a component to trigger the proposed off-canvas error. Fully responsive (320px - 1320px).
                <dl>
                    <dt><a href="{{ url('demo/login/error') }}">Variation: Login page with <span class="error">ERROR</span> (off-canvas)</a></dt>
                    <dd>✔️ <span class="upd">Final</span> Same as the login page with an additional, forcefully triggered off-canvas bottom-bar that displays an imaginary login error. Fully responsive.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('password/reset') }}">Password reset</a></dt>
            <dd>✔️ <span class="upd">Final</span> Same as the login page with additional text and partially hidden decoration on small viewports. Laravel @@error handling added. Fully responsive.</dd>
            <dt><a href="{{ url('password/reset/change') }}">Password reset: Change password</a></dt>
            <dd>✔️ <span class="upd">Final</span> Same as the login page with additional text and partially hidden decoration on small viewports. Laravel @@error handling added. Fully responsive.</dd>
            <dt><a href="{{ url('password/reset/success') }}">Password reset: Success!</a></dt>
            <dd>✔️ <span class="upd">Final</span> <span class="todo">Assets</span> Successfull action message via a customizable component. Background restricted to 1366x768 pixels as requested (yet extends to full width/height on smaller viewports, so yes, responsive).</dd>
        </dl>
        <h3 class="mt-4">Create new player</h3>
        <small>Privacy icon on password fields has been removed as it should be controlled by browser.</small>
        <dl>
            <dt><a href="{{ url('/profiles/new') }}">New player profile Step 1 of 3</a></dt>
            <dd>✔️ <span class="new">New</span> Step 1 out of 3 for creating a new individual player profile, custom interpretation of the original mock-up with working stepper, back and forward buttons, interactive JavaScript elements, Laravel @@errors support and more. Utilises various components. Requires avatar data which are provided as an example on the routes. Developer notes. Very complex. Fully responsive. </span>
                <dl>
                    <dt><a href="{{ url('/profiles/new/error') }}">Variation: New player profile Step 1 of 3 with <span class="error">ERROR</span></a></dt>
                    <dd>✔️ <span class="new">New</span> See above. Page integrates Laravel @@errors.</dd>
                    <dt><a href="{{ url('/profiles/new/error') }}">Variation: New player profile Step 1 of 3 (no error)</a></dt>
                    <dd>✔️ <span class="new">New</span> See above. Form validation in attached ready-for-production JavaScript.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('/profiles/new/2') }}">New player profile Step 2 of 3</a></dt>
            <dd>✔️ <span class="new">New</span> Lovely custom-made checkboxes, awesome input ranges and JavaScript to support hide and seek of different radio-groups and even reliable keypress readings, while making sure that the values could be easily stored and retrieved from the hidden and ready-to-use-on-the-back-end forms. Fully responsive.</dd>
            <dt><a href="{{ url('/profiles/new/3') }}">New player profile Step 3 of 3</a></dt>
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
