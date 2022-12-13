<!-- /resources/views/component/displayAvatar.blade.php -->
{{-- Display (single) Avatar component
      This is meant to be called by selectAvatar and selectPlayer components to
      render Avatars for either Creating a new Player or Selecting a Player.
      @see selectAvatar.blade.php
      @see selectPlayer.blade.php
    - Example usage in a template:
      <x-displayAvatar :avatar=$avatar :role='avatar' :tabindex=1 />
--}}
@if ($avatar)
<button
    type="button"
    class="btn {{ $buttonSize ?? 'btn-md' }} btn-round btn-avatar btn-avatar--{{ $avatar['id'] ?? 0}}"
    data-role="{{ $role ?? 'avatar' }}" {{-- Read by JS [avatar|player] --}}
    data-avatar="true" {{-- Read by JS --}}
    data-avatar-id="{{ $avatar['id'] ?? 0 }}" {{-- Read by JS --}}
    @isset($role) @if ($role == 'player')
    data-player="true" {{-- Read by JS --}}
    data-player-id="{{ $id ?? 0 }}" {{-- Read by JS --}}
    data-player-name="{{ $name ?? 'Άγνωστο' }}"
    @endif @endisset
    role="radio"
    aria-label="{{ $avatar['description'] ?? 'Φατσούλα' }}"
    aria-checked="{{ $avatarChecked ?? 'false' }}" {{-- Altered by JS --}}
    id="radio-avatar-button-{{ $tabindex ?? 0 }}"
    tabindex="{{ $tabindex ?? '-1' }}"
>
    <img
        srcset="{{ asset($avatar['public_path'] . '/' . $avatar['asset'] . '@@2x.png') }} 2x"
        src="{{ asset($avatar['public_path'] . '/' . $avatar['asset'] . '.png') }}"
        class="img-avatar img-avatar--{{ $avatar['id'] ?? 0}}"
        width="{{ $avatar['width'] ?? '100'}}"
        height="{{ $avatar['height'] ?? '100'}}"
        alt="{{ $avatar['description'] ?? 'Φατσούλα' }}"
    />
</button>
    <label
        class="btn-text label-avatar @isset($hideLabel) hidden @endisset @isset($role) @if ($role == 'player') label-player label-player--{{ $id ?? 0 }} @endif @endisset"
        for="radio-avatar-button-{{ $tabindex ?? 0 }}"
        @isset($hideLabel)hidden @endisset
        >
        {{ $name ?? 'Φατσούλα' }}
    </label>
@endif
