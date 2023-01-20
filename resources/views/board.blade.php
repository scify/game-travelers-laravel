<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Game board</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="app" class="d-flex align-items-center justify-content-center vh-100 w-100">
    <div style="height: 768px; width: 1366px" class="border border-dark no-gutters">
        <board-component
            :player-id='{{ $player_id }}'
            :backend-url="'{{ route('to.backend') }}'"
            :exit-url="'{{ route('select.player', [0,'user',0]) }}'"
            :game-id='{{ $game_id }}'
            :player-data='@json($player_data)'
            :game-data='@json($game_data)'>
        </board-component>
    </div>
</div>

</body>
<script src="{{ mix('js/vue.js') }}" type="text/javascript"></script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
    };
</script>
</html>
