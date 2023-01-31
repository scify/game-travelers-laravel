<!-- /resources/views/layout/landing/footer.blade.php -->
<div class="trvl-landing-footer-curve bg-light" aria-role="decoration">
    <div class="trvl-landing-footer-curve--dash">
        &nbsp;
    </div>
</div>
<footer class="trvl-landing-footer bg-green">
    <div class="container-xxl p-4">

        <div class="d-flex flex-column flex-sm-row pt-5">

            <div class="trvl-landing-footer--links flex-grow-1">
                <ul>
                    <li>Επικοινώνησε μαζί μας</li>
                    <li>Cookies Policy</li>
                    <li>
                        <a href="{{ route('privacy-policy') }}">
                            {{ __("messages.privacy_policy")}}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="trvl-landing-footer--social pt-5 pt-sm-0">
                <div class="social-container">
                    <u>Ακολούθησέ μας</u>
                    <ul class="social-links">
                        <li class="social-links--linkedin">
                            <a href="https://linkedin.com/company/scify-not-for-profit-company" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/linkedin@2x.png') }} 2x"
                                    src="{{ asset('images/landing/linkedin.png') }}"
                                    width="36" height="36"
                                    alt="Connect with us on LinkedIn"
                                >
                            </a>
                        </li>
                        <li class="social-links--twitter">
                            <a href="https://twitter.com/scify_org" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/twitter@2x.png') }} 2x"
                                    src="{{ asset('images/landing/twitter.png') }}"
                                    width="36" height="30"
                                    alt="Follow us on Twitter"
                                >
                            </a>
                        </li>
                        <li class="social-links--facebook">
                            <a href="https://facebook.com/SciFY.org" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/facebook@2x.png') }} 2x"
                                    src="{{ asset('images/landing/facebook.png') }}"
                                    width="35" height="35"
                                    alt="Find us on Facebook"
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="d-flex pt-5">

            <div class="scify">
                <a href="http://www.scify.org" target="_blank">
                    <img
                        srcset="{{ asset('images/SciFY@2x.png') }} 2x"
                        src="{{ asset('images/SciFY.png') }}"
                        width="105" height="53"
                        alt="Created by SciFY"
                    >
                </a>
            </div>

        </div>

    </div>
</footer>
