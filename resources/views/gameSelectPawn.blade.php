<x-layout
    :title="__('messages.select_pawn') . ' | ' . __('messages.new_game') . ' | ' . __('messages.app_name')"
    :hasUserMenu=true
    :background="'background-dash-up'"
>
    {{-- This page was designed responsively in order to support any amount of
         pawns, therefore you can simply use the x-selectPawnButton component as
         many times as needed. You can't disable panws with comingsoon=true.

         Pawns are linked to boards: The characters are the same, but they
         have different apperances (e.g. swiming suit on island, versus a
         footer on mountain. Therefore, @todo x-selectPawnButton excpects a
         board id and defaults to 1 for the island board.--}}
    @section('scripts')
        @php
            // @todo: Can we have all the configuration options for the user as
            // an array on all the pages that require the Switcher.js (tm) in
            // order to do something like that: ?
            $switcher = [
                'controlMode' => 2, // default: [1] - automatic mode
                'scanningSpeed' => 3, // default: [2] - in seconds
                'automaticSelectionButton' => 'Space', // default: [Space]
                'manualSelectionButton' => 'Space', // default: [Space]
                'manualNavigationButton' => 'Enter', // default: [Enter]
            ];
        @endphp
        <script>
            window.Switcher = {{ Js::from($switcher)}};
        </script>
        <script src="{{ mix('js/functions/switcher.js') }}" defer></script>
    @endsection

    <form method="post"
        action="{{ route('select.pawn', [ request()->player_id, request()->from, request()->game_id ]) }}"
    >
        @csrf

        <!-- section header -->
        <div class="gameselect-header container-lg px-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons.  --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">{{ __("messages.select_pawn") }}</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription">
                            {{--Use `&nbsp;` if no description.--}}
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
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Ιάσωνα'"
                    :tabindex=1
                />
                <x-selectPawnButton
                    :asset="'pawn-myrto'"
                    :title="'Μυρτώ'"
                    :pawn=2
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Μυρτούς'"
                    :tabindex=2
                />
                <x-selectPawnButton
                    :asset="'pawn-katerina'"
                    :title="'Κατερίνα'"
                    :pawn=3
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Κατερίνας'"
                    :tabindex=3
                />
                <x-selectPawnButton
                    :asset="'pawn-dimitris'"
                    :title="'Δημήτρης'"
                    :pawn=4
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Δημήτρη'"
                    :tabindex=4
                />
                <x-selectPawnButton
                    :asset="'pawn-vasilis'"
                    :title="'Βασίλης'"
                    :pawn=5
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Βασίλη'"
                    :tabindex=5
                />
                <x-selectPawnButton
                    :asset="'pawn-zoumpoulia'"
                    :title="'Ζουμπουλία'"
                    :pawn=6
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Ζουμπουλίας'"
                    :tabindex=6
                />
                <x-selectPawnButton
                    :asset="'pawn-vrasidas'"
                    :title="'Βρασίδας'"
                    :pawn=7
                    :board=1 {{-- PLACEHOLDER for board [default: 1] --}}
                    :alt="'Προεπισκόπηση πιονιού Βρασίδα'"
                    :tabindex=7
                />

            </div>
            <div class="row gx-0 pt-6 pt-sm-0 fix-pawn-margin">
                <div class="col-12">
                    <div class="d-flex flex-auto mt-4 mt-sm-0">
                        <a
                            class="btn btn-primary btn-circle ms-auto responsive-expand"
                            href="{{ route('select.mode', [ request()->player_id, 'mode', request()->game_id ])}}"
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
