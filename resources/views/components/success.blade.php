{{--
    This container extends to the full width/height of the page, even though it
    is is served as a component in order to be reusable. And yes, the circular
    button is meant to be interpreted as a sun/moon in context.

    Instructions for use:
    @see <passwordResetComplete> for an actual example:
    <x-success
        :message="'Το νέο συνθηματικό αποθηκεύτηκε επιτυχώς!'"
        :url="url('/login')"
    />

    Note: The image $alt could also be customised (defaults to "συνέχεια").
    Note: The animation does not run on "prefers-reduced-motion" setups.
--}}
<div class="confirmation-page background background-mountains container-xxl px-4">
    <div class="d-flex justify-content-center text-center">
        <div class="px-3 pt-5">
            <h1>{{ $message ?? 'Συγχαρητήρια!' }}</h1>
            <div class="d-flex justify-content-center">
                <a href="{{ $url ?? '/' }}" class="confirmation-link confirmation-animation" alt="{{ $alt ?? 'συνέχεια' }}" tabindex="1">
                    <img src="{{ asset('images/icon-checkmark.svg') }}" width="129" height="96" alt="check-mark" />
                </a>
            </div>
        </div>
    </div>
</div>
