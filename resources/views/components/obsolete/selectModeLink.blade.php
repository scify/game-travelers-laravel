<!-- /resources/views/components/selectModeLink.blade.php -->
<div class="col board">
    <a
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        href="{{ $url ?? '#' }}" {{-- e.g. select/mode?player=1&board=2&mode=1&pawn=0 --}}
        data-tabindex="{{ $tabindex ?? '-1' }}"
        tabindex="{{ $tabindex ?? '-1' }}"
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
    </a>
</div>
