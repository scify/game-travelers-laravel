<!-- /resources/views/layout/footer.blade.php -->
<footer class="container-xxl ps-0 ps-sm-4 pb-5 pb-sm-0 trvl-footer">
    <div class="d-flex justify-content-center flex-column flex-sm-row justify-content-sm-start"> {{-- float-start --}}
        <div class="scify d-flex flex-row align-items-end gap-2 m-auto m-sm-0">
            <span class="d-block small lh-1">Αναπτύχθηκε από</span>
            <a href="https://www.scify.gr" class="d-block">
                <img
                    class="img-fluid logo logo-h53"
                    srcset="{{ asset('images/logos/53h_scify@3x.png') }} 3x"
                    srcset="{{ asset('images/logos/53h_scify@2x.png') }} 2x"
                    src="{{ asset('images/logos/53h_scify.png') }}"
                    width="32" height="40"
                    alt="{{ __("messages.game_developed_by") }}"
                >
            </a>
        </div>
        <div class="sponsor  d-flex flex-row align-items-end gap-2 m-auto my-3 m-sm-0 my-sm-0 ms-sm-4">
            <span class="d-block small lh-1">Ευγενική χορηγία</span>
            <a href="https://www.lafarge.gr" class="d-block">
                <img
                    class="img-fluid logo logo-h53"
                    srcset="{{ asset('images/logos/53h_heracles@3x.png') }} 3x"
                    srcset="{{ asset('images/logos/53h_heracles@2x.png') }} 2x"
                    src="{{ asset('images/logos/53h_heracles.png') }}"
                    width="123" height="22"
                    alt="{{ __("messages.game_sponsored_by") }}"
                >
            </a>
        </div>
    </div>
</footer>
