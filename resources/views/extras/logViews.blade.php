<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Ευρετήριο σελίδων</title>
    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
 </head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Success! Updated January 11, 2023, 03:22. Please select one of the following routes.
        </div>
        <h1>Demo Routes</h2>
        January 11, 2023 Notes:
        <ul>
            <li>We did it! All pages can be controlled by any key in either
                automatic or manual mode!
            </li>
            <li>Next goal: Virtual reality!</li>
            <li><a href="{{ url('/demo/select/pawn') }}">Select Pawn with Controller Switch enabled in automatic mode.</a>
            Please see the documentation on both the demo blade.php and the switcher.js for more information. Script also
        works in manual mode. Script allows setting of scanning speed. Script allows setting of both Selection and Navigation
    Buttons. Script can be escaped with the Escape button - providing helpful hints and option to succesfully break it! </li>
        </ul>

        December 22, 2022 Notes:
        <ul>
            <li>We did it! All pages are fully responsive!</li>
            <li>Next goal: Dark theme!</li>
            <li><a href="#documentation">Even more documentation</a> was added at the end of this page</a>.</li>
            <li><a href="#tovueornottovue">Not using Vue (default) and how to use Vue (optional)</a>.</li>
        </ul>

        <h3 class="mt-4">Player Settings</h3>
        <small>Landing page for settings. With the exception of music, all other main game Settings pages <em>could be the exact same</em> as the ones for a New Player, but with a slighty modified header.</small>
        <dl>
            <dt><a href="{{ url('/settings') }}">Player Settings main/landing page</a>
            <dd>✔️ <span class="upd">Final</span> A nice vertical stack of buttons of all types (including a disabled and a dangerous one). Balloon on hover, Delete Player implementation via a modal and a form, back to previous page button, fully responsive and nicely decorated with 3 different backgrounds.</dd>
            <dt><a href="{{ url('/settings/profile') }}">Existing Player Profile Settings</a>
            <dd>✔️ <span class="upd">Final: α version</span> .</dd>
            <dt><a href="{{ url('/settings/controls') }}">Existing Player Controls Settings</a>
            <dd>✔️ <span class="upd">Final: α version</span> </dd>
            <dt><a href="{{ url('/settings/difficulty') }}">Existing Player Difficulty Settings</a>
            <dd>✔️ <span class="upd">Final: α version</span> A nice vertical stack of buttons of all types (including a disabled and a dangerous one). Balloon on hover, Delete Player implementation via a modal and a form, back to previous page button, fully responsive and nicely decorated with 3 different backgrounds.</dd>
        </dl>

        <h3 class="mt-4">Start New Game</h3>
        <small>Detailed notes on each page for suggested implementation (and an alternative via button submits).</small>
        <dl>
            <dt><a href="{{ url('/select/player') }}">New game: Select player (1/5)</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 1. Fully responsive. Avatars have been reduced in size to fit this screen, labels have been introduced and everything acts as a virtual radiogroup with radios that is fully accessible. Custom flex-grid to allow trees to grow. The dash line at the bottom runs very wild. A secondary button was created. There is no way to log-out until the user has selected a Player. Fully responsive.</span>
            <dt><a href="{{ url('/select/board') }}">New game: Select board (2/5)</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 2. Select board. Fully responsive. Supports 1 to N amount of boards where N equals to the integer limit of the MySQL database. Extra attention to detail has been give to have buttons with strong and distinctive hover, focus and active states based on combinations of shadows. Bonus: ΠΡΟΣΕΧΩΣ! for unreleased boards. This is the suggested version, using direct links with GET parameters. As always the documentation has been added in the template.</span>
                <dl>
                    <dt><a href="{{ url('/demo/select/board/form') }}">Example variation: Select board page as a form (2/5)</a></dt>
                    <dd>✔️ <span class="upd">Final</span> Step 2 based on a get/post FORM with buttons & hidden fields.</span>
                </dl>
            <dt><a href="{{ url('/select/mode') }}">New game: Select mode (3/5)</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 3. Select mode. Supports 1 to N amount of modes, even if we will only have 3. Any mode can be easily disabled with a simple :comingsoon=true and that will add a nice ΠΡΟΣΕΧΩΣ! Read the notes for the previous step for more info regarding implementation. Added a data-tabindex element in case we need an alternative to tabindex, which includes ALL the elements of the page and not just the ones which are part of the game. Fully responsive. </span>
            <dt><a href="{{ url('/select/pawn') }}">New game: Select pawn (4 or 5/5)</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 4. Different orientation of "options" demanded another new element, the pawn button. Same instructions as the ones above. Fully responsive. </span>
            <dt><a href="{{ url('/select/options') }}">New game: Select options (5 or 4/5)</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 5. Start tutorial or Start game? That's the question. Uses the same components as the ones on the previous steps. Same guidelines for passing selected options. Fully responsive. An option can be disabled via :comingsoon and of course no teaser is added. Responsive as well.</span>
        </dl>

        <h3 class="mt-4">Create New Player</h3>
        <small>Create new player settings. Shall we re-use these 3 forms for the main-game Settings with the same components & fields (but a different sub-header) for Profile, Controls & Difficulty for version 0.1 instead instead of re-implementing them from scratch?</small>
        <dl>
            <dt><a href="{{ url('/settings/profile/new') }}">Create New Player Step 1/3: Profile</a></dt>
            <dd>✔️ <span class="upd">Final</span> Step 1 out of 3 for creating a new individual player profile with working "stepper", back button, interactive JavaScript elements, Laravel @@errors support and more. Utilises various components. Requires avatar data which are provided as an example on the routes. Developer notes. Very complex. Fully responsive. </span>
                <dl>
                    <dt><a href="{{ url('/demo/settings/profile/new/error') }}">Variation: New player profile Step 1 of 3 with <span class="error">ERROR</span></a></dt>
                    <dd>✔️ <span class="upd">Final</span> See above. Page integrates Laravel @@errors.</dd>
                    <dt><a href="{{ url('/demo/settings/profile/new/success') }}">Variation: New player profile Step 1 of 3 (no error)</a></dt>
                    <dd>✔️ <span class="upd">Final</span> See above. Form validation in attached ready-for-production JavaScript.</dd>
                </dl>
            </dd>
            <dt><a href="{{ url('/settings/controls/new') }}">Create New Player Step 2/3: Controls</a></dt>
            <dd>✔️ <span class="upd">Final</span> Lovely custom-made checkboxes, awesome input ranges and JavaScript to support hide and seek of different radio-groups and even reliable keypress readings, while making sure that the values could be easily stored and retrieved from the hidden and ready-to-use-on-the-back-end forms. Fully responsive.</dd>
            <dt><a href="{{ url('/settings/difficulty/new') }}">Create New Player Step 3/3: Difficulty</a></dt>
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
        <p>
            Updating npm/composer and database:
        </p>
        <p>
            <code>
                git pull
                npm install
                composer i
                php artisan migrate:rollback
                php artisan migrate
                php artisan db:seed
                npm run dev
            </code>
        </p>

        <hr />

        <h1 class="pt-4 pb-2"><a name="documentation">Even more documentation</a></h1>

        <nav id="navbar" class="navbar navbar-dark bg-dark px-3">
            <a class="navbar-brand" href="#">Site tour</a>
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link danger" href="#scrollspyHeading1">Select Player</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading2">New Player</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#scrollspyHeading3">New player controls settings</a></li>
                  <li><a class="dropdown-item" href="#scrollspyHeading4">New player difficulty settings</a></li>
                  <li><a class="dropdown-item" href="#scrollspyHeading5">Back to player selection</a></li>
                  <li><a class="dropdown-item" href="#scrollspyHeading5">NO MORE TEXT PLEASE</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        <div data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="0" class="small border border-dark p-4" tabindex="0" style="overflow-y: scroll;height: 300px">
            <p>
                As all the December '22 sprint's targets have been met on the front-end,
                join us for a short tour of the site.
            </p>
            <h4 id="scrollspyHeading1">Select Player</h4>
            <p>
                After a user has succesfully logged-in, the first page they are going to
                visit is:
                "<a href="{{ url('/select/player') }}">New game: Select player (1/5)</a>".
                This happens to be one of the most complicated pages ever and it demands
                a lot of work both on the front-end and on the back-end: A working model
                for Avatars, a working model for Players (each User can have many players
                and each Player can only have one Avatar). Example models are provided
                in docs/examples but they haven't been tested. Their combined expected
                output though, has been provided in order to make this page possible:
                An array of all the user's players along with their selected avatars.
            </p>
            <p>
                From that point on, "rendering" the list of Players is piece-easy thanks
                to various components that work together in harmony: The user is asked
                to Select a User by clicking it's avatar: This is a virtual radiogroup
                and each avatar acts as a radio button - not only in theory but in
                practice through the clever use of legends, labels and ARIA values. In
                other words, this is a real and 100% accessible form. JS is listening
                for that click gets the playerID from the data-attributes of the avatar
                and passes it to a hidden input field while enabling the 2 submit
                buttons: These two buttons are not hidden as it was proposed on the
                original mock-up. Instead, they are disabled until the user clicks the
                player, to make them understand why they have to click a player: to play
                the game -or access the settings.
            </p>
            <p>
                In case it was not clear so far, this whole page is an over-designed
                form with a single hidden input field that passes the player id to
                either the next page in the "New game" sequence or to the Settings.
                Yes, you can pick a pre-selected user if you want, and yes, there's
                really nothing much to do in the back-end than to check if the
                selected player id "belongs" to the authorised (logged-in) user-id.
                But let's say that the user doesn't have a player, yet...
            </p>
            <h4 id="scrollspyHeading2">No player? New Player!</h4>
            <p>
                By clicking on "Νέο προφίλ" (I really think it should be Νέος
                παίκτης instead), user is transfered to:
                <a href="{{ url('/settings/profile/new') }}">Create New Player Step 1/3: Profile</a>.
                This is a simple one-page form and it's the only trully required
                step on the (wisely proposed) 3-step "player creation" process.
                User absolutely HAS to select a Name and an Avatar or cancel
                the process.
                <blockquote class="small">And we offer this cancel via the "Back" button
                    which is now placed right next to a sub-header, which was
                    also missing from the original mock-ups and it was created
                    because there was no other way to ensure respositivity,
                    accessibility and logical order of elements. Legend comes
                    before label. People read instructions before filling the
                    form. Plus, we now have an accessible &lt;h1&gt;eader.
                    Name has no limits currently. BUT, it should be limited to
                    more or less 10-12 characters IMHO as our layouts does not
                    allow longer names (see User Menu and the Player Select
                    screens: Αλέξανδρος is the biggest name we can have before
                    ellipsis takes care of the overflow-y.
                </blockquote>
                When the user manages to click an Avatar and fill a name,
                the submit button is enabled. Back-end should check if
                player name is valid (e.g. name is a string of 1-15 chars
                that no other player of the same user id is using, valid
                avatar id based on our model etc) and if not, return to the
                same page with a nice error (and a proposal for a different
                name offered by default, according to the mock-ups).
                If everything is valid, back-end should Create the Player
                and apply a default set of settings for them, which will be
                used on the following pages and proposed as default.
            </p>
            <p>BTW, this is another over-complicated page on the front-end
                that is exteremely easy to handle on the back-end. We are
                again using some components that have also been used in
                the Select Player page to enable avatar selection and
                a basic validation of user input.
            </p>
            <h4 id="scrollspyHeading3">New player controls!</h4>
            <p>There's simply no right or wrong answer here. As long as the
                user has been created, let's offer them sensible default
                settings as we can't really have a form of radio-buttons
                with NO defaults. Welcome to:
                <a href="{{ url('/settings/controls/new') }}">Create New Player Step 2/3: Controls</a>.
                THIS IS AN EXTREMELY COMPLICATED page by it's own as the user
                is asked to do something really hard: To press a button after
                clicking a button. I couldn't determine the solution myself and
                what I am proposing here is the simplest method I could think
                of - we could add some kind of a modal, but that modal would now
                be almost the same as the modals user for help, so, argh
                Anyway: User clicks a special button which is a part of a
                radiogroup of radiogroups. Yes, you are reading this correctly:
                One radiogroup disables the other radiogroup and vice-versa,
                while enabling a set of different options. Then the user has to
                click a button, in order to assign a key to a command. How do
                we read this key? Via JS of course. And that's 6K of JS to
                handle not only the procedure, but the visual cues and the
                easy cancellation (by clicking anywhere else on the page). It's
                smooth, really. Back-end should not worry about that too much,
                as the key is read and that reading is stored in another hidden
                field. Hoorah.
            </p>
            <p>There are a lot of things that could have been different. I
                disagree with the use of modals for help. I prefer tooltips
                or even better, inline helpful text prompts, like the one
                used on the ranger that actively indicates e.g. "κάθε 2
                δευτερόλεπτα". This is the only way to make this page more
                accessible, because having a button that opens a not-functional
                modal is not accessible enough. On the other hand, these modals
                allow longer texts than prompts or tooltips. With that said,
                Μετακίνηση και Πλοήγηση. I can't understand the difference
                by reading these words without HAVING to go through their
                help modals.
                <blockquote>And even there, there are issues:
                    Ο τρόπος που «κινείται» ο παίκτης στο παιχνίδι is the
                    sub-label for both Τρόπος πλοήγησης and Μετακίνηση.
                </blockquote>
                Ok. That's enough. Let's say that the user submits the form.
                There's no validation, as there are no wrong choices here.
                The Player ID that was created in the previous form now
                has some updated settings and they need to go through
                another page of settings....
            </p>
            <h4 id="scrollspyHeading4">New player difficulty!</h4>
            <p>Nothing more to add-here. I have to note though that I've
                made the dices accessible and clickable as they are part
                of their radio-group. And that required even more JS. And
                I have no clue about JS unfortunately.
            </p>
            <h4 id="scrollspyHeading5">Back to player selection</h4>
            <p>
                Ok. User is asked to select a player (or to be honest, it would
                be better to select for them the newly created user, which is a
                way to highlight their creation). We can finally submit this
                form and either go to the Next page on the New Game sequence
                or the Settings. We are passing the player id via the form.
                We have to somehow pass the playerid around, as we require it
                for the UserMenu on every single page and for the Settings.
                I am proposing GET. /settings/{playerid}/controls. Or to
                store the "selected player id" in some cache and pass it around.
                What works best. I have no clue about temporary caches and I
                hate them: They act like a shopping cart. Let's add the player
                ID to the shopping cart and pass it around instead. I really
                don't know what would be better, so that's up to the back-end
                and at the end-of-the-day this might be the most complicated
                thing to do. I would have gone with GET and I would have used
                confusing URLs like this one: game/new?player=1&board=1&mode=1&pawn=4
                because that would allow me to mess with the parameters myself
                for debugging and at-the-end-of-the-day we are only passing around
                integers and not valuable user data.
            </p>
            <h4 id="scrollspyHeading6">NO MORE TEXT PLEASE</h4>
            <p>Ok, it's getting late isn't it? So, every single template
                has tons of inline comments. I have went through the process
                of actually designing all the UX/UI on my mind and thinking
                of how to implement every single detail. Please, go through
                these pages, and don't hesitate to ask questions.
            </p>
        </div>

        <h1 class="pt-4"><a name="tovueornottovue">To Vue or not to Vue?</a></h1>
        <div class="border border-danger p-4 mt-4 small">
            <p>
            Note: All pages are using the exact same layout template stored on
            <strong>/views/components/layout.blade.php</strong> - This blade sets the doctypes,
            headers, sections and footers which are common on all pages of the
            site. Therefore, each page only has the actual HTML content that
            goes inside that layout. Please, read the documentation on that file
            to understand how to use it (is docBlade a thing yet?).
            </p>
            <p>
            Ah yes, layout.blade.php also loads CSS and JS (namely, app.css and
            app.js). <strong>Vue.js is NOT included on app.js</strong> as MOST
            of the pages do not require it as a dependency (at this point).
            It sounds complicated but it isn't. Vue.js is an opt-in. An optional
            parameter passed on the layout to include (the actual file) vue.js.
            And to be fair, that way we can have not a single but MANY vue apps!
            <ul>
                <li>There's also a <strong>layoutBlank.blade.php</strong> with
                    no footer and header that is already in use on the splash screen.</li>
                <li>In order to have an absolutely centered layout that is
                    responsible, height calculations have become extremely hard
                    and are determine on a case-by-case basis. That's very
                    unfortunate.</li>
                <li>So what should the #app's height be? If the x-layout template
                    is used which includes the site's header and footer, then
                    the #app should NOT be taller than 656 pixels minus the
                    footer's height (which is out of the grid and has negative
                    margin in order to go on top of content). In other words:
                    656 pixels minus the footer's height which is 105px (or
                    110px with padding). In other words, let's say 540px.
                    Cut 20-40 pixels in case I am wrong.</li>
                <li> If the x-layoutBlank is used which has NO header and NO
                    footer, then the #app's size should be fixed at 780 pixels.
                    At the end of the game we can't make the game board itself
                    responsive. Or can we? Challenge accepted (hint: use
                    CSS for orientation and display message in #app to
                    rotate screen to landscape, then scale down as much as
                    possible OR only work with percentages).
                </li>
            </ul>
            <hr />
                Examples:
                <dl>
                    <dt><a href="{{ url('/home' )}}">Home (&lt;x-layout&gt;)</a></dt>
                    <dd>✔️ This is actually not my example, but the one that Aris
                        made. Please check the git differences to see how easy
                        it is to use the site's default layout via the x-layout
                        blade component.</dd>
                    <dt><a href="{{ url('/demo/noVue') }}">Demo: No Vue (&lt;x-layout&gt;)</a></dt>
                    <dd>✔️ Here's another example which is really like all the
                        pages on this site, but with some optional parameters
                        set...
                    </dd>
                    <dt><a href="{{ url('/demo/hasVue') }}">Demo: Vue (&lt;x-layout :hasVue=true&gt;)</a></dt>
                    <dd>✔️ So, if the default &lt;x-layout&gt; has no Vue.js how can we have
                        a Vue.js page? Simply use the layout with the optional
                        parameter <strong>hasVue=true</strong>. This page loads
                        the example Vue components that Aris initially created
                        for the project. Not that the <strong>#app</strong>
                        element is not styled at the moment.
                    </dd>
                    <dt><a href="{{ url('/demo/hasVueBlank') }}">Demo: Vue (&lt;x-layoutBlank :hasVue=true&gt;)</a></dt>
                    <dd>✔️ Same as above but using the &lt;x-layoutBlank&gt; layout component.
                    </dd>
        </div>

        <h1 class="py-4">It's really over!</h1>

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
