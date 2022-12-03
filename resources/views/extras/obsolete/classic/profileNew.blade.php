<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Νέο προφίλ παίκτη | Ταξιδιώτες</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- absolute middle relative containers -->
    <div class="trvl-middleflex--container">
        <div class="trvl-middleflex--contents">
          <!-- absolute middle relative containers -->

    <x-header/>

    <!-- step counter (line 1 - step 1/3 -->
    <div class="container-xxl trvl-profiles-steps">
        <div class="row trvl-bg--step1">
            <div class="col col-1 trvl-bg trvl-bg--step1-left">

            </div>
            <div class="col col-11 trvl-bg trvl-bg--step1-right">
                <button class="btn btn-round step1-right">προφίλ</button>
            </div>
        </div>
    </div>

    <!-- main-content -->
    {{-- Note that trvl-profiles set the relative max-height of the container
        and it has to be as accurate as possible to match other screens --}}
    <div class="container-xxl trvl-main-content trvl-profiles">

        <form>

            <div id="nameRow" class="row trvl-profiles--row {{-- Class "row-alter" goes here in case of alertName --}}">
                <div class="col-md-3">
                    <label class="extended big" for="playerName">
                        Ονομα παίκτη
                    </label>
                </div>
                <div class="col-md-9">
                    <input class="extended big" id="playerName" type="text" name="name" tabindex="1" />
                    <div class="alert" id="alertName">{{-- Message of alertName goes here --}}</div>
                </div>
            </div>

            <div id="avatarRow" class="row trvl-profiles--row">
                <div class="col-md-3">
                    <label class="extended big" for="">
                        Διάλεξε άβαταρ
                    </label>
                </div>
                <div class="col-md-9">

                    <div class="container-lg text-center trvl-avatars">
                        <div class="row trvl-avatars--row">
                            <x-profileNewAvatar :avatar=$avatarData[0] />
                            <x-profileNewAvatar :avatar=$avatarData[1] />
                            <x-profileNewAvatar :avatar=$avatarData[2] />
                            <x-profileNewAvatar :avatar=$avatarData[3] />
                            <x-profileNewAvatar :avatar=$avatarData[4] />
                            <x-profileNewAvatar :avatar=$avatarData[5]/>
                        </div>
                    </div>

                </div>
            </div>

            <div id="nextRow" class="row trvl-profiles--row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9 text-center-end">
                    <strong>
                        Διάλεξε ένα όνομα και ένα άβαταρ για να συνεχίσεις!
                    </strong>
                </div>
            </div>

        </form>

    </div>

    <x-footer/>

        <!-- absolute middle relative containers -->
    </div>
</div>
<!-- absolute middle relative containers -->

<style type="text/css">
    .trvl-profiles {
        min-height: 502px;
        padding-left: 5em !important;
        padding-right: 5em !important;
    }
    .trvl-profiles h1 {
        font-size: 2.4em;
    }
    .trvl-profiles-steps {
        margin-bottom: 2.5em;
    }
    @media (max-width: 575.98px) {
        .trvl-profiles {
            /* defaults to ps-4 pe-4 */
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }
    }

    .trvl-profiles--row:first-child {
        margin-bottom: 2.5em;
    }
    .trvl-profiles--row:last-child {
        margin-bottom: 5em;
    }
    .btn-round {
        border-radius: 50%;
    }

    .trvl-profiles-steps .btn-round {
        background-color: #2f3130;
        color: var(--trvl-c-background);
        position: relative;
        padding: 0;
        margin: 0;
        z-index: 98;
        width: 90px;
        height: 90px;
        font-size: 16px;
        font-weight: bold;
    }
    .btn-round.step1-right {
        left: -20px;
        top: 20px;
    }

    .trvl-avatars {
    }
    .trvl-avatars--col {
        min-height: 150px;
        /* border: 1px solid #000; */
    }
    .btn-round.btn-avatar {
        --bs-btn-active-bg: #edf9dd;
        --bs-btn-hover-bg: var(--trvl-btn-hover-bg);
        background-color: var(--trvl-btn-bg);
        transition: all .2s ease-out;
        padding: 0;
        border: none;
        width: 100px;
        height: 100px;
    }
    .btn-round.btn-avatar:focus,
    .btn-round.btn-avatar:focus-visible:not(:hover) {
        scale: 1.04;
    }
    .btn-round.btn-avatar:hover {
        scale: 1.1;
    }
    @media (prefers-reduced-motion) {
        .btn.round.btn-avatar:hover {
            scale: 1 !important;
        }
    }
    .btn-avatar img {
        position: relative;
        display: inline-block;
        margin: 0 !important;
        padding: 0 !important;
        width: 100px;
        height: 100px;
    }
    .btn-avatar > .btn-text {
        display: block;
        position: relative;
        top: 0px;
        z-index: 98;
        text-align: center;
    }
    .btn-avatar > .btn-text.hidden {
        left: -2000px;
        right: -2000px;
    }
</style>

</body>
</html>
