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
                <form method="post" action="">
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
                                υποδείξεις.
                            </div>
                            <!-- errors -->
                            @endif

                        </div>

                        <!-- passwords -->
                        <div class="
                            field-group px-4 py-2 container-fluid
                            @error('password1') is-invalid @enderror
                            @error('password2') is-invalid @enderror
                        ">
                            <div class="row">
                                <div class="field col-lg-6">
                                    <label class="field-label extended" for="password1">Νέο συνθηματικό</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password1"
                                        required="required"
                                        aria-label="Επιθυμητός κωδικός πρόσβασης"
                                        aria-describedby="password-description"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        tabindex="1"
                                        id="password1"
                                    />
                                </div>
                                <div class="field col-lg-6 pt-4 pt-lg-0 ">
                                    <label class="field-label extended text-nowrap text-truncate" for="password2">Επαλήθευση νέου συνθηματικού</label>
                                    <input
                                        class="field-input underlined extended"
                                        type="password"
                                        name="password2"
                                        required="required"
                                        aria-label="Επαλήθευση επιθυμητού κωδικού πρόσβασης"
                                        aria-describedby="password-description"
                                        autocomplete="new-password"
                                        autocapitalize="off"
                                        spellcheck="false"
                                        tabindex="2"
                                        id="password2"
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
