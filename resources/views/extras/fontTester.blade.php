<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Font Tester</title>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
        <div class="alert alert-success pt-4">
            Return <a href="{{ url ('/') }}">Home</a>
        </div>

        <h1>Φοντ τέστερ Font tester</h1>
        <p>
            This was meant as a Font Tester for
            <a
                href="https://fonts.google.com/specimen/Inter+Tight"
                target="_blank"
                rel="noopener noreferrer",
                referrerpolicy="noreferrer"
            >
                Inter Tight
            </a>, the original font used in this project. Since then, we have
            moved to Manrope and this page hasn't been updated to reflect that.
        </p>
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
