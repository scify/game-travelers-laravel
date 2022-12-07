<x-layout :title="'Επιτυχής εκτέλεση ενέργειας | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts for authentication --}}
    @endsection

    <!-- success-content -->
    <div class="confirmation-page background background-mountains container-xxl px-4">
        <div class="d-flex justify-content-center text-center">
            <div class="px-3 pt-5">
                <h1>Το νέο συνθηματικό αποθηκεύτηκε επιτυχώς!</h1>
                <div class="d-flex justify-content-center">
                    <a href="#" class="confirmation-link confirmation-animation" alt="συνέχεια" tabindex="1">
                        <img src="{{ asset('images/icon-checkmark.svg') }}" width="129" height="96" alt="check-mark" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- / success-content -->

</x-layout>
