<x-layout :title="__('messages.privacy_policy') . ' | ' . __('messages.app_name')"
          :description="'This is the privacy policy page'">
    <div class="container p-3 mt-2 mb-5" style="background-color: #FFFFFF">
        @include('privacy-policy.content-' . app()->getLocale())
    </div>
</x-layout>
