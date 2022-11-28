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
    dl {
      margin-top: 1em;
    }
  </style>
</head>
<body>
    <div class="container">
    <div class="alert alert-success" role="alert">
        Success! Please select one of the following routes:
    </div>
    <div>

        <h2>Variable width & height HTML</h2>
            <small style="border-bottom: 1px solid #000;">Honestly, make your browser's window as small as this line of text...</small>
        <h3 class="mt-4">Login & on-boarding</h3>
            <small>Privacy icon on password fields has been removed as it should be controlled by browser.</small>
        <dl>
            <dt><a href="{{ url('register') }}">Registration page</a></dt>
            <dd>✔️ Variable width & height interpretation of the mock-up with an additional h1 header (Νέος χρήστης). Background retained. Fully responsive (320px - 1320px).</dd>
            <dt><a href="{{ url('login') }}">Login page</a></dt>
            <dd>✔️ Variable width & height interpretation of the mock-up with an additional h1 header (Καλωσόρισες!). Same layout as login page. Fully responsive (320px - 1320px).</dd>
            <dt><a href="{{ url('login/error') }}">Login page with error modal</a></dt>
            <dd>✔️ Same as the login page with an additional off-canvas bottom-bar that displays an imaginary login error. Includes demo JavaScript that sets and triggers the off-canvas element.</dd>
            <dt><a href="{{ url('password/reset') }}">Password reset</a></dt>
            <dd>✔️ Same as the login page with additional text and partially hidden decoration on small viewports.</dd>
            <dt><a href="{{ url('password/reset/change') }}">Password reset: Change password</a></dt>
            <dd>✔️ Same as the login page with additional text and partially hidden decoration on small viewports. Text should probably be rephrased.</dd>
            <dt><a href="{{ url('success') }}">Success!</a></dt>
            <dd>✔️ Successfull message. @TODO: Background image.</dd>
        </dl>

        <h2 class="mt-4">Fixed width & height HTML</h2>
            <small>Maximize your browser's window (~1320 pixels).</small>
        <dl>
            <dt><a href="{{ url('fixedRegister') }}">Registration page</a></dt>
            <dd>This is an accurate recreation of the mock-up, exluding the privacy icon on password fields.</dd>
        </dl>

        <hr />
        <h1>Φοντ τέστερ Font tester</h1>
        <small>
            It's obvious from the above text that something is wrong with the
            kerning of the
            <a href="https://fonts.google.com/specimen/Inter+Tight">
                font used in this project
            </a> in Greek text. To test this theory, let's see this font without
            Bootstrap on a pixel-set size of 100px which is much bigger than
            Bootstrap's computed value of 44px via the &lt;h1&gt;.
        </small>
        <div class="text-center variable-font-weight" id="testArea">
            καλωσόρισες
        </div>
        <select class="form-select form-select-lg mb-3" id="selectWeight">
            <option>Πόσο βαρύ θέλεις να είμαι;</option>
            <option value="200" disabled>200 (extra-light)</option>
            <option value="300">300 (light)</option>
            <option value="400">400 (regular!)</option>
            <option value="500">500 (medium)</option>
            <option value="600">600 (semi-bold)</option>
            <option value="700" disabled>700 (bold)</option>
            <option value="800" disabled>800 (extra-bold)</option>
            <option selected value="900">900 (black/heavy)</option>
        </select>
        <small>So, obviously, on a pixel-set size of 120px nothing is wrong with
          the font. So what if we make it smaller?</small>
          <select class="form-select form-select-lg mb-3" id="selectHeight">
            <option>Πόσο μεγάλο θέλεις να είμαι;</option>
            <option value="12px">12px</option>
            <option value="16px">16px</option>
            <option value="24px">24px</option>
            <option value="32px">32px</option>
            <option value="36px">36px</option>
            <option selected value="44px">44px</option>
            <option value="66px">66px</option>
            <option value="88px">88px</option>
            <option value="100px">100px</option>
            <option value="120px">120px</option>
        </select>
        <small>Notice the kerning on <span style="font-weight:800">λωωσσ</span>.
          How about <span style="font-weight:800">κωωδ</span>. No there's no
          space between the ω and the other letters: This font has issues with
          the kerning of its Greek characters. So, I will leave this test here
          until we find a proper replacement for the black/heavy weight, cause
          after all this JavaScript demonstrates the altering CSS variables in
          real-time.
        </small>

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
        </p>

        <hr />

    </div>
    <div>
        <a href="{{ url('testRoute') }}" style="text-decoration:line-through">Go to secondPageTest</a>
    </div>
    <div>
        <a href="{{ url('testVue') }}" style="text-decoration:line-through">Go to testVueJSPage</a>
    </div>
</div>
  <script>
    document.getElementById("selectWeight").value="900";
    document.getElementById("selectHeight").value="44px";

    function changeWeight(w) {
        var r = document.querySelector(':root');
        r.style.setProperty("--demo-weight", w);
    }
    function changeHeight(h) {
        var r = document.querySelector(':root');
        r.style.setProperty("--demo-size", h);
    }
    document.getElementById("selectWeight").onchange = function() {
        const el = document.getElementById("selectWeight");
        var w = el.value;
        changeWeight(w)
    }
    document.getElementById("selectHeight").onchange = function() {
        const el = document.getElementById("selectHeight");
        var h = el.value;
        changeHeight(h)
    }
</script>
</body>
</html>
