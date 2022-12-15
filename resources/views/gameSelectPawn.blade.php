<x-layout :title="'Διάλεξε πιόνι | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         pawns, therefore, you can simply use the x-selectPawn[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
         If one of the pawns is not available for any reason, it can be
         disabled by setting :comingsoon=true (instead of the default null).
        -GET Example using <a> links:
         This page demonstrates the layout for a GET page where data are passed
         via simple links. The selectPawnLink component is used, while each
         pawn is an actual <a> link. All that has to be done is to make sure
         the this link contains the required info. If for example we are
         re-directing a user to the game.blade.php page, then something like
         this could be used: @example game?player=1&board=1&mode=1&pawn=1
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
                <h1 id="currentPageLabel">Διάλεξε πιόνι</h1>
                <p>
                    <strong class="fs-5" id="currentPageDescription">
                        &nbsp;
                    </strong>
                </p>
            </div>
            <div class="col-1">
                {{--  Reserved for header navigation buttons. --}}
            </div>
        </div>
    </div>
    <!-- / section header -->

    <div class="section gameselect container-xxl pt-3 px-4 px-lg-6">
        <div class="row text-center justify-content-center gy-2">
            <x-selectPawnLink
                :asset="'pawn-iasonas'"
                :title="'Ιάσωνας'"
                :alt="'Προεπισκόπηση πιονιού Ιάσωνα'" {{-- alt image desc --}}
                {{-- add :pawn-id=$pawnId }} for if using PawnButton buttons --}}
                :tabindex=1 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. game?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-myrto'"
                :title="'Μυρτώ'"
                :alt="'Προεπισκόπηση πιονιού Μυρτούς'" {{-- alt image desc --}}
                :tabindex=2 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. game?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-katerina'"
                :title="'Κατερίνα'"
                :alt="'Προεπισκόπηση πιονιού Κατερίνας'" {{-- alt image desc --}}
                :tabindex=3 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-dimitris'"
                :title="'Δημήτρης'"
                :alt="'Προεπισκόπηση πιονιού Δημήτρη'" {{-- alt image desc --}}
                :tabindex=4 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-vasilis'"
                :title="'Βασίλης'"
                :alt="'Προεπισκόπηση πιονιού Βασίλη'" {{-- alt image desc --}}
                :tabindex=5 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-zoumpoulia'"
                :title="'Ζουμπουλία'"
                :alt="'Προεπισκόπηση πιονιού Ζουμπουλίας'" {{-- alt image desc --}}
                :tabindex=6 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
            />
            <x-selectPawnLink
                :asset="'pawn-vrasidas'"
                :title="'Βρασίδας'"
                :alt="'Προεπισκόπηση πιονιού Βρασίδα'" {{-- alt image desc --}}
                :tabindex=7 {{-- first pawn should be 1 (default: -1) --}}
                :url="'/select/options'" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
            />

        </div>
        <div class="row gx-0 pt-6 pt-sm-0 fix-pawn-margin">
            <div class="col-12">
                <div class="d-flex flex-auto">
                    <a
                        class="btn btn-primary btn-circle ms-auto responsive-expand"
                        href="{{ url('/select/mode' )}}"
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

</x-layout>
