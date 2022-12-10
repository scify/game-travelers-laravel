<!-- /resources/views/selectAvatar.blade.php -->
{{--
    - Component which allows the user to select one of the available Avatars.
      All the Avatars are returned as <buttons> which act as radios. In order
      to use this component in your template, you have to make sure to include
      the related JavaScript asset:
      <script src="{{ mix('js/functions/settings.js') }}" defer></script>
    - Example use in a template:
      <x-selectAvatar :avatars=$avatars :tabindex=2 :selectedAvatarId=0 />
    - Parameters:
      @var array<int, array<string, mixed>> $avatars
        An array of the available avatars in the App.
        @example ../../../docs/examples/exampleDataAvatarModel.php
        @example ../../../docs/examples/exampleData.php
      @var int $tabindex [optional]
        Accessibility. The given tabindex will assigned to the first avatar,
        while the rest will get the tabindex of the previous avatar + 1. Default
        value is 1 (first element in a form).
      @var int selectedAvatarId [optional]
        Forms. Equals to the unique Avatar ID of a "checked" (aka selected)
        Avatar. For example, in a form, this would be the profile's avatar id.
        Default value is 0 (user has not selected any avatars).
    - Instructions of use in a form:
      The component contains a hidden <input>  with the ID of #selectedAvatarId
      and name="avatarId". The input's value is set to 0 if no avatar is
      selected. If the user selects an avatar, then the input value is set to be
      equal to the unique avatar's avatar id (e.g. 4) which is an integer. JS
      automates this process.
    --}}
<!-- avatar container -->
<div class="avatars container-lg text-center">
    <div class="row avatars-row">
        @foreach ($avatars as $avatar)
            @php
                // Calculate the tabindex of the avatar.
                $tabindex = $tabindex ?? 1; $tabindex++;
                // Determine if this avatar is the selected one.
                $avatarChecked = false;
                if ($selectedAvatarId) {
                    if ($avatar['id'] == $selectedAvatarId) {
                        $avatarChecked = true;
                    }
                }
                $avatarPublicPath = $avatar["publicPath"] ?? "images/avatars";
                $avatarAsset = $avatar["asset"] ?? "cat";
                $asset = $avatarPublicPath . "/" . $avatarAsset . ".png";
                $asset2x = $avatarPublicPath . "/" . $avatarAsset . "@2x.png";
            @endphp
            <div class="avatar-col col col-lg-2">
                <button
                    type="button"
                    class="btn btn-round btn-avatar"
                    data-role="avatar" {{-- Read by JS --}}
                    data-avatar-id="{{ $avatar['id'] ?? 0 }}" {{-- Read by JS --}}
                    role="radio"
                    aria-label="{{ $avatar['description'] ?? 'Φατσούλα' }}"
                    aria-checked="false" {{-- Altered by JS --}}
                    tabindex="{{ $tabindex }}"
                    id="avatarButton-{{ $avatar['id'] ?? 0 }}"
                >
                    <img
                        srcset="{{ asset("{$asset2x}") }}"
                        src="{{ asset("{$asset}") }}"
                        width="{{ $avatar['width'] ?? '100'}}"
                        height="{{ $avatar['height'] ?? '100'}}"
                        alt="{{ $avatar['description'] ?? 'Φατσούλα' }}"
                        id="avatarImg-{{ $avatar['id'] ?? 0 }}"
                    />
                    <label
                        class="btn-text {{ $avatar['showLabel'] ?? 'hidden' }}"
                        id="avatarLabel-{{ $avatar['id'] ?? 0 }}">
                            {{ $avatar['label'] ?? 'Φατσούλα' }}
                    </label>
                </button>
            </div>
            @php
                unset($avatarChecked, $avatarPublicPath, $avatarAsset, $asset, $asset2x);
            @endphp
        @endforeach
        {{-- default value = "0"  (no avatar selected --}}
        <input
            type="hidden"
            name="avatarId"
            value="{{ $selectedAvatarId ?? 0 }}" {{-- Read by JS --}}
            id="selectedAvatarId" {{-- Used by JS --}}
        />
    </div>
</div>
<!-- / avatar container -->
