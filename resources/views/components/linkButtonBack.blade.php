<!-- /views/components/buttonBack.blade.php -->
<a
    class="btn kicon kicon-{{ $align ?? 'left' }} kicon-chevron-left"
    aria-label="{{ $label ?? 'Επιστροφή στο προηγούμενο μενού' }}"
    title="{{ $label ?? 'Επιστροφή στο προηγούμενο μενού' }}"
    id="kIconChevronLeft"
    href="{{ $url ?? '/' }}"
>
    <svg width="25" height="25" fill="currentColor" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M 5.053257 11.996493 L 14.021988 2.925573 C 14.682353 2.255144 14.680804 1.168987 14.018118 0.500107 C 13.701865 0.179222 13.269978 -0.001183 12.819444 -0.000601 C 12.36891 -1.9e-05 11.93749 0.181505 11.622068 0.503202 L 1.461895 10.77718 C 0.823685 11.428683 0.802324 12.464218 1.413122 13.141487 L 11.61665 23.495203 C 11.931967 23.817005 12.363328 23.998667 12.813862 23.999395 C 13.264396 24.000124 13.696342 23.819855 14.012699 23.499073 C 14.675385 22.830193 14.676934 21.744036 14.016569 21.073608 Z"/>
    </svg>
</a>

