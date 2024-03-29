<x-layout
    :title="'Διάλεξε τύπο παιχνιδιού | Νέο παιχνίδι | Ταξιδιώτες'"
    :has-user-menu=true
    :header-background="'background-dash-up'"
    :player-audio=$playerAudio
>
    {{--This page was designed responsively in order to support any amount of
        modes, therefore you can simply use the x-selectModeButton component as
        many times as needed. If one of the modes is not available for any
        reason, it can be disabled by setting :comingsoon=true (instead of the
        default null).--}}
    @section('scripts')
        <x-switcher :switcher=$switcher :music="'music.feelin_good'" />
    @endsection

    <form method="post"
        action="{{ route('select.mode', [ request()->player_id, request()->from, request()->game_id ]) }}"
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{--Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Διάλεξε παιχνίδι</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
                            Μονό ή με αντίπαλό σου τον υπολογιστή;
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{--  Reserved for header navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gameselect container-xxl pt-5 px-4 px-lg-6">
            <div class="row text-center gx-2 gy-5">
                <x-selectModeButton
                    :asset="'mode-single'"
                    :title="'Μονό'"
                    :mode=1
                    :alt="'Μονό παιχνίδι'"
                    :audio-select="'sounds.game_start.mode_1_select'"
                    :tabindex=1
                    :comingsoon=null {{--Προσεχώς: true / null (default)--}}
                />
                <x-selectModeButton
                    :asset="'mode-pc'"
                    :title="'Με υπολογιστή'"
                    :mode=2
                    :alt="'Παιχνίδι με υπολογιστή'"
                    :audio-select="'sounds.game_start.mode_2_select'"
                    :tabindex=2
                    :comingsoon=null {{--Προσεχώς: true / null (default)--}}
                />
                <!-- option for two player game removed -->
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-0 pt-lg-0 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route('select.board', [ request()->player_id, 'board', request()->game_id ]) }}"
                            id="backButton"
                            data-tabindex="100"
                            tabindex="100"
                        >
                            <span>πίσω</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>
