<!-- /views/components/buttonForward.blade.php -->
<button
    class="btn kicon kicon-{{ $align ?? 'left' }} kicon-chevron-right"
    aria-label="{{ $label ?? 'Επιστροφή στο προηγούμενο μενού' }}"
    title="{{ $label ?? 'Επιστροφή στο προηγούμενο μενού' }}"
    id="kIconChevronForwawrd"
    type="submit"
    name="submit"
    value="next"
>
    <svg width="25" height="25" fill="currentColor" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M 19.431704 11.996493 L 10.462973 2.925573 C 9.802608 2.255144 9.804156 1.168987 10.466843 0.500107 C 10.783094 0.179222 11.214983 -0.001183 11.665517 -0.000601 C 12.116051 -1.9e-05 12.547471 0.181505 12.862892 0.503202 L 23.023066 10.77718 C 23.661274 11.428683 23.682636 12.464218 23.071838 13.141487 L 12.868311 23.495203 C 12.552994 23.817005 12.121633 23.998667 11.671099 23.999395 C 11.220565 24.000124 10.788617 23.819855 10.472261 23.499073 C 9.809575 22.830193 9.808026 21.744036 10.468391 21.073608 Z"/>
    </svg>
</button>
