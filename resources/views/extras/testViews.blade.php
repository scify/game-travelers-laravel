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
            Success! Updated December 15, 2022, 05:00. Please select one of the following routes.
        </div>
        <h1>Demo Routes</h2>
        <small style="border-bottom: 1px solid #000;">Make your browser's window as small as this little line of text...</small>

        <h3 class="mt-4">Start New Game</h3>
        <small>No notes yet.</small>
        <dl>
            <dt><a href="{{ url('/select/player') }}">New game: Select player (1/5)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 1. Fully responsive. Avatars have been reduced in size to fit this screen, labels have been introduced and everything acts as a virtual radiogroup with radios that is fully accessible. Custom flex-grid to allow trees to grow. The dash line at the bottom runs very wild. Remove player has been removed and will go to Settings. A secondary button was created. There is no way to log-out until the user has selected a Player. Fully responsive.</span>
            <dt><a href="{{ url('/select/board') }}">New game: Select board (2/5)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 2. Select board. Fully responsive. Supports 1 to N amount of boards where N equals to the integer limit of the MySQL database. Extra attention to detail has been give to have buttons with strong and distinctive hover, focus and active states based on combinations of shadows. Bonus: ΠΡΟΣΕΧΩΣ! for unreleased boards. This is the suggested version, using direct links with GET parameters. As always the documentation has been added in the template.</span>
                <dl>
                    <dt><a href="{{ url('/demo/select/board/form') }}">Example variation: Select board page as a form (2/5)</a></dt>
                    <dd>✔️ <span class="new">New</span> Step 2 based on a GET/POST form with hidden fields.</span>
                </dl>
            <dt><a href="{{ url('/select/mode') }}">New game: Select mode (3/5)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 3. Select mode. Supports 1 to N amount of modes, even if we will only have 3. Any mode can be easily disabled with a simple :comingsoon=true and that will add a nice ΠΡΟΣΕΧΩΣ! As rapid development demands re-usable components and because I really don't want to cause a visual conflict with the previous step, shadows have been applied to these buttons as well. Read the notes for the previous step for more info regarding implementation. Added a data-tabindex element in case we need an alternative to tabindex, which includes ALL the elements of the page and not just the ones which are part of the game. Fully responsive. </span>
            <dt><a href="{{ url('/select/help') }}">New game: Select help (4/5)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 4 of playing a New game.</span>
            <dt><a href="{{ url('/select/pawn') }}">New game: Select pawn (5/5)</a></dt>
            <dd>✔️ <span class="new">New</span> Step 5 of playing a New game.</span>
        </dl>

        <h3 class="mt-4">Create New Player</h3>
        <small>The beautiful hand-drawn image-button for moving to the "next step" was not utilised (even though it's code is still somewhere in the views), as it would have required 8 additional assets to provide the basic acesesibility that the HTML button provides.</small>
        <dl>
            <dt><a href="{{ url('/profile/new') }}">New player profile Step 1 of 3</a></dt>
            <dd>✔️ <span class="upd">Upd</span> Step 1 out of 3 for creating a new individual player profile, custom interpretation of the original mock-up with working stepper, back and forward buttons, interactive JavaScript elements, Laravel @@errors support and more. Utilises various components. Requires avatar data which are provided as an example on the routes. Developer notes. Very complex. Fully responsive. </span>
                <dl>
                    <dt><a href="{{ url('/demo/profile/error') }}">Variation: New player profile Step 1 of 3 with <span class="error">ERROR</span></a></dt>
                    <dd>✔️ <span class="upd">Final</span> See above. Page integrates Laravel @@errors.</dd>
                    <dt><a href="{{ url('/demo/profile/success') }}">Variation: New player profile Step 1 of 3 (no error)</a></dt>
                    <dd>✔️ <span class="upd">Final</span> See above. Form validation in attached ready-for-production JavaScript.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('/profile/new/2') }}">New player profile Step 2 of 3</a></dt>
            <dd>✔️ <span class="upd">Final</span> Lovely custom-made checkboxes, awesome input ranges and JavaScript to support hide and seek of different radio-groups and even reliable keypress readings, while making sure that the values could be easily stored and retrieved from the hidden and ready-to-use-on-the-back-end forms. Fully responsive.</dd>
            <dt><a href="{{ url('/profile/new/3') }}">New player profile Step 3 of 3</a></dt>
            <dd>✔️ <span class="upd">Final</span> Even dices can be clicked to be selected. Fully responsive. </dd>
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

<!-- Not valid in this place but acceptable for easier editing of the Table of Contents. -->
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

</body>
</html>
