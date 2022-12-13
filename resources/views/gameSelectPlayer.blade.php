<x-layout :title="'Επίλεξε παίκτη | Νέο παιχνίδι | Ταξιδιώτες'">
    {{-- To be fair this would have been a nice Vue app. For now it's a form
         with custom JS. Note that as in the profileNewStep1 form, the buttons
         container acts as a radiogroup and each button is a radio (with the
         exception of the "add new player" button, which is really an <a> link).
    --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <form method="post" action="" id="newGame"> {{-- unused id --}}
        @csrf

            <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mt-lg-n4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- @TODO: Return to nowhere? --}}
                </div>
                <div class="col-10 text-center" id="currentPageHeader"> {{-- Why is this fs-5? cause it acts as the label of the radio buttons! --}}
                    <h1 id="currentPageLabel">Νέο παιχνίδι</h1>
                    <p>
                        <strong class="fs-5" id="currentPageDescription"> {{-- Why is this fs-5? cause it acts as the label of the radio buttons! --}}
                            Διάλεξε παίκτη ή δημιούργησε νέο προφίλ.
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- @TODO: ELI5 Logging-out without selecting a player. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gamesettings container-xxl px-4 background-dash-down ">
            <div class="row gx-0">
                <div class="background background-group-2--col background-group-2--tree-1 col-2 col-xxl-2 d-none d-lg-block d-print-none" role="presentation">
                </div>
                <div class="background-group-2--col col-12 col-lg-8 col-xxl-8 pt-0 pt-lg-5">
                    <!-- new game: select player content -->
                    <div class="container-fluid"> {{--  px-4 px-sm-5 px-xl-7 --}}
                        <div
                            class="field settings-row row mb-2"
                            role="radiogroup"
                            aria-labelledby="currentPageLabel"
                            aria-describedby="currentPageDescription"
                            id="avatarGroup"
                        >

                            <div class="col-md-12">
                                <x-selectPlayer
                                    :avatars=$players_with_avatars {{-- @see ../../docs/exampleData.php --}}
                                    :selected-player-id=0 {{-- 0: none selected --}}
                                    :tabindex=1 {{-- Accessibility (int). --}}
                                    :show-add-player=true {{-- Optional. TRUE or NULL (default).--}}
                                />
                            </div>

                        </div>
                    </div>
                    <!-- / new game: select player content -->
                </div>
                <div class="background-group-2--col background background-group-2 background-group-2--tree-2 col-2 col-xxl-2 d-none d-lg-block d-print-none" role="presentation">
                </div>
            </div>
            <div class="row gx-0">
                <div class="col-12">
                    <div class="vstack gap-3 col-12 col-sm-4 col-md-3 mt-2 mb-4 mb-sm-0 mx-auto">
                        <button
                            data-role="submit-form-button"
                            class="btn btn-primary btn-lg"
                            name="submit"
                            value="start"
                            type="submit"
                            id="submitButton" {{-- ID Used by JS --}}
                            tabindex="1000"
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            παίξε
                        </button>
                        <button
                            data-role="submit-form-button"
                            class="btn btn-secondary btn-lg"
                            name="submit"
                            value="settings"
                            type="submit"
                            id="secondaryButton" {{-- ID Used by JS --}}
                            tabindex="1001"
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            ρυθμίσεις
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>
