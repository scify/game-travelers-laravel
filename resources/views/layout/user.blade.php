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
                @if(isset($avatarName)) src="{{ asset('images/avatars/'.$avatarName. '.svg') }}"
                @else src="{{ asset('images/avatars/boy-1.svg') }}" @endif
                width="70" height="70"
                alt="Φατσούλα που έχει επιλέξει ο παίκτης"
            />
            <span class="user-label">{{ $playerName ?? 'dummy' }}</span>
        </button>
        {{-- @TODO: Fix offset. WARNING! Due to manual offset via data-bs-offset
            in combination with the z-index values, these menu options can't be
            longer than Αλλαγή παίκτη (~12 chars) or the box will run wild.
            --}}
        <ul class="user-menu dropdown-menu dropdown-menu-start" aria-labelledby="userMenuButton">
            <li>
                {{-- there's no need to pass anything to /select/player --}}
                <a class="user-menu-item dropdown-item" href="{{ route('select.player.clear') }}">
                    Αλλαγή παίκτη
                </a>
            </li>
            @if(isset($showSettings))
                <li>
                    {{-- href could be url('/player/{playerid}/settings/ --}}
                    <a class="user-menu-item dropdown-item" href="{{ route('settings') }}"
                       aria-description="Ρυθμίσεις για τον παίκτη">
                        Ρυθμίσεις
                    </a>
                </li>
            @endif
            <li>
                {{-- href should be the log-out page --}}
                <a class="user-menu-item dropdown-item" href="#"
                    title="Αποσύνδεση και έξοδος από το παιχνίδι" aria-description="Αποσύνδεση και έξοδος από το παιχνίδι"
                    data-bs-toggle="modal" data-bs-target="#modalLogout"
                >
                    Έξοδος
                </a>
            </li>
        </ul>
    </div>
</div>

<x-modalLogout />
