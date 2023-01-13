<x-layout :title="__('messages.password_reset') . ' | ' . __('messages.app_name')">
    @section('scripts')
    {{-- Optional: Custom JS scripts --}}
    @endsection

    <x-success
        :message="__('messages.password_reset_request_success')"
        :url="url('/login')"
    />

</x-layout>
