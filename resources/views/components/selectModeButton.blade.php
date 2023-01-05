<!-- /resources/views/components/selectModeButton.blade.php -->
<div class="col board">
    <button
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="mode"
        value="{{ $mode ?? '0' }}"
        type="submit"
        label="{{ $title ?? 'Τύπος παιχνιδιού' }}"
        @isset($comingsoon)
        {{-- For not yet available boards add atribute 'disabled': --}}
        disabled
        @endisset
    >
        <img
            class="board-img"
            srcset="{{ asset('images/modes/' . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/modes/' . $asset . '.png') }}"
            width="352" height="244"
            alt="{{ $alt ?? 'Προεπισκόπηση τύπου παιχνιδιού' }}"
        />
        <span class="board-label">{{ $title ?? 'Τύπος παιχνιδιού' }}</span>
        @isset($comingsoon)
        <span class="coming-soon"><strong>ΠΡΟΣΕΧΩΣ!</strong></span>
        @endisset
    </button>
</div>
