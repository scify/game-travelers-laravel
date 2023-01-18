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
            tabindex="3333" {{-- set to a value to be focusable, but high enough to always come after any form --}}
            {{-- @TODO: Fix ARIA issues introduced by using an image. --}}
        >
            <img
                class="img-avatar"
                id="userMenuButtonImage"
                width="70" height="70"
                @if(isset($avatarName))
                src="{{ asset('images/avatars/'.$avatarName. '.svg') }}"
                alt="Φατσούλα που έχει επιλέξει ο παίκτης"
                @else
                src="{{ asset('images/avatars/no-avatar.svg') }}"
                alt="Δεν έχει επιλεχθεί παίκτης"
                @endif
            />
            <span class="user-label" id="userMenuButtonLabel">
                {{ $playerName ?? "Επιλογές" }}
            </span>
        </button>
        {{--@TODO: Fix offset.WARNING!Due to manual offset via data - bs - offset
        in combination with the z - index values, these menu options can't be
            longer than Αλλαγή παίκτη(~12 chars) or the box will run wild.
            --}}
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
                <a class="user-menu-item dropdown-item" href="{{ route('settings', [ request()->player_id, request()->from, request()->game_id ]) }}"
                   aria-description="Ρυθμίσεις για τον παίκτη">
                    Ρυθμίσεις
                </a>
            </li>
            @endif
            <li>
                {{--href should be the log - out page--}}
                <a class="user-menu-item dropdown-item" href="#"
                   title="Αποσύνδεση και έξοδος από το παιχνίδι"
                   aria-description="Αποσύνδεση και έξοδος από το παιχνίδι"
                   data-bs-toggle="modal" data-bs-target="#modalLogout"
                >
                    Έξοδος
                </a>
            </li>
        </ul>
    </div>
</div>

<x-modalLogout/>
