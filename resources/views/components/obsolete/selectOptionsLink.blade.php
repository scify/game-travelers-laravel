<!-- /resources/views/components/selectOptionsLink.blade.php -->
<div class="col board">
    <a
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        href="{{ $url ?? '#' }}" {{-- e.g. select/mode?player=1&board=2&mode=1&pawn=0 --}}
        data-tabindex="{{ $tabindex ?? '-1' }}"
        tabindex="{{ $tabindex ?? '-1' }}"
    >
        <span class="board-img blank"></span>
        <span class="board-label blank">{{ $title ?? 'Επιλογή' }}</span>
    </a>
</div>
