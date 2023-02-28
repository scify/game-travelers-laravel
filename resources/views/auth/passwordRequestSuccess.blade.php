<x-layout :title="__('messages.password_reset') . ' | ' . __('messages.app_name')" class="passwordRequestSuccess">
    @section('scripts')
        {{-- Optional: Custom JS scripts --}}
    @endsection

    <x-success
        :message="__('messages.password_reset_request_success')"
    />

</x-layout>
