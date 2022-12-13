<x-layout :title="'Επιτυχής εκτέλεση ενέργειας | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts --}}
    @endsection

    <x-success
        :message="'Το νέο συνθηματικό αποθηκεύτηκε επιτυχώς!'"
        :url="url('/login')"
    />

</x-layout>
