<x-layout :title="'Προφίλ παίκτη | Ταξιδιώτες'" :hasUserMenu=true :background="'background-dash-up'">
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
        method="get" {{-- should be post, get is for testing --}}
        action="{{ url('/settings') }}" {{-- should go to same page (/settings/{playerid}/profile) --}}
        id="settingsProfile" {{-- unused id --}}
    >
    @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mb-2 mb-lg-5 mt-1 pb-2 pt-5"> {{-- New/Existing diff: mb-2 mb-lg-3 mt-3 pt-3 pb-3 --}}
            <div class="row">
                <div class="col-1">
                    <x-buttonBack
                    :label="'Επιστροφή στις ρυθμίσεις'"
                    :align="'left'"
                    :url="url('/settings')"
                />
                </div>
                <div class="col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Διαμόρφωση προφίλ</h1>
                    <p>
                        <strong id="currentPageDescription">
                            Διάλεξε ένα όνομα και μία φατσούλα για το προφίλ του παίκτη <em>Μανώλης</em>. {{-- Player Name goes here. --}}
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
                        value="Μανώλης" {{-- Read by JS --}}
                        minlength="2" {{-- JS form validation --}}
                        maxlength="50"
                        required="true"
                        autocomplete="given-name"
                        autocapitalize="on"
                        spellcheck="false"
                        tabindex="1"
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
                        :selectedAvatarId=1 {{-- player['avatarid'] --}}
                        :tabindex=2
                    />
                </div>

            </div>

            {{-- Γιατί "δημιουργία προφίλ"; Θεωρώ ότι σε αυτό το πρώτο βήμα το
                οποίο είναι και το μόνο στο οποίο ο χρήστης καλείται υποχρεωτικά
                να κάνει επιλογές, πρέπει να δημιουργείται το προφίλ του. Τα
                επόμενα 2 βήματα που αφορούν στις ρυθμίσεις χειρισμού και
                δυσκολίας θα πρέπει να προτείνουν τις default παραμέτρους τις
                οποίες θα μπορεί φυσικά αν θέλει να αλλάξει ο χρήστης. Με αυτόν
                τον τρόπο διευκολύνουμε τον χρήστη στο on-boarding και του
                επιτρέπουμε να κατανοήσει τις δυνατότητες που αυτό το παιχνίδι
                παρέχει. Ωστόσο, εδώ, σε αυτό το πρώτο βήμα δημιουργείται το
                προφίλ και αποθηκεύεται στη βάση με τις default ρυθμίσεις του.
                Έτσι γίνεται πολύ πιο εύκολος και ο έλεχος στο back-end χωρίς
                πολυπλοκότητες. Ναι, μπορεί να ξαναγυρίσει σε αυτό το βήμα ο
                χρήστης, αλλά τότε θα πρέπει ίσως να βρει αυτή εδώ τη φόρμα
                συμπληρωμένη.
            --}}
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
        {{-- / Note: EXACTLY THE SAME AS settingsProfileNew.blade.php <!-- settings profile --> --}}

    </form>

</x-layout>
