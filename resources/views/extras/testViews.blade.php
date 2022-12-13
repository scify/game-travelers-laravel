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
            Success! Updated December 10, 2022, 04:59. Please select one of the following routes.
        </div>
        <h1>Demo Routes</h2>
        <small style="border-bottom: 1px solid #000;">Make your browser's window as small as this little line of text...</small>

        <h3 class="mt-4">New game</h3>
        <small>No notes yet.</small>
        <dl>
            <dt><a href="{{ url('/select/player') }}">New game: Select player (1/?)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 1 out of ? of playing a new game. Select a new player. </span>
        </dl>

        <h3 class="mt-4">Create new player</h3>
        <small>The beautiful hand-drawn image-button for moving to the "next step" was not utilised (even though it's code is still somewhere in the views), as it would have required 8 additional assets to provide the basic acesesibility that the HTML button provides.</small>
        <dl>
            <dt><a href="{{ url('/profiles/new') }}">New player profile Step 1 of 3</a></dt>
            <dd>✔️ <span class="new">New</span> Step 1 out of 3 for creating a new individual player profile, custom interpretation of the original mock-up with working stepper, back and forward buttons, interactive JavaScript elements, Laravel @@errors support and more. Utilises various components. Requires avatar data which are provided as an example on the routes. Developer notes. Very complex. Fully responsive. </span>
                <dl>
                    <dt><a href="{{ url('/demo/profile/error') }}">Variation: New player profile Step 1 of 3 with <span class="error">ERROR</span></a></dt>
                    <dd>✔️ <span class="new">Demo</span> See above. Page integrates Laravel @@errors.</dd>
                    <dt><a href="{{ url('/demo/profile/success') }}">Variation: New player profile Step 1 of 3 (no error)</a></dt>
                    <dd>✔️ <span class="new">Demo</span> See above. Form validation in attached ready-for-production JavaScript.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('/profiles/new/2') }}">New player profile Step 2 of 3</a></dt>
            <dd>✔️ <span class="new">New</span> Lovely custom-made checkboxes, awesome input ranges and JavaScript to support hide and seek of different radio-groups and even reliable keypress readings, while making sure that the values could be easily stored and retrieved from the hidden and ready-to-use-on-the-back-end forms. Fully responsive.</dd>
            <dt><a href="{{ url('/profiles/new/3') }}">New player profile Step 3 of 3</a></dt>
            <dd>✔️ <span class="new">New</span> Even dices can be clicked to be selected. Fully responsive. </dd>
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
