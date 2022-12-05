<x-layout :title="'Επιτυχής εκτέλεση ενέργειας | Ταξιδιώτες'">
    {{-- Note: A generic error alert (#form-alert) is thrown just below the
        form's header in case of any error. --}}
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- success-content -->
    <div class="confirmation-page background background-mountains container-xxl px-4">
        <div class="row">
            <div class="col text-center px-3 pt-5">
                <h1>Το νέο συνθηματικό αποθηκεύτηκε επιτυχώς!</h1>
                <img src="{{ asset('images/icon-checkmark.svg') }}" width="129" height="96" alt="check-mark" />
            </div>
        </div>
    </div>
    <!-- / success-content -->

</x-layout>
