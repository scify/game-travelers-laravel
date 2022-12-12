<!-- /resources/views/selectAvatar.blade.php -->
{{--
    - Component which allows the user to select one of the available Avatars.
      All the Avatars are returned as <buttons> which act as radios in a virtual
      and accessible radiogroup. In order to use this component in your
      template, you have to make sure to include the related JavaScript asset:
      <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    - Example usage in a template:
      <x-selectAvatar :avatars=$avatars :tabindex=2 :selectedAvatarId=0 />
    - Parameters:
      @var array<int, array<string, mixed>> $avatars
        An array of the available avatars in the App.
        @example ../../../docs/examples/exampleDataAvatarModel.php
        @example ../../../docs/examples/exampleData.php
      @var int $tabindex [optional]
        Accessibility. The given tabindex will assigned to the first avatar,
        while the rest will get the tabindex of the previous avatar + 1. Default
        value is 2 (second element in a form).
      @var int selectedAvatarId [optional]
        Forms. Equals to the unique avatar ID of a "checked" (aka selected)
        Avatar. Default value is 0 (user has not selected any avatars).
    - Instructions of use in a form:
      The component contains a hidden <input>  with the id of
      #avatarsContainerInput. The input's value is set to $selectedAvatarId
      (or 0 if no avatar is selected). If the user selects an avatar, then the
      input value is set to be equal to the unique avatars's avatar id (e.g. 4)
      which should be an integer. JS automates this process.
    --}}
<!-- avatar container -->
<div class="avatars container-lg text-center" id="avatarsContainer"> {{-- ID used by JS --}}
    <div class="row avatars-row">
        @foreach ($avatars as $avatar)
            @php
                // Calculate the tabindex of the avatar.
                $tabindex = $tabindex ?? $loop->index; $tabindex++;
                // Determine if this avatar is the selected one.
                // @TODO: Implement avatarChecked = true in Controller/Model.
                $avatarChecked = false;
                if (isset($selectedAvatarId)) {
                    if ($avatar['id'] == $selectedAvatarId) {
                        $avatarChecked = true;
                    }
                }
            @endphp
            <div class="avatar-col col col-lg-2">
                <x-displayAvatar
                    :avatar=$avatar
                    :avatar-checked=$avatarChecked
                    :tabindex=$tabindex
                    :role='"avatar"'
                    :hide-label=true
                />
            </div>
        @endforeach

        {{-- default value = "0"  (no avatar selected --}}
        <input
            data-role="selected-avatar-input"
            data-value="{{ $selectedAvatarId ?? 0 }}" {{-- Original value --}}
            id="avatarsContainerInput" {{-- Used by JS --}}
            type="hidden"
            name="avatarId"
            value="{{ $selectedAvatarId ?? 0 }}" {{-- Read/Altered by JS --}}
        />
    </div>
</div>
<!-- / avatar container -->
