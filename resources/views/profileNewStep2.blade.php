<x-layout :title="'Χειρισμός | Νέος παίκτης - Βήμα 2ο | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for settings --}}
    @endsection

    <!-- new player step 2/3 content -->
    <form method="post" action="" id="profileNewStep2">
        @csrf

        <!-- step counter 2/3 -->
        <div class="stepper container-xxl">
            <div class="step2 row">
                <div class="step2-1 col-1">
                    <!-- empty -->
                </div>
                <div class="step2-2 col-4">
                    <button
                        class="btn btn-round past"
                        title="Προφίλ παίκτη"
                        aria-label="Προφίλ παίκτη"
                        type="submit"
                    >
                        1
                    </button>
                </div>
                <div class="step2-3 col-7">
                    <button
                    class="btn btn-round current"
                    title="Ρυθμίσεις χειρισμού"
                    aria-label="Ρυθμίσεις χειρισμού"
                    aria-describedby="currentPageDescription"
                    aria-current="page"
                    aria-readonly="true"
                    tabindex="-1"
                    name="page"
                    value="controls"
                    type="submit"
                    disabled
                    id="currentPageButton"
                    >
                        2
                    </button>
                </div>
            </div>
        </div>
        <!-- step counter 2/3 -->

        <!-- section header -->
        <div class="settings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-5">
            <div class="row">
                <div class="col-1">
                    <x-buttonBack :label="'Ολοκλήρωση και επιστροφή στο προηγούμενο μενού'" />
                </div>
                <div class="col-10 text-center" id="currentPageDescription">
                    <h1>Χειρισμός</h1>
                    <p><strong>Επίλεξε τον τρόπο με τον οποίο επιθυμείς να
                        χειρίζεσαι το παιχνίδι.
                    </strong>
                </div>
                <div class="col-1"></div>
           </div>
        </div>
        <!-- / section header -->

        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="settingsGroup" class="row">
                <fieldset class="col-lg-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend>Στυλ πλοήγησης</legend>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-check">
                                <input class="form-check-input" type="radio" name="navigationType" value="0" id="navigationType1" checked>
                                <label class="form-check-label" for="navigationType1">Αυτόματο</label>
                            </div>
                            <div class="col-6 form-check">
                                <input class="form-check-input" type="radio" name="navigationType" value="1" id="navigationType2">
                                <label class="form-check-label" for="navigationType2">Χειροκίνητο</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend>Βοήθεια μετά από λάθος</legend>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="1" id="helpAfterTries1">
                                <label class="form-check-label" for="helpAfterTries1">1 προσπάθεια</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="2" id="helpAfterTries2">
                                <label class="form-check-label" for="helpAfterTries2">2 προσπάθειες</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="3" id="helpAfterTries3" checked>
                                <label class="form-check-label" for="helpAfterTries3">3 προσπάθειες</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend>Ταχύτητα σάρωσης</legend>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                8s
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button class="btn btn-primary btn-lg responsive-expand" type="submit" id="submitButton">αποθήκευση επιλογών</button>
            </div>

        </div>

    </form>
    <!-- / new player step 2/3 content -->

</x-layout>
