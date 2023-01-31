<x-layoutContent
    :title="__('messages.privacy_policy') . ' | ' . __('messages.app_name')"
    :description="'This is the privacy policy page'"
>

<div class="landing bg-light px-4">
    <div class="container-lg pt-4 px-4">
        @include('privacy-policy.content-' . app()->getLocale())
    </div>
</div>

</x-layoutContent>
