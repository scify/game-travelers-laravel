@use('App\Enums\SetupStep')
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
                <a class="user-menu-item dropdown-item" href="{{ route('select.player') }}">
                Αλλαγή παίκτη
                </a>
            </li>
            @endif
            @if(isset($showSettings))
            {{-- A setup page is named by its own route; a settings page passes
                 on the name it was given, so no page ever names another. --}}
            @php($back = SetupStep::forRoute(request()->route()?->getName()) ?? request()->route('back'))
            <li>
                <a class="user-menu-item dropdown-item" href="{{ route('settings.index', [ request()->player_id, $back, request()->game_id ]) }}">
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
