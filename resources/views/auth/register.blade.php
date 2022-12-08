<x-layout :title="'Εγγραφή | Ταξιδιώτες'">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header. Additionally, each field with an error is highlighted.
    --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- register content -->
    <div class="section background background-group-1 container-xxl px-4">
        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <div class="ps-4 ps-md-6 ps-lg-0 pt-4">
                    Είστε ήδη χρήστης;<br />
                    <a href="{{ url('/register') }}" tabindex="6">Σύνδεση</a>
                </div>
            </div>
            <div class="col-lg-9 order-lg-1">
                <!-- form -->
                <form method="post" action="">
                    @csrf
                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4">
                            <h1>Εγγραφή νέου χρήστη</h1>
                        </div>

                        {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                        @if($errors->any())
                        <!-- errors -->
                        <div class="alert alert-danger mx-4" id="form-alert">
                            Για να ολοκληρωθεί επιτυχώς η διαδικασία θα πρέπει
                            να συμπληρώσετε τα επισημασμένα πεδία σύμφωνα με τις
                            σχετικές υποδείξεις.
                        </div>
                        <!-- errors -->
                        @endif

                        <!-- email -->
                        <div class="field p-4 @error('email') is-invalid @enderror">
                            <label class="field-label extended" for="email">Email</label>
                            <input
                                class="field-input underlined extended"
                                type="email"
                                name="email"
                                required="required"
                                aria-required="true"
                                autocomplete="email"
                                autocapitalize="off"
                                spellcheck="false"
                                tabindex="1"
                                id="email"
                            />
                            <div class="field-description"></div>
                        </div>
                        <!-- / email -->
                        <!-- passwords -->
                        <div class="
                            field-group px-4 py-2 container-fluid
                            @error('password') is-invalid @enderror
                            @error('password_confirmation') is-invalid @enderror
                        ">
                            <div class="row">
                                <div class="field col-lg-6">
                                    <label class="field-label extended" for="password">Συνθηματικό</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password"
                                        required="required"
                                        aria-required="true"
                                        aria-label="Επιθυμητός κωδικός πρόσβασης"
                                        aria-describedby="password-description"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        tabindex="2"
                                        id="password"
                                    />
                                </div>
                                <div class="field col-lg-6 pt-4 pt-lg-0 ">
                                    <label class="field-label extended text-nowrap text-truncate" for="password_confirmation">Επαλήθευση συνθηματικού</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password_confirmation"
                                        required="required"
                                        aria-required="true"
                                        aria-label="Επαλήθευση επιθυμητού κωδικού πρόσβασης"
                                        aria-describedby="password-description"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        tabindex="3"
                                        id="password_confirmation"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="field-description" id="password-description">
                                    Χρησιμοποιείστε 8 ή περισσότερους χαρακτήρες με έναν συνδυασμό γραμμάτων, αριθμών και συμβόλων.
                                </div>
                            </div>
                        </div>
                        <!-- passwords -->
                        <!-- captcha -->
                        <div class="
                            field captcha p-4
                            @error('captcha') is-invalid @enderror
                        ">
                            <label class="field-label extended" for="captcha">Επιβεβαίωση ασφαλείας</label>
                            <div class="captcha-prompt" id="captcha-prompt">12 + 10 =</div>
                            <input
                                class="field-input field-captcha underlined"
                                type="text"
                                name="captcha"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                maxlength="4"
                                placeholder="άθροισμα;"
                                required="required"
                                aria-required="true"
                                aria-placeholder="άθροισμα;"
                                aria-labelledby="captcha-prompt"
                                aria-describedby="captcha-description"
                                autocomplete="off"
                                spellcheck="false"
                                tabindex="4"
                                id="captcha"
                            />
                            <div class="field-description" id="captcha-description">
                                Για λόγους ασφαλείας εισάγετε το άθροισμα αυτής
                                της απλής μαθηματικής πράξης.
                            </div>
                        </div>
                        <!-- / captcha -->
                        <div class="form-actions p-4 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="5" type="submit" id="submit">Εγγραφή</button>
                        </div>
                    </div>
                </form>
                <!-- / form -->
            </div>
        </div>
    </div>
    <!-- end of register content -->

</x-layout>
