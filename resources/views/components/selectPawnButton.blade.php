<!-- /resources/views/components/selectPawnButton.blade.php -->
@php
    if ($pawnId == 12) { // @todo: make it a 6 and test.
        $selected_by_other_player = true;
    }
    if (!isset($board)) {
        $board = 1;
    }
    if (!isset($playerOnePawnId)) {
        $playerOnePawnId = 0;
    } else {
        if (intval($pawnId) == intval($playerOnePawnId)) {
            $selected_by_other_player = true;
        }
    }
@endphp
<div class="col-6 col-sm-4 col-xl-3 pawn">
    <button class="btn btn-pawn pawn-button pawn-button-{{ $pawnId }} @isset($comingsoon)disabled @endisset @isset($selected_by_other_player)selected-by-other-player @endisset "
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="pawn"
        value="{{ $pawnId ?? '0' }}"
        type="submit"
        label="{{ $title ?? 'Πιόνι' }}"
        @isset($selected_by_other_player)
            disabled
        @endisset
    >
        <img
            class="pawn-img"
            srcset="{{ asset('images/pawns/' . $board . '/' . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/pawns/' . $board . '/' . $asset . '.png') }}"
            width="136" height="212"
            alt="{{ $alt ?? 'Προεπισκόπηση πιονιού' }}"
        />
        <span class="pawn-label">{{ $name ?? 'Πιόνι' }}</span>
    </button>
</div>
