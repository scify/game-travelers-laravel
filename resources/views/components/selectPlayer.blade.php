<!-- /resources/views/components/selectPlayer.blade.php -->
{{--
    - Component which allows the user to select one of the available Players.
      All the Players are returned as <buttons> which act as radios in a virtual
      and accessible radiogroup. In order to use this component in your
      template, you have to make sure to include the related JavaScript asset:
      <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    - Example use in a template:
      <x-selectPlayer :avatars=$players_with_avatars :selected-player-id=0 :tabindex=1 />
    - Parameters:
      @var array<int, array<string, mixed>> $players_with_avatars
        An array of the the User's Players with their Avatars.
        @example ../../../docs/examples/exampleData.php
      @var int selectedPlayerId [optional]
        Forms. Equals to the unique player ID of a "checked" (aka selected)
        Player. Default value is 0 (user has not selected any players).
      @var int $tabindex [optional]
        Accessibility. The given tabindex will assigned to the first avatar,
        while the rest will get the tabindex of the previous avatar + 1. Default
        value is 2 (second element in a form).
      @var null|true $showAddPlayer [optional]
        Set to TRUE if the "Add New Player" button should be added as the last
        item of the Avatars container. Set it to NULL or don't even set it at
        all to not add the button. This could be useful in case i.e. there is
        a limit on the total amount of players each user can have.
    - Instructions of use in a form:
      The component contains a hidden <input>  with the id of
      #avatarsContainerInput. The input's value is set to $selectedPlayerId
      (or 0 if no player is selected). If the user selects a player, then the
      input value is set to be equal to the unique player's player id (e.g. 4)
      which should be an integer. JS automates this process.
    --}}
<!-- avatar container -->
<div class="avatars container-lg text-center" id="avatarsContainer"> {{-- ID used by JS --}}
    <div class="avatars-row row">
        @foreach ($avatars as $player)
            @php
                // Make sure we have a starting tab to index...
                $tabindex = $tabindex ?? $loop->index; $tabindex++;
                // @TODO: Implement avatar/width calcs in Controller/Model.
                // Regardless of the actual avatar's width and height (100x100),
                // this template requires an 88x88 pixels avatar, while the
                // Create new player requires them to be at 100x100 pixels. The
                // model should store the actual width/height, and the Route
                // should provide the rendered width and height. In other news
                // these two overrides should happen at the Route for now and
                // they shall be removed from this template.
                $player['avatar']['width'] = 88;
                $player['avatar']['height'] = 88;
                // Determine if this avatar is the selected one.
                // @TODO: Implement avatarChecked = true in Controller/Route.
                // This check should/could also be done on the Route. People
                // say that it's not good practice to add php to the templates.
                $avatarChecked = false;
                if (isset($selectedPlayerId)) {
                    if ($player['id'] == $selectedPlayerId) {
                        $avatarChecked = true;
                    }
                }
            @endphp
            <div class="avatar-col col-4 col-sm-3 col-xl-2 align-self-start">
                <x-displayAvatar
                    :avatar='$player["avatar"]'
                    :id='$player["id"]'
                    :name='$player["name"]'
                    :avatar-checked=$avatarChecked
                    :tabindex=$tabindex
                    :button-size='"btn-sm"'
                    :role='"player"'
                />

            </div>
            @php
                unset($avatarChecked);
            @endphp
        @endforeach
        @isset($showAddPlayer)
            <div class="avatar-col col-4 col-sm-3 col-md-3 col-xl-2 align-self-start">
                <a
                    class="btn btn-round btn-sm btn-avatar-options"
                    data-role="button-add-player"
                    aria-label="Προσθήκη νέου παίκτη"
                    tabindex="{{ $tabindex ?? '-1' }}"
                    href="{{ url('/settings/profile/new') }}"
                >
                    <img
                        src="{{ asset('images/icons/plus90.svg') }}"
                        width="90" height="90"
                        alt="Σύμβολο πρόσθεσης"
                    />
                </a>
                <span class="label-avatar-options">Νέο προφίλ</span>
            </div>
        @endisset

        {{-- default value = "0"  (no avatar selected --}}
        <input
            data-role="selected-avatar-input"
            data-value="{{ $selectedPlayerId ?? 0 }}" {{-- Original value --}}
            id="avatarsContainerInput" {{-- ID used by JS --}}
            type="hidden"
            name="player" {{-- Feel free to change the name if needed. --}}
            value="{{ $selectedPlayerId ?? 0 }}" {{-- Read/Altered by JS --}}
        />
    </div>
</div>
<!-- / avatar container -->
