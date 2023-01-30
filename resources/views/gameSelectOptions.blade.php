<x-layout :title="'Διάλεξε παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         options, therefore, you can simply use the x-selectOptionsButton
         component as many times as needed. If one of the options is not
         available for any reason, it can be disabled by setting
         :comingsoon=true (this will not add a coming soon teaser as usual, but
         it will simply disable the option instead).--}}
    @section('scripts')
        <x-switcher :switcher=$switcher />
        <script>window.setTimeout(function() {window.music("music.feelin_good");}, 500);</script>
    @endsection

    <form method="post"
        action="{{ route('select.options', [ request()->player_id, request()->from, request()->game_id ]) }}"
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    {{-- @todo: Μμμμμ. Δεν είναι ικανοποιητικά σαφής ο τίτλος
                        επίσης επαναλαμβάνει όσα αναφέρονται στη σελίδα:
                        see @sgameSelectMode.blade.php . Αλλαγή; --}}
                    <h1 id="currentPageLabel">Διάλεξε παιχνίδι</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
                            Μάθε να παίζεις ή ξεκίνα το παιχνίδι!
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
                    :title="'Μάθε μου να παίζω'"
                    :option=1
                    :tabindex=1
                    :url="'#'"
                    :comingsoon=null
                />
                <x-selectOptionsButton
                    :title="'Θέλω να παίξω'"
                    :option=2
                    :tabindex=2
                    :url="'#'"
                    :comingsoon=null
                    :audio-select="'sounds.game_start.option_2_select'"
                />
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-6 pt-lg-6 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route('select.pawn', [ request()->player_id, 'pawn', request()->game_id ]) }}"
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
