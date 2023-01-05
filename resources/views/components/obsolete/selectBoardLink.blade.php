<!-- /resources/views/components/selectBoardLink.blade.php -->
<div class="col board">
    <a
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        href="{{ $url ?? '#' }}" {{-- e.g. select/mode?player=1&board=2&mode=1&pawn=0 --}}
        data-tabindex="{{ $tabindex ?? '-1' }}"
        tabindex="{{ $tabindex ?? '-1' }}"
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
    </a>
</div>
