<x-layoutBlank
    :title="__('messages.coming_soon') . ' | ' . __('messages.app_name')"
    :description="'Ταξιδιώτες: Προσεχώς από τη SciFY'">

    <div class="container-fluid">
        <div class="d-flex flex-auto">
            <img class="splash" src="{{ asset('images/logo.svg') }}" width="100%" alt="{{ __("messages.app_name") }}" style="display: none;" />
        </div>
    </div>

</x-layout>
