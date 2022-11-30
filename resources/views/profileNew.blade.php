<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Νέο προφίλ | Ταξιδιώτες</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <x-header/>

    <!-- main-content -->
    <div class="container-xxl ps-4 pe-4 trvl-main-content trvl-bg trvl-bg--group-1">

        <div class="row">
            <div class="col-3">
                Ονομα παίκτη
            </div>
            <div class="col-9">
                Εισαγωγή ονόματος παίκτη
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                Διάλεξε άβαταρ
            </div>
            <div class="col-md-9">

                <div class="container-lg">
                    <div class="row trvl-avatars">
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                        <x-profileNewAvatar/>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <x-footer/>

<style type="text/css">
    .btn-round {

    }
    .row.trvl-avatars {
    }
    .row.trvl-avatars .col {
        min-height: 150px;
        /* border: 1px solid #000; */
    }
    .btn-round.btn-avatar {
        --bs-btn-active-bg: #edf9dd;
        padding: 0;
        background-color: var(--trvl-btn-bg);
        transition: all .2s ease-in;
        border: none;
        --bs-btn-hover-bg: var(--trvl-btn-hover-bg);
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }
    .btn-round.btn-avatar:hover {
        scale: 1.1;
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
