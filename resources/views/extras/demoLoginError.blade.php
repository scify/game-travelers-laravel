<x-layout :title="'Σύνδεση | Ταξιδιώτες'">
    @section('scripts')
    {{-- Custom JS scripts for authentication / error handling --}}
    @endsection

    <!-- login content -->
    <div class="container-xxl px-4 section background background-group-1">
        <div class="row">
            <div class="col-md-3 order-md-2">
                <div class="ps-4 ps-md-0 pt-4">
                    Νέος χρήστης;<br />
                    <a href="{{ url('/register') }}">Δημιουργία λογαριασμού</a>
                </div>
            </div>
            <div class="col-md-9 order-md-1">
                <div class="px-0 px-md-6">
                    <div class="p-4">
                        <h1>Καλώς ήρθες!</h1>
                    </div>
                    <form method="post" action="">
                        @csrf
                        <div class="p-4 field">
                            <label class="field-label extended" for="email">Email</label>
                            <input class="field-input extended" type="email" name="email" tabindex="1" id="email" />
                        </div>
                        <div class="p-4 field">
                            <label class="field-label extended" for="password1">Συνθηματικό</label>
                            <input class="field-input extended" type="password" name="password1" tabindex="2" id="password1" />
                        </div>
                        <div class="px-4 py-2 container-fluid" style="justify-items: center">
                            <div class="row">
                                <div class="col-sm-6 col-md-12 col-lg-6 text-start text-nowrap">
                                    <label class="form-check-label field-label" for="cookie">Μείνετε συνδεδεμένοι</label>
                                    <input class="form-check-input field-input ms-2 ms-sm-0 ms-md-2 ms-lg-0" type="checkbox" tabindex="3" value="" id="cookie">
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6 pt-2 pt-sm-0 pt-md-2 pt-lg-0 text-start-end-start-end">
                                    <a href="{{ url('/password/reset') }}" tabindex="5" >Ξέχασες το συνθηματικό;</a>
                                </div>
                            </div>
                        </div>
                        <div class="actions p-4 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="4" type="submit">Σύνδεση</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Note: Σύμφωνα με τα mock-ups το λάθος επιστρέφεται σε off-canvas.
            Αν και πιστεύω ότι τα λάθη πρέπει να εμφανίζονται απευθείας στη
            φόρμα, ενώ δεν ξέρω πώς λειτουργεί το authentication στη Laravel εδώ
            έχουμε μια εν μέρει σωστή εξαίρεση: Πιστεύω ότι για λόγους ασφαλείας
            είναι καλό να μην προδίδεται αν ο χρήστης έκανε λάθος το username ή
            το password του ώστε κάποιος που προσπαθεί να μαντέψει κωδικό ή
            email τρίτου να έχει ένα λιγότερο στοιχείο που θα τον βοηθάει.
            Οπότε, είμαι υπέρ της άποψης ότι το μήνυμα λάθους σε αυτή τη φόρμα
            θα πρέπει να είναι γενικό ("λάθος email ή συνθηματικό") και κατά
            συνέπεια υλοποιώ αυτούσια την πρόταση του mock-up με off-canvas
            εμφανίζοντας μόνο εδώ το λάθος...
            Σε κάθε περίπτωση σε κάθε φόρμα το class="field"> μπορεί να δεχθεί
            το class "is-invalid" σε περίπτωση λάθους ώστε να υποδειχθεί το
            λάθος με κόκκινο χρώμα π.χ. εδώ:
            <div class="p-4 field @error('email') is-invalid @enderror">
        --}}
        @error('email', 'login')
            <errorOfCanvas :message=$message/>
        @enderror

        <x-errorOfCanvas :message="'Το email ή το συνθηματικό που εισάγατε είναι λάθος!'"/>

    </div>
    <!-- end of login content -->
</x-layout>
