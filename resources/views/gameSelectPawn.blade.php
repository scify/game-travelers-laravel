<x-layout :title="'Διάλεξε πιόνι | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         pawns, therefore, you can simply use the x-selectPawn[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
         If one of the pawns is not available for any reason, it can be
         disabled by setting :comingsoon=true (instead of the default null).
         I guess, the selected player ID should be checked in order to confirm
         that it belongs to the authenticated user, while additional checks
         should be made to ensure that the requested board, mode and pawn IDs
         are either valid or null/0.
    --}}
    @section('scripts')
    @endsection

    <form method="post" action="{{ url('/select/options') }}"> {{-- form starts here --}}
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
        <input type="hidden" name="option" value="0" /> {{-- 0- for not yet selected --}}

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
            <div class="row text-center justify-content-center gy-4 gy-xxl-2">
                <x-selectPawnButton
                    :asset="'pawn-iasonas'"
                    :title="'Ιάσωνας'"
                    :pawn=1
                    :alt="'Προεπισκόπηση πιονιού Ιάσωνα'" {{-- alt image desc --}}
                    {{-- add :pawn-id=$pawnId }} for if using PawnButton buttons --}}
                    :tabindex=1 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. game?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-myrto'"
                    :title="'Μυρτώ'"
                    :pawn=2
                    :alt="'Προεπισκόπηση πιονιού Μυρτούς'" {{-- alt image desc --}}
                    :tabindex=2 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. game?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-katerina'"
                    :title="'Κατερίνα'"
                    :pawn=3
                    :alt="'Προεπισκόπηση πιονιού Κατερίνας'" {{-- alt image desc --}}
                    :tabindex=3 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-dimitris'"
                    :title="'Δημήτρης'"
                    :pawn=4
                    :alt="'Προεπισκόπηση πιονιού Δημήτρη'" {{-- alt image desc --}}
                    :tabindex=4 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-vasilis'"
                    :title="'Βασίλης'"
                    :pawn=5
                    :alt="'Προεπισκόπηση πιονιού Βασίλη'" {{-- alt image desc --}}
                    :tabindex=5 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-zoumpoulia'"
                    :title="'Ζουμπουλία'"
                    :pawn=6
                    :alt="'Προεπισκόπηση πιονιού Ζουμπουλίας'" {{-- alt image desc --}}
                    :tabindex=6 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
                />
                <x-selectPawnButton
                    :asset="'pawn-vrasidas'"
                    :title="'Βρασίδας'"
                    :pawn=7
                    :alt="'Προεπισκόπηση πιονιού Βρασίδα'" {{-- alt image desc --}}
                    :tabindex=7 {{-- first pawn should be 1 (default: -1) --}}
                    :url="url('/select/options')" {{-- e.g. options?player=1&board=1&mode=1&pawn=1 --}}
                />

            </div>
            <div class="row gx-0 pt-6 pt-sm-0 fix-pawn-margin">
                <div class="col-12">
                    <div class="d-flex flex-auto mt-4 mt-sm-0">
                       {{-- Maybe this has to be part of the form as well.
                            If it does, change element to button and add a
                            type="submit" and proper name and value attrs. --}}
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

    </form>

</x-layout>
