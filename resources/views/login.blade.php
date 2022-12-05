<x-layout :title="'Σύνδεση | Ταξιδιώτες'">
    {{-- Notes: An off-canvas generic alert (#offcanvasMessage) is displayed
        in case of error. More notes for implementation are provided below. --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- login content -->
    <div class="section background background-group-1 container-xxl px-4">
        <div class="row">
            <div class="col-md-3 order-md-2">
                <div class="ps-4 ps-md-0 pt-4">
                    Νέος χρήστης;<br />
                    <a href="{{ url('/register') }}" tabindex="6">Δημιουργία λογαριασμού</a>
                </div>
            </div>
            <div class="col-md-9 order-md-1">
                <!-- form -->
                <form method="post" action="">
                    @csrf
                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4">
                            <h1>Καλώς ήρθατε!</h1>
                        </div>
                        <div class="field p-4">
                            <label class="field-label extended" for="email">Email</label>
                            <input
                                class="field-input underlined extended"
                                type="email"
                                name="email"
                                required="required"
                                autocomplete="email"
                                autocapitalize="off"
                                spellcheck="false"
                                tabindex="1"
                                id="email" />
                        </div>
                        <div class="field p-4">
                            <label class="field-label extended" for="password">Συνθηματικό</label>
                            <input
                                class="field-input underlined extended"
                                type="password"
                                name="password"
                                required="required"
                                autocomplete="current-password"
                                autocapitalize="off"
                                spellcheck="false"
                                aria-label="Κωδικός πρόσβασης"
                                tabindex="2"
                                id="password"
                            />
                        </div>
                        <div class="form-options px-4 py-2 container-fluid">
                            <div class="row">
                                <div class="field col-sm-6 col-md-12 col-lg-6 text-start text-nowrap">
                                    <label class="field-label form-check-label" for="cookie">Μείνετε συνδεδεμένοι</label>
                                    <input class="field-input form-check-input ms-2" type="checkbox" tabindex="3" name="cookie" id="cookie">
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6 pt-2 pt-sm-0 pt-md-2 pt-lg-0 text-start-end-start-end">
                                    <a href="{{ url('/password/reset') }}" tabindex="5">Ξεχάσατε το συνθηματικό;</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions p-4 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="4" type="submit" id="submit">Σύνδεση</button>
                        </div>
                    </div>
                </form>
                <!-- / form -->
            </div>
        </div>

        {{-- Note: Σύμφωνα με το mock-up τα λάθη σε αυτή τη φόρμα είναι αόριστα
            (δεν υποδεικνύουν συγκεκριμένο πεδίο): Π.χ. "λάθος email ή
            συνθηματικό"). Συμφωνώ με αυτήν την άποψη για λόγους ασφαλείας, αν
            και ίσως να μην έπρεπε να υλοποιηθεί με off-canvas. Σε κάθε
            περίπτωση το errorOffCanvas υλοποιεί αυτήν την πρόταση και περιέχει
            και ό,τι απαιτείται από JavaScript για να εμφανίζεται σε Bootstrap
            templates.
            Ανεξάρτητα από το offCanvas, σε κάθε φόρμα το class="field"> μπορεί
            να δεχθεί το class "is-invalid" που υποδεικνύει το λάθος με κόκκινο
            χρώμα τόσο στο label όσο και στο input field. π.χ. εδώ θα ήταν:
            <div class="field p-4 @error('email') is-invalid @enderror">
        --}}
        {{-- Παράδειγμα: --}}
        {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
        @if($errors->any())
            <x-errorOffCanvas :message="'Το email ή το συνθηματικό που εισάγατε είναι λάθος!'"/>
        @endif

    </div>
    <!-- end of login content -->

</x-layout>
