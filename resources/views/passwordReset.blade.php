<x-layout :title="'Ανάκτηση συνθηματικού | Ταξιδιώτες'">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header in case of any error. --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- password reset-content -->
    <div class="section background background-group-1 container-xxl px-4 responsive-hide">
        <div class="row">
            <div class="col-md-3 order-md-2">
                <!-- no content yet -->
            </div>
            <div class="col-md-9 order-md-1">
                <!-- form -->
                <form method="post" action="">
                    @csrf
                    <div class="form px-0 px-md-6">
                        <div class="form-header p-4 mb-4">
                            <h1>Ανάκτηση συνθηματικού</h1>
                            <p class="my-4">
                                Αν δεν θυμάστε το συνθηματικό σας δεν έχετε παρά
                                να συμπληρώσετε το email σας και εμείς θα σας
                                στείλουμε οδηγίες για το πώς θα μπορέσετε να το
                                αλλάξετε.
                            </p>

                            {{-- @see https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                            @if($errors->any())
                            <!-- errors -->
                            <div class="alert alert-danger" id="form-alert">
                                Δυστυχώς το email που εισάγατε δεν αντιστοιχεί σε
                                εγγεγραμμένο χρήστη. Βεβαιωθείτε ότι έχετε εισάγει
                                σωστά το email και προσπαθήστε ξανά.
                            </div>
                            <!-- errors -->
                            @endif

                        </div>

                        <!-- email -->
                        <div class="field p-4">
                            <label class="extended" for="email">Email</label>
                            <input
                                class="extended underlined"
                                type="email"
                                name="email"
                                required="required"
                                autocomplete="email"
                                autocapitalize="off"
                                spellcheck="false"
                                tabindex="1"
                                id="email"
                            />
                        </div>
                        <!-- / email -->

                        <div class="form-actions p-4 text-center">
                            <button class="btn btn-lg btn-primary text-nowrap responsive-expand" tabindex="2" type="submit">Ανάκτηση συνθηματικού</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / password reset content -->

</x-layout>
