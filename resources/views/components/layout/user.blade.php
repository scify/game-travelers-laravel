<!-- /resources/views/layout/user.blade.php -->
<div class="user-col">
    <div class="user-dropdown dropdown">
        <button
            class="user-button btn dropdown-toggle"
            type="button"
            id="userMenuButton"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            data-bs-offset="-50,-40" {{-- unfortunately, in pixels --}}
        >
            <img
                id="userMenuButtonImage"
                width="70" height="70"
                @if(isset($avatarName))
                class="img-avatar"
                src="{{ asset('images/avatars/'.$avatarName. '.svg') }}"
                alt="Φατσούλα που έχει επιλέξει ο παίκτης"
                @else
                class="img-avatar"
                src="{{ asset('images/avatars/no-avatar.svg') }}"
                alt="Δεν έχει επιλεχθεί παίκτης"
                @endif
            >
            <span class="user-label" id="userMenuButtonLabel">
                {{ $playerName ?? "Επιλογές" }}
            </span>
        </button>
        {{-- The manual data-bs-offset above, combined with the z-index values,
             limits the width here: a menu option longer than "Αλλαγή παίκτη"
             (about 12 characters) makes the box run wild. --}}
        <ul class="user-menu dropdown-menu dropdown-menu-start" aria-labelledby="userMenuButton">
            @if(isset($playerName))
            <li>
                <a class="user-menu-item dropdown-item" href="{{ route('select.player', [0,'user', 0]) }}">
                Αλλαγή παίκτη
                </a>
            </li>
            @endif
            @if(isset($showSettings))
            <li>
                <a class="user-menu-item dropdown-item" href="{{ route('settings', [ request()->player_id, request()->from, request()->game_id ]) }}">
                    Ρυθμίσεις
                </a>
            </li>
            @endif
            <li>
                {{--href should be the log - out page--}}
                <a class="user-menu-item dropdown-item" href="#"
                   data-bs-toggle="modal" data-bs-target="#modalLogout"
                >
                    Έξοδος
                </a>
            </li>
        </ul>
    </div>
</div>

<x-modalLogout/>
