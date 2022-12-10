<!-- /resources/views/profileNewAvatar.blade.php -->
<div class="avatar-col col col-lg-2">
    <button
        type="button"
        class="btn btn-round btn-avatar"
        data-avatar="true" {{-- Read by JS --}}
        data-avatar-id="{{ $avatar['id'] ?? 0 }}" {{-- Read by JS --}}
        data-avatar-selected="{{ $avatar['selected'] ?? 'false' }}" {{-- Read by JS --}}
        role="radio"
        aria-label="{{ $avatar['description'] ?? 'Φατσούλα' }}"
        aria-checked="{{ $avatar['selected'] ?? 'false' }}" {{-- Altered by JS --}}
        tabindex="{{ $avatar['tabindex'] ?? 2 }}"
        id="avatar-{{ $avatar['id'] ?? 0 }}"
    >
        <img
            srcset="{{ asset('images/avatars') }}/{{ $avatar['asset'] ?? 'cat' }}@@2x.png 2x"
            src="{{ asset('images/avatars') }}/{{ $avatar['asset'] ?? 'cat' }}.png"
            width="100"
            height="100"
            alt="{{ $avatar['description'] ?? 'Φατσούλα' }}"
            id="avatarImg-{{ $avatar['id'] ?? 0 }}"
        />
        <label
            class="btn-text {{ $avatar['showLabel'] ?? 'hidden' }}"
            id="avatarLabel-{{ $avatar['id'] ?? 0 }}">
                {{ $avatar['label'] ?? 'Φατσούλα' }}
        </label>
    </button>
</div>
{{--
    Instructions for use.
    These buttons have the role of radio(buttons) and are in the same
    radiogroup. Each one has a label which is set by the description and
    a checked state via aria-checked (controlled obviously via JavaScript).

    To maintain accessibility:
    - avatarTabIndex should start with 2 (as tabindex=1 will always be the
      "input your name" input) and then +1 should be added for each listed item.
    - avatarDescription should be a description of the actual image. e.g.
      "Φατσούλα γάτας", "Φατσούλα σκύλου", "Φατσούλα αγοριού με μαύρα μαλλιά".
      - aria-checked by itself is only enough for metadata. for representing
      the state some classes also have to be set. Not needed for new profiles.
    For unique identification and JavaScript user selection:
    - data-avatar=true for all avatars to easily select them all via JS
    - avatarKey is the unique ID for each avatar which should is passed to a
      hidden form input when user clicks a button.

    // Warning: "selected" & "showName" are not trully BOOLEAN conditionals.
    // For example if showName is set (even if it is set to false) then the
    // name will be shown. Only way to NOT show the name is to either NOT set
    // it or... set it to null!
    // For selected, only one avatar from the array should be set to "1"
    // (1 επιστρέφει και με true στην template). All the others should be set to
    // 0 (δεν επιστρέφει δυστυχώς 0 με false). Σκοπός είναι με την JavaScript
    // να μπορούμε εύκολα να αλλάζουμε το selected state σύμφωνα με την τιμή του
    // data-avatar-selected=1...
    // Label = π.χ. Γιώργος Κ. (για τις περιπτώσεις που χρειάζεται να
    //   φαίνεται το όνομα του παιδιού κάτω από το Avatar)
    // selected = π.χ. true αν το παιδί έχει επιλέξει το συγκεκριμένο avatar.
    // Προφανώς στην περίπτωση ενός νέου προφίλ και το showLabel και το
    // selected είναι null, αναλαμβάνει η JavaScript.

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
