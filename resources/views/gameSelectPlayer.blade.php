<x-layout :title="'Επίλεξε παίκτη | Νέο παιχνίδι | Ταξιδιώτες'">
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <!-- section header -->
    <div class="gamesettings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-1">
        <div class="row">
            <div class="col-1">
                <x-buttonBack :label="'Επιστροφή στο προηγούμενο μενού'" />
            </div>
            <div class="col-10 text-center" id="currentPageHeader">
                <h1 id="currentPageLabel">Νέο παιχνίδι</h1>
                <p>
                    <strong class="fs-5" id="currentPageDescription">
                        Διάλεξε παίκτη ή δημιούργησε ένα νέο προφίλ.
                    </strong>
                </p>
            </div>
            <div class="col-1">
                {{-- @TODO: Fix alignment, create another button --}}
            </div>
        </div>
    </div>
    <!-- / section header -->

    <!-- new game: select player content -->
    <div class="section gamesettings container-xxl px-4 px-sm-5 px-xl-6">
        <div
            class="field settings-row row mb-2"
            role="radiogroup"
            aria-labelledby="currentPageLabel"
            aria-describedby="currentPageDescription"
            id="avatarGroup"
        >

            <div class="col-md-12">
                <x-selectPlayer
                    :avatars=$avatars
                    :tabindex=1
                    :selected-player-id=0
                />
            </div>

        </div>
    </div>
    <!-- / new game: select player content -->


</x-layout>
