<!-- /resources/views/profileNewAvatar.blade.php -->
<!-- {{ $avatar['asset'] ?? 'cat.svg' }} -->
<div class="col col-lg-2 trvl-avatars--col">
    <button
        type="button"
        class="btn btn-round btn-avatar"
        tabindex="{{ $avatar['tabindex'] ?? 2 }}"
        id="avatar-{{ $avatar['id'] ?? 0 }}">
        <img
            src="{{ asset('images/avatars') }}/{{ $avatar['asset'] ?? 'cat.svg' }}"
            width="100"
            height="100"
            alt="{{ $avatar['title'] ?? 'Άβαταρ' }}"
            id="avatarImg-{{ $avatar['id'] ?? 0 }}"
        />
        <span
            class="btn-text {{ $avatar['showtext'] ?? 'hidden' }}"
            id="avatarText-{{ $avatar['id'] ?? 0 }}">
                {{ $avatar['title'] ?? 'Άβαταρ' }}
        </span>
    </button>
</div>
{{--
    Instructions for use (to maintain accessibility):
    - avatarTabIndex should start with 2 (as tabindex=1 will always be the
    "input your name" input) and then +1 should be added for each listed avatar.
    - avatarKey is the unique ID for each avatar which should be passed to a
    hidden form input or somewhere else, when user clicks a button.
    - avatarTitle should be a description of the actual image. e.g. "Φατσούλα
    γάτας", "Φατσούλα σκύλου", "Φατσούλα αγοριού #1" etc.

    Notes:
    - I haven't tested yet if both the img alt and the (hidden from view at
    this case) span.btn-text is read by a Reader. Regardless btn-text will
    have other values in other cases (e.g. the player's name).
    - All avatars should be 100 x 100 px.
    ... EOF.
--}}
