<x-layout :title="'Επίλεξε τύπο παιχνιδιού | Νέο παιχνίδι | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- This page was designed responsively in order to support any amount of
         modes, therefore, you can simply use the x-selectMode[Link/Button]
         component as many times as needed (e.g. 1, 2, 3 or even more times).
         If one of the modes is not available for any reason, it can be
         disabled by setting :comingsoon=true (instead of the default null).
        -GET Example using <a> links:
         This page demonstrates the layout for a GET page where data are passed
         via simple links. The selectModeLink component is used, while each
         mode is an actual <a> link. All that has to be done is to make sure
         the this link contains the required info. If for example we are
         re-directing a user to the selectPawn.blade.php page and the user
         hasn't yet selected a pawn, then something like this could be used:
         @example select/pawn?player=1&board=1&mode=1&pawn=0
         I guess, the selected player ID should be checked in order to confirm
         that it belongs to the authenticated user, while additional checks
         should be made to ensure that the requested board, mode and pawn IDs
         are either valid or null/0.
         For an example using a form, @see demoGameSelectBoardForm.blade.php. In
         short, you should wrap the whole page in a <form> with the preferred
         method, add <input type="hidden"> fields, and use the
         x-selectModeButton.blade.php component instead. Make sure to pass
         the mode-id (kebab is converted to camel case on the component).
    --}}
    @section('scripts')
    @endsection

    {{-- form, if needed should start here --}}

    <!-- section header -->
    <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
        <div class="row">
            <div class="col-1">
                {{-- Reserved for header navigation buttons.  --}}
            </div>
            <div class="col-10 text-center" id="currentPageHeader">
                <h1 id="currentPageLabel">Διάλεξε παιχνίδι</h1>
                <p>
                    <strong class="fs-5" id="currentPageDescription">
                        {{-- If a description is REALLY NOT NEEDED, please
                            replace the following line with an &nbsp;
                            DO NOT LEAVE EMPTY!
                        --}}
                        Μονό, διπλό ή με αντίπαλό σου τον υπολογιστή;
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
            <x-selectModeLink {{-- if using a form replace with x-selectModeButton --}}
                :asset="'mode-single'"
                :title="'Μονό'"
                {{-- if using a form add :mode-id=X here --}}
                :alt="'Μονό παιχνίδι'" {{-- alt image desc --}}
                :tabindex=1 {{-- first board should be 1 (default: -1) --}}
                :url="'#'" {{-- e.g. select/pawn?player=1&board=1&mode=1pawn=0 --}}
                :comingsoon=null {{-- If set to true disables link, adds ΠΡΟΣΕΧΩΣ teaser. --}}
            />
            <x-selectModeLink
                :asset="'mode-double'"
                :title="'Διπλό'"
                {{-- if using a form add :mode-id=X here --}}
                :alt="'Διπλό παιχνίδι'" {{-- alt image desc --}}
                :tabindex=2
                :url="'#'"
                :comingsoon=null {{-- If set to true disables link, adds ΠΡΟΣΕΧΩΣ teaser. --}}
            />
            <x-selectModeLink
                :asset="'mode-pc'"
                :title="'Με υπολογιστή'"
                {{-- if using a form add :mode-id=X here --}}
                :alt="'Παιχνίδι με υπολογιστή'" {{-- alt image desc --}}
                :tabindex=3
                :url="'#'"
                :comingsoon=null {{-- If set to true disables link, adds ΠΡΟΣΕΧΩΣ teaser. --}}
            />
        </div>
        <div class="row gx-0 pt-6 pt-sm-0 pt-md-0 pt-lg-0 pt-xxl-6">
            <div class="col-12">
                <div class="d-flex flex-auto">
                    {{-- in case of form use button instead of <a> --}}
                    <a
                        class="btn btn-primary btn-circle ms-auto responsive-expand"
                        href="#"
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

    {{-- form, if needed should end here --}}

</x-layout>
