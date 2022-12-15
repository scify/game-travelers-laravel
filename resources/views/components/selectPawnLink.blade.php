<!-- /resources/views/components/selectPawnLink.blade.php -->
<div class="col-6 col-md-4 col-xxl-3 pawn">
    <a
        class="btn btn-pawn pawn-button @isset($comingsoon)disabled @endisset"
        href="{{ $url ?? '#' }}" {{-- e.g. select/mode?player=1&board=2&mode=1&pawn=0 --}}
        data-tabindex="{{ $tabindex ?? '-1' }}"
        tabindex="{{ $tabindex ?? '-1' }}"
    >
        <img
            class="pawn-img"
            srcset="{{ asset('images/pawns/' . $asset . '@@2x.png') }} 2x"
            src="{{ asset('images/pawns/' . $asset . '.png') }}"
            width="136" height="212"
            alt="{{ $alt ?? 'Προεπισκόπηση πίστας' }}"
        />
        <span class="pawn-label">{{ $title ?? 'Πίστα' }}</span>
    </a>
</div>
