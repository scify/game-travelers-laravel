<!-- /resources/views/components/switcher.blade.php -->
@php
/**
 * Switcher Component
 *
 * The Switcher Component requires an array with all the control options
 * that the user has selected. If $switcher is not set, then Switcher
 * defaults to the following configuration, which should also set the example
 * of what the expected array returned from the Controller should be like. Note
 * that Switcher's functionality depends on using lang.js for translated strings
 * and keys.js which is assummed that are used site-wide. The $switcher array is
 * also JSON encoded & pushed to window in order to be available on JavaScript.
 *
 * @see ../../../app/Http/Controllers/SetupGameController.php
 */
// Define a default switcher if none set.
 if (!isset($switcher)) {
    $switcher = [
        "controlMode" => 1, // 1: Automatic, 2: Manual
        "scanningSpeed" => 2, // in seconds
        "automaticSelectionButton" => "Enter",
        "manualSelectionButton" => "Enter",
        "manualNavigationButton" => "Space",
    ];
}
// Support music & audio on page load if audio is defined.
if (isset($switcher) && is_array($switcher)) {
    if (isset($audio) && is_string($audio)) {
        $switcher['audio'] = trim($audio);
    }
    if (isset($music) && is_string($music)) {
        $switcher['music'] = trim($music);
    }
}
@endphp
<!-- Switcher Help Modal -->
<div
    id="switcherModal"
    class="modal fade"
    aria-hidden="true"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    data-bs-focus="false"
    >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Πλήκτρα πλοήγησης</h4>
                @if($switcher['controlMode']==1)
                    <p>{{ __("messages.switcher.help_automatic") }}</p>
                    <p>
                        {{ __("messages.switcher.help_automatic_button_select") }}
                        <kbd>{{ $switcher['automaticSelectionButton'] }}</kbd>.
                    </p>
                @else
                    <p>
                        {{ __("messages.switcher.help_manual_button_navigate") }}
                        <kbd>{{ $switcher['manualNavigationButton'] }}</kbd>.
                    </p>
                    <p>
                        {{ __("messages.switcher.help_manual_button_select") }}
                        <kbd>{{ $switcher['manualSelectionButton'] }}</kbd>.
                    </p>
                @endif
                <h4>Βοηθητικά πλήκτρα</h4>
                    Αυξομείωση έντασης μουσικής με <kbd>+</kbd> και <kbd>-</kbd>.
            </div>
            <div class="modal-footer">
                @if($switcher['controlMode']==1)
                    <button
                        id="switcherModalBreak"
                        type="button"
                        class="btn btn-danger"
                        data-bs-dismiss="modal"
                        data-switcher-dismiss=""
                         onclick="clearInterval(13);return false"
                    >
                        {{ __("messages.switcher.break") }}
                    </button>
                @endif
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    {{ __("messages.switcher.continue") }}
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Switcher JS -->
<script>
    window.Switcher = {{ Js::from($switcher)}};
</script>
<script src="{{ mix('js/functions/switcher.js') }}" defer></script>
