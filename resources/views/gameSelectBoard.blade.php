<x-layout :title="'Επίλεξε πίστα | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         boards, therefore, you can simply use the x-selectLevel[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
        -GET Example using <a> links:
         This page demonstrates the layout for a GET page where data are passed
         via simple links. The selectLevelLink component is used, while each
         board is an actual <a> link. All that has to be done is to make sure
         the this link contains the required info. If for example we are
         re-directing a user to the selectMode.blade.php page and the user
         hasn't yet selected a pawn, then something like this could be used:
         @example select/mode?player=1&board=1&pawn=0
         I guess, the selected player ID should be checked in order to confirm
         that it belongs to the authenticated user, while additional checks
         should be made to ensure that the requested board, mode and pawn IDs
         are either valid or null/0.
    --}}
    @section('scripts')
    @endsection

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
        <div class="row text-center gy-5">
            <x-selectBoardLink
                :asset="'board-island'"
                :title="'Νησί'"
                :alt="'Προεπισκόπηση πίστας νησιού'" {{-- alt image desc --}}
                :tabindex=1 {{-- first board should be 1 (default: -1) --}}
                :url="'#'" {{-- e.g. select/mode?player=1&board=1&pawn=0 --}}
            />
            <x-selectBoardLink
                :asset="'board-island'"
                :title="'Βουνό'"
                :alt="'Προεπισκόπηση πίστας βουνού'" {{-- alt image desc --}}
                :tabindex=2
                :url="'#'"
                :comingsoon=true {{-- Disables link, adds ΠΡΟΣΕΧΩΣ teaser --}}
            />
            <x-selectBoardLink
                :asset="'board-island'"
                :title="'Πόλη'"
                :alt="'Προεπισκόπηση πίστας πόλης'" {{-- alt image desc --}}
                :tabindex=3
                :url="'#'"
                :comingsoon=true {{-- Disables link, adds ΠΡΟΣΕΧΩΣ teaser --}}
            />
        </div>
        <div class="row gx-0 pt-6 pt-sm-0 pt-md-0 pt-lg-0 pt-xxl-6">
            <div class="col-12">
                <div class="d-flex flex-auto">
                    <a
                        class="btn btn-primary btn-circle ms-auto responsive-expand"
                        href="#"
                        id="backButton"
                        tabindex="1000"
                    >
                        <span>πίσω</span>
                    </a>

                </div>
            </div>
        </div>
    </div>

</x-layout>
