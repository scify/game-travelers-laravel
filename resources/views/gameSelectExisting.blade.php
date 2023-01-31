<x-layout :title="'Νέο παιχνίδι ή συνέχεια προηγούμενου; | Ταξιδιώτες'" :hasUserMenu=true :headerBackground="'background-dash-up'">
    {{--This page was designed as an accessible modal for use in combination
        with Switcher.js. It is based on gameSelectOptions.php and uses the
        same x-selectOptionsButton components.--}}
    @section('scripts')
        <x-switcher :switcher=$switcher :music="'music.feelin_good'" />
    @endsection

    <form method="post"
        action="{{ route('select.continue', [ request()->player_id, request()->from, request()->game_id ]) }}" {{-- dont forget the back button! --}}
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Νέο παιχνίδι ή συνέχεια προηγούμενου;</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
                           Έχεις ήδη ξεκινήσει να παίζεις ένα παιχνίδι.
                           Θες να το συνεχίσεις;
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
                <x-selectOptionsButton
                    :title="'Νέο παιχνίδι'"
                    :option=1
                    :tabindex=1
                />
                <x-selectOptionsButton
                    :title="'Συνέχεια παιχνιδιού'"
                    :option=2
                    :tabindex=2
                />
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-6 pt-lg-6 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route("select.player", [0,"user", 0]) }}"
                            id="backButton"
                            data-tabindex="1000"
                            tabindex="1000"
                        >
                            <span>πίσω</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>
