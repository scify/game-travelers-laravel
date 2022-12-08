<x-layout :title="'Χειρισμός | Νέος παίκτης - Βήμα 2ο | Ταξιδιώτες'">
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
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
                    <x-buttonBack :label="'Επιστροφή στο προηγούμενο μενού'" />
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
                <fieldset class="col-lg-8 field-group indicate-status">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Τρόπος χειρισμού
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-lg-6 form-check">
                                <input class="form-check-input field-input" type="radio" name="controlType" value="1" data-role="groupSetter" data-enables="controlType1Group" data-disables="controlType2Group" tabindex="10" id="controlType1" checked />
                                <label class="form-check-label field-label medium" for="controlType1">Αυτόματος</label>
                                <div class="field-subgroup container-fluid gx-0 gy-5 pt-3" id="controlType1Group">
                                    <div class="row">
                                        <div class="col">
                                            επιλογή
                                        </div>
                                        <div class="col">
                                            <!-- @TODO: Accessibility -->
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-light rounded-pill key-assigner"
                                                data-role="keyAssigner"
                                                data-key-default="Space"
                                                data-key-selected="Space"
                                                data-sets-input="controlAutomaticSelectionButton"
                                                tabindex="11"
                                            >
                                                Space
                                            </button>
                                            <input
                                                id="controlAutomaticSelectionButton"
                                                data-role="keyAssignerInput"
                                                type="hidden"
                                                name="controlAutomaticSelectionButton"
                                                value="Space"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4 mt-lg-0 form-check">
                                <input class="form-check-input field-input" type="radio" name="controlType" value="2" data-role="groupSetter" data-enables="controlType2Group" data-disables="controlType1Group" tabindex="20" id="controlType2" />
                                <label class="form-check-label field-label medium" for="controlType2">Χειροκίνητος</label>
                                <div class="field-subgroup container-fluid gx-0 gy-5 pt-3" id="controlType2Group">
                                    <div class="row">
                                        <div class="col">
                                            επιλογή
                                        </div>
                                        <div class="col pb-1">
                                            <!-- @TODO: Accessibility -->
                                            <button type="button" class="btn btn-sm btn-light rounded-pill key-assigner" data-role="keyAssigner" data-key-default="Space" data-key-selected="Space" data-sets-input="controlManualSelectionButton" tabindex="21" disabled>όρισε πλήκτρο</button>
                                            <input id="controlManualSelectionButton" data-role="keyAssignerInput" type="hidden" name="controlManualSelectionButton" value="Space" />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            πλοήγηση
                                        </div>
                                        <div class="col pb-1">
                                            <!-- @TODO: Accessibility -->
                                            <button type="button" class="btn btn-sm btn-light rounded-pill key-assigner" data-role="keyAssigner" data-key-default="Enter" data-key-selected="Enter" data-sets-input="controlManualNavigationButton" tabindex="22" disabled>όρισε πλήκτρο</button>
                                            <input id="controlManualNavigationButton" data-role="keyAssignerInput" type="hidden" name="controlManualNavigationButton" value="Enter" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4 mt-4 mt-lg-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Βοήθεια μετά από λάθος
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="1" tabindex="30" id="helpAfterTries1" />
                                <label class="form-check-label" for="helpAfterTries1">1 προσπάθεια</label>
                            </div>
                            <div class="col-12 form-check mt-1">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="2" tabindex="40" id="helpAfterTries2" />
                                <label class="form-check-label" for="helpAfterTries2">2 προσπάθειες</label>
                            </div>
                            <div class="col-12 form-check mt-1">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="3" tabindex="50" id="helpAfterTries3" checked />
                                <label class="form-check-label" for="helpAfterTries3">3 προσπάθειες</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-12 mt-4 mt-lg-2 mb-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    Ταχύτητα σάρωσης
                                </legend>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col col-md-6">
                                <label class="form-label" for="scanningSpeed"><span>2</span> δευτερόλεπτα</label>
                                <input class="form-range" type="range" name="scanningSpeed" value="2" min="1" max="8" step="1" tabindex="60" id="scanningSpeed" />
                                <!-- decorative ruler -->
                                <div class="d-flex flex-nowrap justify-content-between form-range-ruler user-select-none" aria-hidden="true">
                                    <div class="ruler">1</div>
                                    <div class="ruler">2</div>
                                    <div class="ruler">3</div>
                                    <div class="ruler">4</div>
                                    <div class="ruler">5</div>
                                    <div class="ruler">6</div>
                                    <div class="ruler">7</div>
                                    <div class="ruler">8</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

<style type="text/css">

</style>

            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button class="btn btn-primary btn-lg responsive-expand" type="submit" id="submitButton" tabindex="200">αποθήκευση επιλογών</button>
            </div>

        </div>

    </form>
    <!-- / new player step 2/3 content -->

</x-layout>
