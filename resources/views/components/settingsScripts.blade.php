<!-- /resources/views/components/settings.blade.php -->
@php
/**
 * Switcher Lite Component for Settings
 *
 * Allows the playback & volume-control of music (for now).
 */
// Define a default switcher if none set.
 if (!isset($switcher)) {
    $switcher = [
    ];
}
// Support music on page load if music is defined.
if (isset($switcher) && is_array($switcher)) {
    if (isset($music) && is_string($music)) {
        $switcher['music'] = trim($music);
    }
    if (isset($musicVolume) && is_numeric($musicVolume)) {
        $switcher['musicVolume'] = floatval($musicVolume);
        if ($musicVolume >= 0 && $musicVolume <= 1) {
            $switcher['musicVolume'] = $musicVolume;
        }
    } else {
        $switcher['musicVolume'] = 0.2;
    }
}
@endphp
<script>
    window.Switcher = {{ Js::from($switcher)}};
</script>
<script src="{{ mix('js/functions/settings.js') }}" defer></script>
