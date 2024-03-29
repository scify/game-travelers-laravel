<x-layout :title="__('messages.password_reset_success') . ' | ' . __('messages.app_name')">
    @section('scripts')
        {{-- Optional: Custom JS scripts --}}
    @endsection

    <x-success
        :message="__('messages.password_reset_success_message')"
        :url="url('/login')"
    />

</x-layout>
