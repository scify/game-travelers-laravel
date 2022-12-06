<x-layout :title="'Δυσκολία | Νέος παίκτης - Βήμα 3ο | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for settings --}}
    @endsection

    <!-- new player step 3/3 content -->
    <form method="post" action="" id="profileNewStep3">
        @csrf

        <!-- step counter 3/3 -->
        <div class="stepper container-xxl">
            <div class="step3 row">
                <div class="step3-1 col-1">
                    <!-- empty -->
                </div>
                <div class="step3-2 col-4">
                    <button
                        class="btn btn-round past"
                        title="Προφίλ παίκτη"
                        aria-label="Προφίλ παίκτη"
                        type="submit"
                    >
                        1
                    </button>
                </div>
                <div class="step3-3 col-5">
                    <button
                        class="btn btn-round past"
                        title="Ρυθμίσεις χειρισμού"
                        aria-label="Ρυθμίσεις χειρισμού"
                        type="submit"
                    >
                        2
                    </button>
                </div>
                <div class="step3-4 col-2">
                    <button
                    class="btn btn-round current"
                    title="Ρυθμίσεις δυσκολίας"
                    aria-label="Ρυθμίσεις δυσκολίας"
                    aria-describedby="currentPageDescription"
                    aria-current="page"
                    aria-readonly="true"
                    tabindex="-1"
                    name="page"
                    value="difficulty"
                    type="submit"
                    disabled
                    id="currentPageButton"
                    >
                        3
                    </button>
                </div>
            </div>
        </div>
        <!-- / step counter 3/3 -->

        <!-- section header -->
        <div class="settings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-5">
            <div class="row">
                <div class="col-1">
                    <x-buttonBack :label="'Ολοκλήρωση και επιστροφή στο προηγούμενο μενού'" />
                </div>
                <div class="col-10 text-center" id="currentPageDescription">
                    <h1>Δυσκολία</h1>
                    <p><strong>Επίλεξε πόσο εύκολο ή δύσκολο θέλεις να είναι
                        το παιχνίδι.
                    </strong>
                </div>
                <div class="col-1"></div>
           </div>
        </div>
        <!-- / section header -->

        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">

            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button class="btn btn-primary btn-lg responsive-expand" type="submit" id="submitButton">ολοκλήρωση ρυθμίσεων</button>
            </div>

        </div>

    </form>
    <!-- / new player step 3/3 content -->

</x-layout>
