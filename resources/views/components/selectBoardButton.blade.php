<!-- /resources/views/components/selectBoardButton.blade.php -->
<div class="col board">
    <button
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="board"
        value="{{ $boardId ?? '0' }}"
        type="submit"
        label="{{ $name ?? __("messages.board") }}"
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
            alt="{{ $alt ?? __("messages.board_preview") }}"
        />
        <span class="board-label">{{ $name ?? 'Πίστα' }}</span>
        @isset($comingsoon)
        <span class="coming-soon-wrapper">
            <span class="coming-soon">
                <strong>{{ __("messages.coming_soon_teaser")}}!</strong>
            </span>
        </span>
        @endisset
    </button>
</div>
