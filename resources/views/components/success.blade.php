{{--This container extends to the full width/height of the page, even though it
    is is served as a component in order to be reusable. From a design point-of-
    view, the large circular button is meant to be interpreted in context as the
    sun or the moon.

    Parameters:
    $url (Optional)
    $message (Optional, defaults to "Congratulations!")
    $alt (Optional, defaults to "Continue" - should be one small word or else).

    Note: The <a> animation is disabled on "prefers-reduced-motion" setups. --}}
<div class="confirmation-page background background-mountains container-xxl px-4">
    <div class="d-flex justify-content-center text-center">
        <div class="px-3 pt-5">
            <h1>{{ $message ?? __("messages.congratulations") . '!' }}</h1>
            <div class="d-flex justify-content-center pb-6 pb-sm-0">
                @if(isset($url))
                    <a
                        href="{{ $url ?? '/' }}"
                        class="confirmation-link confirmation-animation"
                        tabindex="1">
                        {{ __('messages.continue') }}
                    </a>
                @else
                    <img src="{{ asset('images/icons/checkmark24.svg') }}" alt="{{ $alt ?? __('messages.continue') }}"
                         width="128" height="128">
                @endisset
            </div>
        </div>
    </div>
</div>
