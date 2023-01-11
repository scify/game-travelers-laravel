<x-layout :title="'Δυσκολία | Νέος παίκτης - Βήμα 3ο | Ταξιδιώτες'">
    {{-- Note: Dices are clickable of course. In other news, values on inputs
         for dices, duration, diff. level and movement are indicative and not
         crucial. In contrast, ids are crucual for both accessibility and JS,
         so they shouldn't be altered for the time being. Dices images are
         linked with a data-role and a data-for attribute with the #ID of the
         related checkbox. No other automations or validation on this page.
         @see resources/js/settings/dice-selection.js
    --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <!-- new player step 3/3 content -->
    <form
        method="post" {{-- should be post, get is for testing --}}
        action="{{ route('difficulty.player', [ request()->player_id, request()->from, request()->game_id ]) }}"
        id="settingsDifficultyNew" {{-- unused id --}}
    >
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
                        name="submit"
                        value="profile"
                        type="submit"
                    >
                        1
                    </button>
                </div>
                <div class="step3-3 col-5">
                    <button
                        class="btn btn-round past"
                        title="Ρυθμίσεις πλοήγησης"
                        aria-label="Αποθήκευση και επιστροφή στις ρυθμίσεις πλοήγησης"
                        name="submit"
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
                    name="submit"
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
        <div class="settings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    <x-buttonBack
                        :label="'Επιστροφή στις ρυθμίσεις πλοήγησης'"
                        :align="'left'"
                    />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Δυσκολία</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Επίλεξε πόσο εύκολο ή δύσκολο θέλεις να είναι το παιχνίδι.
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- Reserved for sub-header controls. --}}
                </div>
           </div>
        </div>
        <!-- / section header -->

        <!-- settings difficulty -->
        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="settingsGroup" class="row">
                <fieldset class="col-lg-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-lenged fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Το ζάρι καθορίζει τον τρόπο μετακίνησης στις θέσεις του παιχνιδιού">
                                        Ζάρι
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsDice"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="container-fluid">
                                    <div class="row dices">
                                        <div class="col form-check dice-field">
                                            <div class="dice-field--img">
                                                <img
                                                    srcset="{{ asset('images/dices/dice-numbers@2x.png') }} 2x"
                                                    src="{{ asset('images/dices/dice-numbers.png') }}"
                                                    width="88" height="96"
                                                    data-role="dice" {{-- Read by JS --}}
                                                    data-for="dice1" {{-- Read by JS (input id of the dice) --}}
                                                    alt="Ζάρι με αριθμούς"
                                                />
                                            </div>
                                            <div class="dice-field--check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="dice"
                                                    value="1"
                                                    tabindex="1"
                                                    id="dice1" {{-- Read by JS --}}
                                                    required
                                                    @if($dice_type == 1) checked autofocus @endif
                                                />
                                            <label class="form-check-label" for="dice1">Νούμερα</label>
                                            </div>
                                        </div>
                                        <div class="col form-check dice-field">
                                            <div class="dice-field--img">
                                                <img
                                                    srcset="{{ asset('images/dices/dice-dots@2x.png') }} 2x"
                                                    src="{{ asset('images/dices/dice-dots.png') }}"
                                                    width="88" height="96"
                                                    data-role="dice" {{-- Read by JS --}}
                                                    data-for="dice2" {{-- Read by JS (input id of the dice) --}}
                                                    alt="Ζάρι με κουκίδες"
                                                />
                                            </div>
                                            <div class="dice-field--check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="dice"
                                                    value="2"
                                                    tabindex="2"
                                                    id="dice2" {{-- Read by JS --}}
                                                    @if($dice_type == 2) checked autofocus @endif
                                                >
                                                <label class="form-check-label" for="dice2">Κουκίδες</label>
                                            </div>
                                        </div>
                                        <div class="col form-check dice-field">
                                            <div class="dice-field--img">
                                                <img
                                                    srcset="{{ asset('images/dices/dice-colours@2x.png') }} 2x"
                                                    src="{{ asset('images/dices/dice-colours.png') }}"
                                                    width="88" height="96"
                                                    data-role="dice" {{-- Read by JS --}}
                                                    data-for="dice3" {{-- Read by JS (input id of the dice) --}}
                                                    alt="Ζάρι με χρώματα"
                                                />
                                            </div>
                                            <div class="dice-field--check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="dice"
                                                    value="3"
                                                    tabindex="3"
                                                    id="dice3" {{-- Read by JS --}}
                                                    @if($dice_type == 3) checked autofocus @endif
                                                >
                                                <label class="form-check-label" for="dice3">Χρώματα</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4 mt-5 mt-lg-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Η διάρκεια του παιχνιδιού εξαρτάται από τον αριθμό των θέσεων στην πίστα">
                                        Διάρκεια παιχνιδιού
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsDuration"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-3">
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="1" tabindex="4" id="gameDuration1" required @if($board_size == 1) checked @endif />
                                <label class="form-check-label" for="gameDuration1">Σύντομη (15 θέσεις)</label>
                            </div>
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="2" tabindex="5" id="gameDuration2" @if($board_size == 2) checked @endif />
                                <label class="form-check-label" for="gameDuration2">Κανονική (30 θέσεις)</label>
                            </div>
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="gameDuration" value="3" tabindex="6" id="gameDuration3" @if($board_size == 3) checked @endif />
                                <label class="form-check-label" for="gameDuration3">Μεγάλη (45 θέσεις)</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-md-4 mt-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold text-nowrap">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title=" Το επίπεδο δυσκολίας για τον παίκτη">
                                        Επίπεδο δυσκολίας
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsDifficultyLevel"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-3">
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="level" value="1" tabindex="70" id="level1" required @if($difficulty == 1) checked @endif />
                                <label class="form-check-label" for="level1">Κανονικό</label>
                            </div>
                            <div class="col-12 mt-1 form-check mt-1">
                                <input class="form-check-input" type="radio" name="level" value="2" tabindex="80" id="level2" @if($difficulty == 2) checked @endif />
                                <label class="form-check-label" for="level2">Δύσκολο</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-md-4 mt-5 mb-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <legend class="field-legend fw-bold">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ο τρόπος που «κινείται» ο παίκτης στο παιχνίδι">
                                        Μετακίνηση
                                    </span>
                                    <button
                                        class="btn-help"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSettingsMovement"
                                        aria-label="Πληροφορίες"
                                        tabindex="-1"
                                    ></button>
                                </legend>
                            </div>
                        </div>
                        <div class="row ms-1 mt-2">
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="1" tabindex="90" id="movement1" required @if($movement_mode == 1) checked @endif />
                                <label class="form-check-label" for="movement1">Αυτόματη</label>
                            </div>
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="2" tabindex="100" id="movement2" @if($movement_mode == 2) checked @endif />
                                <label class="form-check-label" for="movement2">Με υπόδειξη</label>
                            </div>
                            <div class="col-12 mt-1 form-check">
                                <input class="form-check-input" type="radio" name="movement" value="3" tabindex="110" id="movement3" @if($movement_mode == 3) checked @endif />
                                <label class="form-check-label" for="movement3">Χωρίς υπόδειξη</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div id="navGroup" class="form-actions d-flex align-items-end mt-4 mt-sm-0 flex-column">
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
        <!-- / settings difficulty -->

    </form>
    <!-- / new player step 3/3 content -->

    <!-- help modals -->
    @include('help.helpSettingsDifficulty')
    <!-- / help modals -->

</x-layout>
