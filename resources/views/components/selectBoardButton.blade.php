<!-- /resources/views/components/selectBoardButton.blade.php -->
<div class="col board">
    <button
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="board"
        value="{{ $board ?? '0' }}"
        type="submit"
        label="{{ $title ?? 'Πίστα' }}"
        @isset($comingsoon)
        {{-- For not yet available boards add atribute 'disabled': --}}
        disabled
        @endisset
    >
        <img
            class="board-img"
            srcset="{{ asset('images/boards/' . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/boards/' . $asset . '.png') }}"
            width="352" height="244"
            alt="{{ $alt ?? 'Προεπισκόπηση πίστας' }}"
        />
        <span class="board-label">{{ $title ?? 'Πίστα' }}</span>
        @isset($comingsoon)
        <span class="coming-soon"><strong>ΠΡΟΣΕΧΩΣ!</strong></span>
        @endisset
    </button>
</div>
