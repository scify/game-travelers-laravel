<x-layout :title="'Ρυθμίσεις δυσκολίας | Ταξιδιώτες'" :has-user-menu=true :header-background="'background-dash-up'">
    {{-- Note: This is the exact same page as the one for New Players BUT with
        a modified header. According to the design these pages should be
        different, yet they have the exact same form, fields and purpose. Their
        only difference is on the layout. In order to considerably boost
        development output and to give ourselves some time to debate if it is
        useful or not for users to learn how to use two different pages instead
        of one, this acts as a temporary page / placeholder that should be
        very easy to implement on the back-end as it has the exact same
        elements as the settingsDifficultyNew.blade.php view.
        --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <form
        method="post" {{-- should be post, get is for testing --}}
        action="{{ route('settings.difficulty', [ request()->player_id, request()->from, request()->game_id ]) }}"
        id="settingsDifficulty"
    >
        @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-3 mt-3 pt-3 pb-3"> {{-- New/Existing diff: mb-2 mb-lg-3 mt-3 pt-3 pb-3 --}}
            <div class="row">
                <div class="col-1">
                    <x-linkButtonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :align="'left'"
                    :url="route('settings', [ request()->player_id, request()->from, request()->game_id ] )"
                />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Ρυθμίσεις δυσκολίας</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Επίλεξε βαθμό δυσκολίας για τον παίκτη <em> {{ $name }}</em>.
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- Reserved for navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        {{-- Note: EXACTLY THE SAME AS settingsDifficultyNew.blade.php <!-- settings difficulty --> --}}
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
                                                >
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
                                                >
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
                                                >
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
                    αποθήκευση ρυθμίσεων
                </button>
            </div>

        </div>
        {{-- / Note: EXACTLY THE SAME AS settingsDifficultyNew.blade.php <!-- settings difficulty --> --}}

    </form>

    {{-- Note: EXACTLY THE SAME AS settingsDifficultyNew.blade.php <!-- settings difficulty --> --}}
    <!-- help modals -->
    @include('help.helpSettingsDifficulty')
    <!-- / help modals -->
    {{-- / Note: EXACTLY THE SAME AS settingsDifficultyNew.blade.php <!-- settings difficulty --> --}}

</x-layout>
