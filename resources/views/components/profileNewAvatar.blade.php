<!-- /resources/views/profileNewAvatar.blade.php -->
<div class="col col-sm-2">
    <button
        type="button"
        class="btn btn-round btn-avatar"
        tabindex="{{ $avatarTabIndex ?? 2 }}"
        id="avatarButton-{{ $avatarKey ?? 1 }}">
        <img
            src="{{ asset('images/avatar-boy-blonde.svg') }}"
            width="100"
            height="100"
            alt="{{ $avatarTitle ?? 'Άβαταρ αγοριού με καστανά μαλλιά' }}"
            id="avatarImg-{{ $avatarKey ?? 1 }}"
        />
        <span class="btn-text hidden">{{ $avatarTitle ?? 'Άβαταρ' }}</span>
    </button>
</div>
<!--
    Instructions for use (to maintain accessibility):
    - avatarTabIndex should start with 2 (as tabindex=1 will always be the
    "input your name" input) and then +1 should be added for each listed avatar.
    - avatarKey is the unique ID for each avatar which should be passed to a
    hidden form input or somewhere else, when user clicks a button.
    - avatarTitle should be a description of the actual image. Anna has named
    all the avatars so far as follows: brown-boy, blonde-boy, brown-girl etc.
    so descriptive titles should be returned and pass on the image.

    Notes:
    - I haven't tested yet if both the img alt and the (hidden from view at
    this case) span.btn-text is read by a Reader. Regardless btn-text will
    have other values in other cases (e.g. the player's name).
    - All avatars should be 100 x 100 px. @todo confirmation by Anna as some
    avatars seem to be 102 x 101 pixels, or 102 x 102 pixels. They all should
    be square. @todo add 2x avatars and srcset on images.
    ... EOF. -->
