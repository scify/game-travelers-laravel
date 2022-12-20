<x-layout :title="'Ρυθμίσεις πλοήγησης | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
    {{-- Note: This is the exact same page as the one for New Players BUT with
        a modified header. According to the design these pages should be
        different, yet they have the exact same form, fields and purpose. Their
        only difference is on the layout. In order to considerably boost
        development output and to give ourselves some time to debate if it is
        useful or not for users to learn how to use two different pages instead
        of one, this acts as a temporary page / placeholder that should be
        very easy to implement on the back-end as it has the exact same
        elements as the settingsControlsNew.blade.php view.
        --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <form
        method="get" {{-- should be post, get is for testing --}}
        action="{{ url('/settings') }}" {{-- should go back to main Settings --}}
        id="settingsControls" {{-- unused id --}}
    >
        @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-3 mt-3 pt-3 pb-3"> {{-- New/Existing diff: mb-2 mb-lg-3 mt-3 pt-3 pb-3 --}}
            <div class="row">
                <div class="col-1">
                    <x-buttonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :align="'left'"
                    :url="url('/settings')"
                />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Ρυθμίσεις πλοήγησης</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Επίλεξε τον τρόπο με τον οποίο ο παίκτης <em>Μανώλης</em> θα πλοηγείται στο παιχνίδι. {{-- Player Name goes here. --}}
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- Reserved for navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        {{-- Note: EXACTLY THE SAME AS settingsControlsNew.blade.php <!-- settings controls --> --}}
        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="settingsGroup" class="row">
                <fieldset class="col-lg-8 field-group indicate-status">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ο τρόπος που «κινείται» ο παίκτης στο παιχνίδι">
                                        Τρόπος πλοήγησης
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsControlType"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-lg-6 form-check">
                                <input
                                    class="form-check-input field-input"
                                    type="radio"
                                    name="controlType"
                                    value="1"
                                    data-role="groupSetter" {{-- Used by JS --}}
                                    data-enables="controlType1Group" {{-- Read by JS = #id of options group--}}
                                    data-disables="controlType2Group" {{-- Read by JS = #id of options group --}}
                                    tabindex="10"
                                    id="controlType1"
                                    checked
                                />
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
                                                data-role="keyAssigner" {{-- Used by JS --}}
                                                data-key-default="Space" {{-- Read by JS --}}
                                                data-key-selected="Space" {{-- Updates via JS --}}
                                                data-sets-input="controlAutomaticSelectionButton"
                                                aria-label = "Ορισμός πλήκτρου επιλογής"
                                                aria-description = "Αμέσως μόλις πιέσετε αυτό το πλήκτρο, πιέστε το πλήκτρο στο πληκτρολόγιο με το οποίο επιθυυμείτε να γίνεται η επιλογή στο παιχνίδι"
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
                                <input
                                    class="form-check-input field-input"
                                    type="radio"
                                    name="controlType"
                                    value="2"
                                    data-role="groupSetter" {{-- Used by JS --}}
                                    data-enables="controlType2Group" {{-- Read by JS = #id of options group--}}
                                    data-disables="controlType1Group" {{-- Read by JS = #id of options group--}}
                                    tabindex="20"
                                    id="controlType2"
                                />
                                <label class="form-check-label field-label medium" for="controlType2">Χειροκίνητος</label>
                                <div class="field-subgroup container-fluid gx-0 gy-5 pt-3" id="controlType2Group">
                                    <div class="row">
                                        <div class="col">
                                            επιλογή
                                        </div>
                                        <div class="col pb-1">
                                            <!-- @TODO: Accessibility -->
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-light rounded-pill key-assigner"
                                                data-role="keyAssigner" {{-- Used by JS --}}
                                                data-key-default="Space" {{-- Read by JS --}}
                                                data-key-selected="Space" {{-- Updates via JS --}}
                                                data-sets-input="controlManualSelectionButton"
                                                aria-label = "Ορισμός πλήκτρου επιλογής"
                                                aria-description = "Αμέσως μόλις πιέσετε αυτό το πλήκτρο, πιέστε το πλήκτρο στο πληκτρολόγιο με το οποίο επιθυυμείτε να γίνεται η επιλογή στο παιχνίδι"
                                                tabindex="21"
                                                disabled
                                            >
                                                όρισε πλήκτρο
                                            </button>
                                            <input id="controlManualSelectionButton" data-role="keyAssignerInput" type="hidden" name="controlManualSelectionButton" value="Space" />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            πλοήγηση
                                        </div>
                                        <div class="col pb-1">
                                            <!-- @TODO: Accessibility -->
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-light rounded-pill key-assigner"
                                                data-role="keyAssigner" {{-- Used by JS --}}
                                                data-key-default="Enter" {{-- Read by JS --}}
                                                data-key-selected="Enter" {{-- Updates via JS --}}
                                                data-sets-input="controlManualNavigationButton"
                                                aria-label = "Ορισμός πλήκτρου πλοήγησης"
                                                aria-description = "Αμέσως μόλις πιέσετε αυτό το πλήκτρο, πιέστε το πλήκτρο στο πληκτρολόγιο με το οποίο επιθυυμείτε να γίνεται η πλοήγηση στο παιχνίδι"
                                                tabindex="22"
                                                disabled
                                            >
                                                όρισε πλήκτρο
                                            </button>
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
                                <legend class="field-legend fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Αφού κάνει λάθος ο παίκτης, ο υπολογιστής του δίνει βοήθεια...">
                                        Βοήθεια μετά από λάθος
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsHelpAfter"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="1" tabindex="30" id="helpAfterTries1" />
                                <label class="form-check-label" for="helpAfterTries1">Μετά από 1 λάθος</label>
                            </div>
                            <div class="col-12 form-check mt-1">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="2" tabindex="40" id="helpAfterTries2" />
                                <label class="form-check-label" for="helpAfterTries2">Μετά από 2 λάθη</label>
                            </div>
                            <div class="col-12 form-check mt-1">
                                <input class="form-check-input" type="radio" name="helpAfterTries" value="3" tabindex="50" id="helpAfterTries3" checked />
                                <label class="form-check-label" for="helpAfterTries3">Μετά από 3 λάθη</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-12 mt-5 mt-sm-4 mt-lg-3 mb-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Πόσο γρήγορα γίνεται η αυτόματη σάρωση">Ταχύτητα σάρωσης</span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsScanningSpeed"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col col-md-6">
                                <label class="form-label" for="scanningSpeed"><span>2</span> δευτερόλεπτα</label>
                                <input
                                    class="form-range"
                                    type="range"
                                    name="scanningSpeed"
                                    value="2"
                                    min="1"
                                    max="8"
                                    step="1"
                                    tabindex="60"
                                    id="scanningSpeed"
                                />
                                <!-- decorative ruler hidden for aria-->
                                <div class="d-flex flex-nowrap justify-content-between form-range-ruler user-select-none" aria-hidden="true">
                                    <div class="ruler" data-role="ruler" data-value="1">1</div>
                                    <div class="ruler" data-role="ruler" data-value="2">2</div>
                                    <div class="ruler" data-role="ruler" data-value="3">3</div>
                                    <div class="ruler" data-role="ruler" data-value="4">4</div>
                                    <div class="ruler" data-role="ruler" data-value="5">5</div>
                                    <div class="ruler" data-role="ruler" data-value="6">6</div>
                                    <div class="ruler" data-role="ruler" data-value="7">7</div>
                                    <div class="ruler" data-role="ruler" data-value="8">8</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div id="navGroup" class="form-actions d-flex align-items-end flex-column pb-0 pb-lg-3">
                <button
                    class="btn btn-primary btn-lg responsive-expand"
                    id="submitButton"
                    tabindex="200"
                    type="submit"
                    name="submit"
                    value="save"
                >
                    αποθήκευση ρυθμίσεων
                </button>
            </div>

        </div>
        {{-- / Note: EXACTLY THE SAME AS settingsControlsNew.blade.php <!-- settings controls --> --}}

    </form>

    {{-- Note: EXACTLY THE SAME AS settingsControlsNew.blade.php <!-- settings controls --> --}}
    <!-- help modals -->
    @include('help.helpSettingsControls')
    <!-- / help modals -->
    {{-- / Note: EXACTLY THE SAME AS settingsControlsNew.blade.php <!-- settings controls --> --}}

</x-layout>
