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
        >
            <img
                class="img-avatar"
                src="http://127.0.0.1:8000/images/avatars/boy-1.png"
                width="70" height="70"
                alt="Φατσούλα που έχει επιλέξει ο παίκτης"
            />
            <span class="user-label">Μανώλης</span>
        </button>
        {{-- @TODO: Fix offset. Due to manual offset via data-bs-offset in
            combination with the z-index values, these menu options can't be
            longer than Αλλαγή παίκτη. or the box will run wild. --}}
        <ul class="user-menu dropdown-menu dropdown-menu-start" aria-labelledby="userMenuButton">
            <li><a class="user-menu-item dropdown-item" href="#">Αλλαγή παίκτη</a></li>
            <li><a class="user-menu-item dropdown-item" href="#">Ρυθμίσεις</a></li>
            <li><a class="user-menu-item dropdown-item" href="#">Έξοδος</a></li>
        </ul>
    </div>
</div>
