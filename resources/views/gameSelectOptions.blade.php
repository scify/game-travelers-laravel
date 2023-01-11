<x-layout :title="'Διάλεξε παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         options, therefore, you can simply use the x-selectOptions[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
         If one of the options is not available for any reason, it can be
         disabled by setting :comingsoon=true (instead of the default null).
         I guess, the selected player ID should be checked in order to confirm
         that it belongs to the authenticated user, while additional checks
         should be made to ensure that the requested board, mode and pawn IDs
         are either valid or null/0.
         For an example using a form, @see demoGameSelectBoardForm.blade.php. In
         short, you should wrap the whole page in a <form> with the preferred
         method, add <input type="hidden"> fields, and use the
         x-selectOptionsButton.blade.php component instead. Make sure to pass
         the mode-id (kebab is converted to camel case on the component).
    --}}
    @section('scripts')
    @endsection

    <form method="post" action="{{ route('select.options', [ request()->player_id, request()->from, request()->game_id ]) }}"> {{-- form starts here --}}
        @csrf

        {{-- Not sure if those are needed, but it's an alternative way to pass
        along these arguments, in case the user has already made a selection and
        moved back. Requires some testing with both browser's and site's back
        buttons for the final implementation. Note that the there are always
        4 hidden values including the player id. One is not hidden as it is
        the one that can actually be selected via this page's buttons. " --}}
        <input type="hidden" name="player" value="1" /> {{-- player ID --}}
        <input type="hidden" name="board" value="0" /> {{-- 0- for not yet selected --}}
        <input type="hidden" name="mode" value="0" /> {{-- 0- for not yet selected --}}
        <input type="hidden" name="pawn" value="0" /> {{-- 0- for not yet selected --}}

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    {{-- @TODO: Μμμμμ. Δεν είναι ικανοποιητικά σαφής ο τίτλος
                        επίσης επαναλαμβάνει όσα αναφέρονται στη σελίδα του τύπου:
                        see @sgameSelectMode.blade.php . Αλλαγή; --}}
                    <h1 id="currentPageLabel">Διάλεξε παιχνίδι</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{-- If a description is REALLY NOT NEEDED, please
                                replace the following line with an &nbsp;
                                DO NOT LEAVE EMPTY!
                            --}}
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
                    :tabindex=1 {{-- first option should be 1 (default: -1) --}}
                    :url="'#'" {{-- e.g. game?player=1&board=1&mode=1&pawn=0 --}}
                    :comingsoon=null {{-- If set to true disables link. --}}
                />
                <x-selectOptionsButton
                    :title="'Θέλω να παίξω'"
                    :option=2
                    :tabindex=2
                    :url="'#'"
                    :comingsoon=null {{-- If set to true disables link. --}}
                />
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-6 pt-lg-6 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        {{-- Maybe this has to be part of the form as well.
                            If it does, change element to button and add a
                            type="submit" and proper name and value attrs. --}}
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
