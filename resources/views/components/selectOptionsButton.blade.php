<!-- /resources/views/components/selectOptionsButton.blade.php -->
<div class="col board">
    <button
        class="btn btn-board board-button @isset($comingsoon)disabled @endisset"
        tabindex="{{ $tabindex ?? '-1' }}"
        data-tabindex="{{ $tabindex ?? '-1' }}"
        name="option"
        value="{{ $optionId ?? '0' }}"
        type="submit"
        label="{{ $title ?? 'Επιλογή' }}"
        @isset($comingsoon)
        {{-- For not yet available options add attribute 'disabled': --}}
        disabled
        @endisset
    >
        <span class="board-img blank"></span>
        <span class="board-label blank">{{ $title ?? 'Επιλογή' }}</span>
    </button>
</div>
