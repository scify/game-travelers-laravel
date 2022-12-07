<x-layout :title="'Προφίλ | Νέος παίκτης - Βήμα 1ο | Ταξιδιώτες'">
    {{-- Inline error on field name PLUS an explanatory message just beneath
        the field name which appears in bold red.
        Avatar selection (required) is done via JavaScript with buttons which
        act as radios. Avatar ID is passed to the #playerAvatarId hidden input
        element (name="avatar", value="{integer}"). Note that submit is also
        possible in theory via the Stepper's buttons, even though the one on
        this page (#currentPageButton) is set to "disabled" (submits name=page,
        value="profile"). --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    <!-- new player step 1/3 content -->
    <form method="post" action="" id="profileNewStep1">
        @csrf

        <!-- step counter 1/3 -->
        <div class="stepper container-xxl">
            <div class="step1 row">
                <div class="step1-1 col-1"></div>
                <div class="step1-2 col-11">
                    <button
                        class="btn btn-round current"
                        title="Προφίλ παίκτη"
                        aria-label="Προφίλ παίκτη"
                        aria-describedby="currentPageDescription"
                        aria-current="page"
                        aria-readonly="true"
                        tabindex="-1"
                        name="page"
                        value="profile"
                        type="submit"
                        disabled
                        id="currentPageButton"
                    >
                        1
                    </button>
                </div>
            </div>
        </div>
        <!-- / step counter 1/3 -->

        <!-- section header -->
        <div class="settings-header container-xxl px-4 px-sm-4 mb-2 mb-lg-5">
            <div class="row">
                <div class="col-1">
                    <x-buttonBack :label="'Ακύρωση και επιστροφή στο προηγούμενο μενού'" />
                </div>
                <div class="col-10 text-center" id="currentPageDescription">
                    <h1>Νέος παίκτης</h1>
                    <p><strong>Διάλεξε ένα όνομα και μια φατσούλα για να
                        δημιουργήσεις το προφίλ σου.
                    </strong>
                </div>
                <div class="col-1"></div>
           </div>
        </div>
        <!-- / section header -->

        <div class="section settings container-xxl px-4 px-sm-5 px-xl-6">
            <div id="nameGroup" class="field @error('name') is-invalid @enderror settings-row row mb-5">
                <div class="col-md-3">
                    <label class="field-label extended big" for="playerName">
                        Όνομα παίκτη
                    </label>
                </div>
                <div class="col-md-9">
                    <input
                        class="field-input extended underlined big"
                        type="text"
                        name="name"
                        minlength="2"
                        maxlength="50"
                        required="true"
                        autocomplete="given-name"
                        autocapitalize="on"
                        spellcheck="false"
                        tabindex="1"
                        id="playerName"
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
                    <!-- avatar container -->
                    <div class="avatars container-lg text-center">
                        <div class="row avatars-row">
                            <x-profileNewAvatar :avatar=$avatarData[0] />
                            <x-profileNewAvatar :avatar=$avatarData[1] />
                            <x-profileNewAvatar :avatar=$avatarData[2] />
                            <x-profileNewAvatar :avatar=$avatarData[3] />
                            <x-profileNewAvatar :avatar=$avatarData[4] />
                            <x-profileNewAvatar :avatar=$avatarData[5] />
                            {{-- default value = "0"  (no avatar selected --}}
                            <input type="hidden" name="avatar" value="0" id="playerAvatarId" />
                        </div>
                    </div>
                </div>

            </div>

            {{-- Γιατί δημιουργία προφίλ; Θεωρώ ότι σε αυτό το πρώτο βήμα
                το οποίο είναι και το μόνο στο οποίο ο χρήστης καλείται
                υποχρεωτικά να κάνει επιλογές, πρέπει να δημιουργείται το
                προφίλ του. Τα επόμενα 2 βήματα που αφορούν στις ρυθμίσεις
                χειρισμού και δυσκολίας θα πρέπει να προτείνουν τις default
                παραμέτρους τις οποίες θα μπορεί φυσικά αν θέλει να αλλάξει
                ο χρήστης. Με αυτόν τον τρόπο διευκολύνουμε τον χρήστη στο
                on-boarding και του επιτρέπουμε να κατανοήσει τις δυνατότητες
                που αυτό το παιχνίδι παρέχει. Ωστόσο, εδώ, σε αυτό το πρώτο
                βήμα δημιουργείται το προφίλ και αποθηκεύεται στη βάση με τις
                default ρυθμίσεις του. Έτσι γίνεται πολύ πιο εύκολος και ο
                έλεχος στο back-end χωρίς πολύπλοκους ελέγχους. Ναι, μπορεί
                να ξαναγυρίσει σε αυτό το βήμα ο χρήστης, αλλά τότε θα πρέπει
                να βρει αυτή εδώ τη φόρμα συμπληρωμένη.
            --}}
            <div id="navGroup" class="form-actions d-flex align-items-end flex-column">
                <button class="btn btn-primary btn-lg responsive-expand" type="submit" id="submitButton" tabindex="120" disabled>δημιουργία προφίλ</button>
            </div>

        </div>

    </form>
    <!-- / new player step 1/3 content -->

</x-layout>
