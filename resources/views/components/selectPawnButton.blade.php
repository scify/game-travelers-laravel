<!-- /resources/views/components/selectPawnButton.blade.php -->
@php
    if (!isset($board)) {
        $board = 1;
    }
    if (!isset($asset)) {
        $asset = "pawn-iasonas";
    }
@endphp
<div class="col-6 col-md-4 col-xxl-3 pawn">
    <button
        class="btn btn-pawn pawn-button @isset($comingsoon)disabled @endisset"
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="pawn"
        value="{{ $pawn ?? '0' }}"
        type="submit"
        label="{{ $title ?? 'Πιόνι' }}"
        @isset($comingsoon)
        {{-- For not yet available pawns add attribute 'disabled': --}}
        disabled
        @endisset
    >
        <img
            class="pawn-img"
            srcset="{{ asset('images/pawns/' . $board . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/pawns/' . $board . '/' . $asset . '.png') }}"
            width="136" height="212"
            alt="{{ $alt ?? 'Προεπισκόπηση πίστας' }}"
        />
        <span class="pawn-label">{{ $title ?? 'Πίστα' }}</span>
</button>
</div>
