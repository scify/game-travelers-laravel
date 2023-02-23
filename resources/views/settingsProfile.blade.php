<x-layout
    :title="'Προφίλ παίκτη | Ταξιδιώτες'"
    :has-user-menu=true
    :header-background="'background-dash-up'"
>
    {{-- Note: This is the exact same page as the one for New Players BUT with
        a modified header. According to the design these pages should be
        different, yet they have the exact same form, fields and purpose. Their
        only difference is on the layout. In order to considerably boost
        development output and to give ourselves some time to debate if it is
        useful or not for users to learn how to use two different pages instead
        of one, this acts as a temporary page / placeholder that should be
        very easy to implement on the back-end as it has the exact same
        elements as the settingsProfileNew.blade.php view.
        --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <form
        method="post"
        action="{{ route('settings.profile', [ request()->player_id, request()->from, request()->game_id ] ) }}"
        id="settingsProfile"
    >
    @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-5 mt-1 pb-2 pt-5"> {{-- New/Existing diff: mb-2 mb-lg-3 mt-3 pt-3 pb-3 --}}
            <div class="row">
                <div class="col-1">
                    <x-linkButtonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :url="route('settings', [ request()->player_id, request()->from, request()->game_id ] )"
                    :align="'left'"
                />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Διαμόρφωση προφίλ</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Διάλεξε ένα όνομα και μία φατσούλα για το προφίλ του παίκτη <em>{{ $name }}</em>. {{-- Player Name goes here. --}}
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- Reserved for navigation buttons. --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        {{-- Note: EXACTLY THE SAME AS settingsProfileNew.blade.php <!-- settings profile --> --}}
        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="nameGroup" class="field @error('name') is-invalid @enderror settings-row row mb-5">
                <div class="col-md-3">
                    <label class="field-label extended big" for="playerName">
                        Όνομα παίκτη
                    </label>
                </div>
                <div class="col-md-9">
                    {{-- default value = "" (no name) --}}
                    <input
                        class="field-input extended underlined big"
                        type="text"
                        name="name"
                        value="{{ $name }}" {{-- Read by JS --}}
                        minlength="2" {{-- JS form validation --}}
                        maxlength="50"
                        required="true"
                        autocomplete="given-name"
                        autocapitalize="on"
                        spellcheck="false"
                        tabindex="1"
                        autofocus
                        id="playerNameInput" {{-- ID Used by JS --}}
                    />
                    @error('name')
                    <div class="field-description big" id="alert">
                        <strong id="alertMessage">
                            Ουπς! Αυτό το όνομα είναι «πιασμένο». Συνέχισε με το
                            προτεινόμενο ή δοκίμασε κάποιο διαφορετικό.
                        </strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div
                class="field settings-row row mb-2"
                role="radiogroup"
                aria-labelledby="avatarGroupLabel"
                id="avatarGroup"
            >
                <div class="col-md-3">
                    <legend class="field-label extended big" id="avatarGroupLabel">
                        Διάλεξε φατσούλα
                    </legend>
                </div>
                <div class="col-md-9">
                    <x-selectAvatar
                        :avatars=$avatars {{-- @see ../../docs/exampleData.php --}}
                        :selectedAvatarId=$selectedAvatarId {{-- player['avatarid'] --}}
                        :tabindex=2
                    />
                </div>

            </div>
            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button
                    class="btn btn-primary btn-lg responsive-expand"
                    name="submit"
                    value="submit"
                    type="submit"
                    id="submitButton" {{-- ID Used by JS --}}
                    tabindex="120"
                    disabled {{-- Altered via JS (form validation) --}}
                >
                   αποθήκευση
                </button>
            </div>

        </div>
    </form>

</x-layout>
