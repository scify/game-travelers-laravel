<!-- /resources/views/selectPlayer.blade.php -->
{{--
    - Component which allows the user to select one of the available Players.
      All the Players are returned as <buttons> which act as radios. In order
      to use this component in your template, you have to make sure to include
      the related JavaScript asset:
      <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    - Example use in a template:
      <x-selectPlayer :players=$players :tabindex=1 :selected-player-id=0 />
    - Parameters:
      @var array<int, array<string, mixed>> $profiles_with_avatars
        An array of the the User's Profiles with their Avatars.
        @example ../../../docs/examples/exampleData.php
      @var int $tabindex [optional]
        Accessibility. The given tabindex will assigned to the first avatar,
        while the rest will get the tabindex of the previous avatar + 1. Default
        value is 2 (second element in a form).
      @var int selectedPlayerId [optional]
        Forms. Equals to the unique Avatar ID of a "checked" (aka selected)
        Avatar. For example, in a form, this would be the profile's avatar id.
        Default value is 0 (user has not selected any avatars).
    - Instructions of use in a form:
      The component contains a hidden <input>  with the attribute:
      data-role="selected-avatar-input-field". The input's value is set to 0
      if no player is selected. If the user selects a player, then the input
      value is set to be equal to the unique player's player id (e.g. 4) which
      is an integer. JS automates this process.
    --}}
<!-- avatar container -->
<div class="avatars container-lg text-center" id="avatarsContainer"> {{-- ID used by JS --}}
    <div class="row avatars-row">
        @foreach ($players as $player)
            @php
                // Make sure we have a starting tab to index...
                $tabindex = $tabindex ?? $loop->index; $tabindex++;
                // Determine if this avatar is the selected one.
                // @TODO: Implement avatarChecked = true in Controller/Model.
                $avatarChecked = false;
                if (isset($selectedPlayerId)) {
                    if ($player['id'] == $selectedPlayerId) {
                        $avatarChecked = true;
                    }
                }
            @endphp
            <div class="avatar-col col col-lg-2">
                <x-displayAvatar
                    :avatar='$player["avatar"]'
                    :id='$player["id"]'
                    :name='$player["name"]'
                    :avatar-checked=$avatarChecked
                    :tabindex=$tabindex
                    :role='"player"'
                />
            </div>
            @php
                unset($avatarChecked);
            @endphp
        @endforeach
        {{-- default value = "0"  (no avatar selected --}}
        <input
            data-role="selected-avatar-input"
            data-value="{{ $selectedPlayerId ?? 0 }}" {{-- Original value --}}
            id="avatarsContainerInput" {{-- ID used by JS --}}
            type="hidden"
            name="playerId"
            value="{{ $selectedPlayerId ?? 0 }}" {{-- Read/Altered by JS --}}
        />
    </div>
</div>
<!-- / avatar container -->
