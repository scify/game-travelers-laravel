<x-layoutBlank
    :title="__('messages.app_name')"
    :has-vue=true
    :player-audio=$playerAudio
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
            :update-volumes-url="'{{ route('audio.updateVolumes') }}'"
            :continue-url="'{{ route('select.continue', [$player_id, 'continue', $game_id]) }}'"
            :board-url="'{{ route('select.board', [$player_id, 'board', 0]) }}'"
            :game-id='{{ $game_id }}'
            :player-data='@json($player_data)'
            :game-data='@json($game_data)'
            :cards='@json($cards)'>
        </board-component>
    </div>
</div>

<div
    id="switcherModal"
    class="modal fade"
    aria-hidden="true"
    tabindex="-1"
    >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content--white">
            <div class="modal-header">
                <h4 class="modal-title" id="switcherModalLabel">Πλήκτρα ελέγχου</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messages.switcher.dismiss') }}"></button>
            </div>
            <div class="modal-body">
                @if($player_data['auto']==1)
                <h5><i class="bi bi-joystick"></i>{{ __("messages.switcher.help_title_automatic") }}</h5>
                    <p>
                        {{ __("messages.switcher.help_automatic_button_select") }}
                        <kbd>{{ $player_data["select_key"] }}</kbd>.
                    </p>
                @else
                <h5><i class="bi bi-joystick"></i>{{ __("messages.switcher.help_title_manual") }}</h5>
                    <p>
                        {{ __("messages.switcher.help_manual_button_navigate") }}
                        <kbd>{{ $player_data["navigate_key"] }}</kbd>
                    </p>
                    <p>
                        {{ __("messages.switcher.help_manual_button_select") }}
                        <kbd>{{ $player_data["select_key"] }}</kbd>
                    </p>
                @endif
                <div class="mt-4">
                    <h5><i class="bi bi-volume-up-fill"></i>{{ __("messages.switcher.help_title_volume") }}</h5>
                    {{ __("messages.switcher.help_volume") }}: <kbd>+</kbd> &amp; <kbd>-</kbd>
                </div>
                <div class="mt-4">
                    <h5><i class="bi bi-123"></i>{{ __("messages.switcher.help_title_numbers") }}</h5>
                    {{ __("messages.switcher.help_numbers") }} <kbd>N</kbd>
                </div>
                <div class="mt-4">
                    <h5><i class="bi bi-box-arrow-right"></i> {{ __("messages.switcher.help_title_exit") }}</h5>
                    {{ __("messages.switcher.help_exit") }} <kbd>E</kbd>
                </div>
              </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


</x-layoutBlank>
