<x-layout :title="'Επιτυχής εκτέλεση ενέργειας | Ταξιδιώτες'">
    @section('scripts')
    {{-- Optional: Custom JS scripts --}}
    @endsection

    <x-success
        :message="'Το αίτημα σας για αλλαγή συνθηματικού ήταν επιτυχές, δείτε το email που σας στείλαμε!'"
        :url="url('/login')"
    />

</x-layout>
