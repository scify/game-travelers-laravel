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
        <div class="gamesettings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-1">
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
                    {{-- @TODO: Fix alignment, create another button --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gamesettings container-xxl px-4">
            <div class="row">
                <div class="col-1 d-none d-lg-block d-print-none" role="presentation">
                </div>
                <div class="col-12 col-lg-10">
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
                <div class="col-1 d-none d-lg-block d-print-none" role="presentation">
                </div>
            </div>
            <div class="action-buttons row">
                <div class="col-1 d-none d-lg-block d-print-none" role="presentation">
                </div>
                <div class="col-12 col-lg-10 align-self-center text-center">
                    <div class="">
                        <button
                            data-role="submit-form-button"
                            class="btn btn-primary btn-lg w-11 responsive-expand"
                            name="submit"
                            value="submit"
                            type="submit"
                            id="submitButton" {{-- ID Used by JS --}}
                            tabindex="1000"
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            παίξε
                        </button>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button
                            data-role="submit-form-button"
                            class="btn btn-secondary btn-lg w-11 responsive-expand"
                            name="submit"
                            value="submit"
                            type="submit"
                            id="secondaryButton" {{-- ID Used by JS --}}
                            tabindex="1001"
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            ρυθμίσεις
                        </button>
                    </div>
                </div>
                <div class="col-1 d-none d-lg-block d-print-none" role="presentation">
                </div>
            </div>
        </div>

    </form>

</x-layout>
