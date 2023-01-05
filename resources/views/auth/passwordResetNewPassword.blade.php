<x-layout :title="'Αλλαγή συνθηματικού | Ταξιδιώτες'">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header in case of any error and the password fields are also
        highlighted just in case... --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- password reset / change password-content -->
    <div class="section background background-group-1 container-xxl px-4 responsive-hide">
        <div class="row">
            <div class="col-lg-3 order-md-2">
                <!-- no content yet -->
            </div>
            <div class="col-lg-9 order-md-1">
                <!-- form -->
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4 mb-4">
                            <h1>Αλλαγή συνθηματικού</h1>
                            <p class="my-4">
                                Εισάγετε ένα νέο συνθηματικό το οποίο θα
                                μπορείτε να χρησιμοποιείτε από εδώ και στο εξής
                                για τη σύνδεσή σας στους Ταξιδιώτες.
                            </p>

                            {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                            @if($errors->any())
                            <!-- errors -->
                            <div class="alert alert-danger" id="form-alert">
                                Για να ολοκληρωθεί επιτυχώς η διαδικασία θα πρέπει
                                να συμπληρώσετε τα πεδία σύμφωνα με τις σχετικές
                                υποδείξεις:
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        @if ($error == "The email has already been taken.")
                                            <li>Υπάρχει ήδη λογαριασμός με αυτό το email.</li>
                                        @elseif($error == "The password must be at least 8 characters.")
                                            <li>Ο κωδικός πρέπει να είναι τουλάχιστον 8 χαρακτήρες.</li>
                                        @elseif($error == "The password must contain at least one letter.")
                                            <li>Ο κωδικός πρέπει να περιέχει τουλάχιστον ένα γράμμα.</li>
                                        @elseif($error == "The password must contain at least one symbol.")
                                            <li>Ο κωδικός πρέπει να περιέχει τουλάχιστον ένα σύμβολο.</li>
                                        @elseif($error == "The password must contain at least one number.")
                                            <li>Ο κωδικός πρέπει να περιέχει τουλάχιστον έναν αριθμό.</li>
                                        @elseif($error == "The password confirmation does not match.")
                                            <li>Οι δυο κωδικοί δεν είναι ίδιοι.</li>
                                        @elseif($error == "This password reset token is invalid.")
                                            <li>Tο token έχει λήξει. <a href="{{ route('password.request') }}">Ζητήστε πάλι αλλαγή κωδικού.</a></li>
                                        @elseif(Str::startsWith($error, "The captcha"))
                                            <li>To άθροισμα είναι λάθος!</li>
                                        @else
                                            <li>{{ $error }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- errors -->
                            @endif

                        </div>

                        <!-- passwords -->
                        <div class="
                            field-group px-4 py-2 container-fluid
                            @error('password') is-invalid @enderror
                            @error('password_confirmation') is-invalid @enderror
                        ">
                            <div class="row">
                                <div class="field col-lg-6">
                                    <label class="field-label extended" for="password">Νέο συνθηματικό</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocorrect="off"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="Επιθυμητός κωδικός πρόσβασης"
                                        aria-describedby="password-description"
                                        tabindex="1"
                                        id="password"
                                    />
                                </div>
                                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                <input type="hidden" name="email" value="{{ request()->request->all()['email'] }}">
                                <div class="field col-lg-6 pt-4 pt-lg-0 ">
                                    <label class="field-label extended text-nowrap text-truncate" for="password_confirmation">Επαλήθευση νέου συνθηματικού</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password_confirmation"
                                        required="required"
                                        minlength="8"
                                        maxlength="255"
                                        passwordrules="minlength: 8; required: lower; required: upper; required: digit;"
                                        autocorrect="off"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        aria-required="true"
                                        aria-label="Επαλήθευση επιθυμητού κωδικού πρόσβασης"
                                        aria-describedby="password-description"
                                        tabindex="2"
                                        id="password_confirmation"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="field-description" id="password-description">
                                    Χρησιμοποιείστε 8 ή περισσότερους χαρακτήρες με έναν συνδυασμό από τουλάχιστον ένα γράμμα και αριθμό.
                                </div>
                            </div>
                        </div>
                        <!-- passwords -->

                        <div class="form-actions p-4 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="3" type="submit">Αλλαγή συνθηματικού</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / password reset / change password-content -->

</x-layout>
