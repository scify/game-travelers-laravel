<x-layout :title="'Διάλεξε πίστα | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         boards, therefore, you can simply use the x-selectLevel[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
         If one of the boards is not available for any reason, it can be
         disabled by setting :comingsoon=true (instead of the default null).
         I guess, the selected player ID should be checked in order to confirm
         that it belongs to the authenticated user, while additional checks
         should be made to ensure that the requested board, mode and pawn IDs
         are either valid or null/0.
    --}}
    @section('scripts')
    @endsection

    <form method="post" action="{{ url('/select/mode') }}"> {{-- form starts here --}}
        @csrf

        {{-- Not sure if those are needed, but it's an alternative way to pass
        along these arguments, in case the user has already made a selection and
        moved back. Requires some testing with both browser's and site's back
        buttons for the final implementation. Note that the there are always
        4 hidden values including the player id. One is not hidden as it is
        the one that can actually be selected via this page's buttons. " --}}
        <input type="hidden" name="player" value="1" /> {{-- player ID --}}
        <input type="hidden" name="mode" value="0" /> {{-- 0- for not yet selected --}}
        <input type="hidden" name="pawn" value="0" /> {{-- 0- for not yet selected --}}
        <input type="hidden" name="option" value="0" /> {{-- 0- for not yet selected --}}

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Διάλεξε πίστα</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{-- If a description is REALLY not needed, please
                                replace the following line with an &nbsp;
                                DO NOT LEAVE EMPTY!
                            --}}
                            Νησί, βουνό ή πόλη; Που θα ήθελες να ταξιδέψεις;
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
                <x-selectBoardButton
                    :asset="'board-island'"
                    :title="'Νησί'"
                    :board=1
                    :alt="'Προεπισκόπηση πίστας νησιού'" {{-- alt image desc --}}
                    :tabindex=1 {{-- first board should be 1 (default: -1) --}}
                    {{-- :url="url('/select/mode')" --}}
                    :comingsoon=null {{-- Disables link, adds ΠΡΟΣΕΧΩΣ teaser, REMOVE or set to null to disable. --}}
                />
                <x-selectBoardButton
                    :asset="'board-island'" {{-- if there's no asset yet, just use "'board-island'" --}}
                    :title="'Βουνό'"
                    :board=2
                    :alt="'Προεπισκόπηση πίστας βουνού'" {{-- alt image desc --}}
                    :tabindex=2
                    {{-- :url="url('/select/mode')" --}}
                    :comingsoon=true {{-- Disables link, adds ΠΡΟΣΕΧΩΣ teaser, REMOVE or set to null to disable. --}}
                />
                <x-selectBoardButton
                    :asset="'board-island'" {{-- if there's no asset yet, just use "'board-island'" --}}
                    :title="'Πόλη'"
                    :board=3
                    :alt="'Προεπισκόπηση πίστας πόλης'" {{-- alt image desc --}}
                    :tabindex=3
                    {{-- :url="url('/select/mode')" --}}
                    :comingsoon=true {{-- Disables link, adds ΠΡΟΣΕΧΩΣ teaser, REMOVE or set to null to disable. --}}
                />
            </div>
            <div class="row gx-0 pt-6 pt-sm-0 pt-md-0 pt-lg-0 pt-xl-6 pt-xxl-6">
                <div class="col-12">
                    <div class="d-flex flex-auto">
                        {{-- Maybe this has to be part of the form as well. Oh well. I suppose making it a button works but haven't tested it yet. --}}
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route('select.player')}}"
                            tabindex="1000"
                            data-tabindex="1000"
                            type="submit"
                            id="backButton"
                        >
                            <span>πίσω</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </form> {{-- Form ends here --}}

</x-layout>
