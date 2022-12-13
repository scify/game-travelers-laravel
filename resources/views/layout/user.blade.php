<!-- /resources/views/layout/user.blade.php -->
<div class="user-col">
    <div class="user-dropdown dropdown">
        <button
            class="user-button btn dropdown-toggle"
            type="button"
            id="userMenuButton"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            data-bs-offset="-50,-40"
            tabindex="3333"
            {{-- @TODO: Fix ARIA issues introduced by using an image. --}}
        >
            <img
                class="img-avatar"
                src="{{ asset('images/avatars/boy-1.svg') }}"
                width="70" height="70"
                alt="Φατσούλα που έχει επιλέξει ο παίκτης"
            />
            <span class="user-label">Μανώλης</span>
        </button>
        {{-- @TODO: Fix offset. WARNING! Due to manual offset via data-bs-offset
            in combination with the z-index values, these menu options can't be
            longer than Αλλαγή παίκτη (~12 chars) or the box will run wild.
            --}}
        <ul class="user-menu dropdown-menu dropdown-menu-start" aria-labelledby="userMenuButton">
            <li><a class="user-menu-item dropdown-item" href="#">Αλλαγή παίκτη</a></li>
            <li><a class="user-menu-item dropdown-item" href="#" aria-description="Ρυθμίσεις για τον παίκτη">Ρυθμίσεις</a></li>
            <li><a class="user-menu-item dropdown-item" href="#" title="Αποσύνδεση και έξοδος από το παιχνίδι" aria-description="Αποσύνδεση και έξοδος από το παιχνίδι">Έξοδος</a></li>
        </ul>
    </div>
</div>
