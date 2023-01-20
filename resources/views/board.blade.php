<x-layoutBlank
    :title="__('messages.app_name')"
    :hasVue=true
>
@section('scripts')
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
@endsection

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

</x-layoutBlank>
