<!-- /resources/views/layout/footer.blade.php -->
<footer class="container-xxl ps-0 ps-sm-4 pb-5 pb-sm-0 trvl-footer">
    <div class="d-flex align-items-end justify-content-center justify-content-md-end"> {{-- float-start --}}
        <div class="scify align-center">
            <a href="http://www.scify.org" target="_blank">
                <img
                    srcset="{{ asset('images/logos/text_scify@3x.png') }} 3x"
                    srcset="{{ asset('images/logos/text_scify@2x.png') }} 2x"
                    src="{{ asset('images/logos/text_scify.png') }}"
                    width="131" height="40"
                    alt="{{ __("messages.game_developed_by") }}"
                >
            </a>
        </div>
        <div class="sponsor align-center ms-4">
            <a href="https://www.lafarge.gr/omilos-iraklis" target="_blank">
                <img
                    srcset="{{ asset('images/logos/text_iraklis@3x.png') }} 3x"
                    srcset="{{ asset('images/logos/text_iraklis@2x.png') }} 2x"
                    src="{{ asset('images/logos/text_iraklis.png') }}"
                    width="179" height="21"
                    alt="{{ __("messages.game_sponsored_by") }}"
                >
            </a>
        </div>
    </div>
</footer>
