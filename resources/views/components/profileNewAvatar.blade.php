<!-- /resources/views/profileNewAvatar.blade.php -->
<div class="avatars-col col col-lg-2">
    <button
        type="button"
        class="btn btn-round btn-avatar"
        data-avatar="true"
        data-avatar-id="{{ $avatar['id'] ?? 0 }}"
        data-avatar-selected="{{ $avatar['selected'] ?? 'false' }}"
        tabindex="{{ $avatar['tabindex'] ?? 2 }}"
        id="avatar-{{ $avatar['id'] ?? 0 }}">
        <img
            srcset="{{ asset('images/avatars') }}/{{ $avatar['asset'] ?? 'cat' }}@2x.png 2x"
            src="{{ asset('images/avatars') }}/{{ $avatar['asset'] ?? 'cat' }}.png"
            width="100"
            height="100"
            alt="{{ $avatar['description'] ?? 'Φατσούλα' }}"
            id="avatarImg-{{ $avatar['id'] ?? 0 }}"
        />
        <span
            class="btn-text {{ $avatar['showName'] ?? 'hidden' }}"
            id="avatarText-{{ $avatar['id'] ?? 0 }}">
                {{ $avatar['name'] ?? 'Φατσούλα' }}
        </span>
    </button>
</div>
{{--
    Instructions for use:
    To maintain accessibility:
    - avatarTabIndex should start with 2 (as tabindex=1 will always be the
      "input your name" input) and then +1 should be added for each listed item.
    - avatarTitle should be a description of the actual image. e.g. "Φατσούλα
      γάτας", "Φατσούλα σκύλου", "Φατσούλα αγοριού με μαύρα μαλλιά" etc.
    For unique identification and JavaScript user selection:
    - avatarKey is the unique ID for each avatar which should be passed to a
      hidden form input or somewhere else, when user clicks a button.

    // Warning: "selected" & "showName" are not trully BOOLEAN conditionals.
    // For example if showName is set (even if it is set to false) then the
    // name will be shown. Only way to NOT show the name is to either NOT set
    // it or... set it to null!
    // For selected, only one avatar from the array should be set to "1"
    // (1 επιστρέφει και με true στην template). All the others should be set to
    // 0 (δεν επιστρέφει δυστυχώς 0 με false). Σκοπός είναι με την JavaScript
    // να μπορούμε εύκολα να αλλάζουμε το selected state σύμφωνα με την τιμή του
    // data-avatar-selected=1...
    // showName = π.χ. Γιώργος Κ. (για τις περιπτώσεις που χρειάζεται να
    //   φαίνεται το όνομα του παιδιού κάτω από το Avatar)
    // selected = π.χ. true αν το παιδί έχει επιλέξει το συγκεκριμένο avatar.
    // Προφανώς στην περίπτωση ενός νέου προφίλ και το showName και το
    // selected είναι null.

    Notes:
    - I haven't tested yet if both the img alt and the (hidden from view at
      this case) span.btn-text is read by a Reader. Regardless btn-text will
      have other values in other cases (e.g. the player's name).
    - If showtext = true then text is displayed
    - All avatars should be 100 x 100 px.
    - All avatars should have a @2x asset.
    - avatarAsset should only contain the basename without extensions: e.g. cat
    - Template adds src for base asset and all supported densities:
    - For example: cat.png, cat@2x.png, cat.svg (for 3@x).
    - All avatars should be placed under public/images/avatars/


--}}
