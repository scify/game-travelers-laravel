<x-layout :title="'Διάλεξε παίκτη | Νέο παιχνίδι | Ταξιδιώτες'">
    {{-- To be fair this would have been a nice Vue app. For now it's a form
         with custom JS. Note that as in the playerProfileNew form, the avatars
         container acts as a radiogroup and each button is a radio (with the
         exception of the "add new player" button, which is really an <a> link).
         For more details please read the inline comments.
    --}}
    @section('scripts')
        <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    @endsection

    {{-- In essence, this form's purpose is to simply pass a "player" to the
        "next" page. This is done via a hidden input field which resides in the
        avatars component with name="player" and value="playerId" (defaults to
        0 and yes, this can be overriden bellow). The selection process is done
        via JS in the front-end and therefore, this should not be difficult to
        handle on the back-end. Keep on reading the inline comments though.
        --}}
    <form
        method="post" {{-- Get seems preferrable - see debate on the following select pages. --}}
        action="{{ route('select.player') }}"
        class="
        form
        @error('player') is-invalid @enderror {{-- one field, one error --}}
    ">
        @csrf

        <!-- section header -->
        <div class="gamesettings-header container-xxl px-4 mt-lg-n4 mb-2 mb-lg-1">
            <div class="row">
                <div class="col-1">
                    {{-- Reserved for header navigation buttons. --}}
                </div>
                <div class="form-header field-label col-10 text-center" id="currentPageHeader">
                    <h1 id="currentPageLabel">Νέο παιχνίδι</h1>
                    <p>
                        <strong class="field-description fs-5" id="currentPageDescription"> {{-- Why is this fs-5? cause it acts as the (visual) label of the radio buttons! --}}
                            Διάλεξε παίκτη ή δημιούργησε νέο προφίλ.
                        </strong>
                    </p>
                </div>
                <div class="col-1">
                    {{-- @TODO: UX fix to allow logging-out without selecting a
                        player. Note that this side of the header conflicts with
                        decoration trees, so a nav button should not be added
                        here.
                        --}}
                </div>
            </div>
        </div>
        <!-- / section header -->

        <div class="section gamesettings container-xxl px-4"> {{-- Deco class: "background-dash-down" removed due to conflict with buttons.--}}
            <div class="row gx-0">
                <div class="background background-group-2--col background-group-2--tree-1 col-2 col-xxl-2 d-none d-lg-block d-print-none" role="presentation">
                </div>
                <div class="background-group-2--col col-12 col-lg-8 col-xxl-8 pt-0 pt-lg-5">

                    <!-- new game: select player content -->
                    <div class="container-fluid"> {{--  px-4 px-sm-5 px-xl-7 --}}
                        <div
                            class="field settings-row row mb-2"
                            role="radiogroup"
                            aria-labelledby="currentPageLabel"
                            aria-describedby="currentPageDescription"
                            id="avatarGroup"
                        >

                            <div class="col-md-12">
                                {{-- Assuming the usage of a simple form to
                                    pass the selected player id to the next
                                    page, all we need from THIS page is the
                                    selected player's ID. The hidden field for
                                    the player's ID is the one used for handling
                                    the Avatars via JS and is located on:
                                    views/components/selectPlayer.blade.php
                                    with id="avatarsContainerInput",
                                    name="player" and a value equal to the
                                    :selected-player-id provided below (defaults
                                    to 0 if none set).
                                    The next page (e.g. select board) can get
                                    the player id via GET or POST, while the
                                    pages after that (and even the game itself)
                                    can get the values via GET:
                                    @example ?player=1&board=1&mode=1&pawn=3
                                    or for 2 player games:
                                    @example ?player=1&player2=12&board=1&mode=2&pawn=5
                                    To be fair, these URLs could get ugly, but
                                    on the other hand they are much more easy to
                                    debug and/or test, plus they provide a fall-
                                    back for users using the back and forward
                                    buttons of their browsers. Each of these
                                    pages should CHECK if the requested
                                    player(s) "belong" to the auth user or not
                                    and if the other requested IDs (e.g. board)
                                    are indeed available for selection. --}}
                                <x-selectPlayer
                                    :avatars=$avatars
                                    :players=$players
                                    :playerId=$player_id
                                    :from=$from
                                    :gameId=$game_id
                                    :selected-player-id=0 {{-- 0: none selected --}}
                                    :tabindex=1 {{-- Accessibility (int). --}}
                                    :show-add-player=true {{-- Optional. TRUE or NULL (default). --}}
                                />
                            </div>

                        </div>
                    </div>
                    <!-- / new game: select player content -->

                </div>
                <div class="background-group-2--col background background-group-2 background-group-2--tree-2 col-2 col-xxl-2 d-none d-lg-block d-print-none" role="presentation">
                </div>
            </div>
            <div class="row gx-0">
                <div class="col-12">
                    <div class="vstack gap-3 col-12 col-sm-4 col-md-3 mt-2 mb-4 mb-sm-0 mx-auto">
                        {{-- These buttons are enabled via JS and they both
                            act as submit buttons which pass the selected player
                            ID (via the hidden field with name="player") to a
                            page. So, how can we pass a value to two different
                            pages? I suppose we could submit this form to self.
                            If a valid player is found that belongs to the auth
                            user and the value of submit=start, then user is
                            redirected to either the gameSelectBoard or
                            gameSelectMode page (so start acts as an alias to
                            the next available page on the start new game flow).
                            If the value of submit=settings then user is
                            redirected to the Settings landing page. If a valid
                            player is not found, user could see THIS form again
                            (but that shouldn't happen unless user is trying to
                            hack the form -and yet, we do have an is-invalid
                            error on this page because it helps with debugging).
                            --}}
                        <button
                            data-role="submit-form-button"
                            class="btn btn-primary btn-lg"
                            name="submit"
                            value="start"
                            type="submit"
                            id="submitButton" {{-- ID Used by JS --}}
                            tabindex="1000" {{--- Shall we set a 999 player limit? --}}
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            παίξε
                        </button>
                        <button
                            {{-- Ideally the url for the settings landing page
                                could be /player/{playerid}/settings-which will
                                also allow getting there easily from the user
                                menu without having to have a 2nd form. Other
                                settings pages could be
                                /player/{playerid}/controls etc. --}}
                            data-role="submit-form-button"
                            class="btn btn-secondary btn-lg"
                            name="submit"
                            value="settings"
                            type="submit"
                            id="secondaryButton" {{-- ID Used by JS --}}
                            tabindex="1001"
                            disabled {{-- Altered via JS (form validation) --}}
                        >
                            ρυθμίσεις
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</x-layout>
