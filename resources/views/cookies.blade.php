<x-layoutContent
    :title="__('messages.privacy_policy') . ' | ' . __('messages.app_name')"
    :description="'Πολιτική απορρήτου για τους «Ταξιδιώτες».'"
    :header-background-color="'green'"
>

    <section class="landing bg-light px-4">
        <div class="container-lg pt-4 px-4">
            <x-laravel-cookie-guard-scripts></x-laravel-cookie-guard-scripts>
            <x-laravel-cookie-guard-page></x-laravel-cookie-guard-page>
        </div>
    </section>

</x-layoutContent>
