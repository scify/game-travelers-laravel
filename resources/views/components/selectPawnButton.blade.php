<!-- /resources/views/components/selectPawnButton.blade.php -->
@php
    // Default to Board #1 if no board was set:
    if (!isset($board)) {
        $board = 1;
    }
    // Pawns #6  & #7 (Zoumpoulia & Vrasidas) have no variations on other boards
    if ($pawnId >= 6) {
        $board = 1;
    }
    // Other player's pawn selection (if any) is highlighted & disabled.
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
        label="{{ $title ?? __('messages.pawn') }}"
        @isset($selected_by_other_player)
            disabled
        @endisset
    >
        <img
            class="pawn-img"
            srcset="{{ asset('images/pawns/board_' . $board . '/' . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/pawns/board_' . $board . '/' . $asset . '.png') }}"
            width="136" height="212"
            alt="{{ $alt ?? __('messages.pawn_preview') }}"
        />
        @isset($selected_by_other_player)
            <span class="pawn-your-choice">{{ __('messages.pawn_your_choice') }}</span>
        @endisset
        <span class="pawn-label">{{ $name ?? __('messages.pawn') }}</span>
    </button>
</div>
