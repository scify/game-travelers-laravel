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
if (!isset($switcher)) {
    $switcher = [
        'controlMode' => 1, // 1: Automatic, 2: Manual
        'scanningSpeed' => 2, // in seconds
        'automaticSelectionButton' => 'Space',
        'manualSelectionButton' => 'Space',
        'manualNavigationButton' => 'Enter',
    ];
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        {{ __("messages.switcher.continue") }}
                    </button>
                @else
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        {{ __("messages.switcher.continue") }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Switcher JS -->
<script>
    window.Switcher = {{ Js::from($switcher)}};
</script>
<script src="{{ mix('js/functions/switcher.js') }}" defer></script>
