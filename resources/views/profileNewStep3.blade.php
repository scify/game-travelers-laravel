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
                        aria-label="Αποθήκευση και επιστροφή στο προφίλ παίκτη"
                        name="page"
                        value="profile"
                        type="submit"
                    >
                        1
                    </button>
                </div>
                <div class="step3-3 col-5">
                    <button
                        class="btn btn-round past"
                        title="Ρυθμίσεις χειρισμού"
                        aria-label="Αποθήκευση και επιστροφή στις ρυθμίσεις χειρισμού"
                        name="page"
                        value="controls"
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
                    <x-buttonBack :label="'Επιστροφή στο προηγούμενο μενού'" />
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

            <div id="settingsGroup" class="row">
                <fieldset class="col-lg-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend>Ζάρι</legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col">
                                <div class="container=fluid">
                                    <div class="row">
                                        <div class="col form-check">
                                            <input class="form-check-input" type="radio" name="dice" value="10" tabindex="1" id="dice1" required checked>
                                            <label class="form-check-label" for="dice1">Νούμερα</label>
                                        </div>
                                        <div class="col form-check">
                                            <input class="form-check-input" type="radio" name="dice" value="20" tabindex="2" id="dice2">
                                            <label class="form-check-label" for="dice2">Κουκίδες</label>
                                        </div>
                                        <div class="col form-check">
                                            <input class="form-check-input" type="radio" name="dice" value="30" tabindex="3" id="dice3">
                                            <label class="form-check-label" for="dice3">Χρώμα</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Διάρκεια παιχνιδιού
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="40" tabindex="4" id="gameDuration1" required />
                                <label class="form-check-label" for="gameDuration1">Σύντομη (15 θέσεις)</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="50" tabindex="5" id="gameDuration2" checked />
                                <label class="form-check-label" for="gameDuration2">Κανονική (30 θέσεις)</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="60" tabindex="6" id="gameDuration3" />
                                <label class="form-check-label" for="gameDuration3">Μεγάλη (45 θέσεις)</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Επίπεδο
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="level" value="1" tabindex="70" id="level1" required checked />
                                <label class="form-check-label" for="level1">Κανονικό</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="level" value="2" tabindex="80" id="level2" />
                                <label class="form-check-label" for="level2">Δύσκολο</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Μετακίνηση
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="1" tabindex="90" id="movement1" required  />
                                <label class="form-check-label" for="movement1">Αυτόματη</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="2" tabindex="100" id="movement2" checked />
                                <label class="form-check-label" for="movement2">Με υπόδειξη</label>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="3" tabindex="110" id="movement3" />
                                <label class="form-check-label" for="movement3">Χωρίς υπόδειξη</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button
                    class="btn btn-primary btn-lg responsive-expand"
                    id="submitButton"
                    tabindex="120"
                    type="submit"
                    name="submit"
                    value="save"
                >
                    ολοκλήρωση ρυθμίσεων
                </button>
            </div>

        </div>

    </form>
    <!-- / new player step 3/3 content -->

</x-layout>
