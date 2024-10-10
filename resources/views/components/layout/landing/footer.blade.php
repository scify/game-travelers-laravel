<!-- /resources/views/layout/landing/footer.blade.php -->
<div aria-hidden="true" class="trvl-curve trvl-curve--footer trvl-curve--footer--color trvl-curve--footer--color--green bg-light">
    <div class="trvl-curve trvl-curve--footer trvl-curve--footer--dash">
        &nbsp;
    </div>
</div>
<footer class="trvl-landing-footer bg-green">
    <div class="container-xxl p-4 px-sm-5 px-lg-4">

        <div class="trvl-landing-footer--row--1 d-flex flex-column flex-sm-row pt-2 pt-sm-5">

            <div class="trvl-landing-footer--links flex-grow-1">
                <ul>
                    <li><a href="http://www.scify.gr/site/el/contact" target="_blank">Επικοινώνησε μαζί μας</a></li>
                    <li><a href="{{ route('credits') }}">Συντελεστές</a></li>
                    <li>
                        <a href="{{ route('privacy-policy') }}">
                            {{ __("messages.privacy_policy")}}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="trvl-landing-footer--social pt-2 pt-sm-0">
                <div class="social-container">
                    Ακολούθησέ μας
                    <ul class="social-links">
                        <li class="social-links--linkedin">
                            <a href="https://linkedin.com/company/scify-not-for-profit-company" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/social/linkedin@2x.png') }} 2x"
                                    src="{{ asset('images/landing/social/linkedin.png') }}"
                                    width="36" height="36"
                                    alt="Connect with us on LinkedIn"
                                >
                            </a>
                        </li>
                        <li class="social-links--twitter">
                            <a href="https://twitter.com/scify_org" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/social/twitter@2x.png') }} 2x"
                                    src="{{ asset('images/landing/social/twitter.png') }}"
                                    width="36" height="30"
                                    alt="Follow us on Twitter"
                                >
                            </a>
                        </li>
                        <li class="social-links--facebook">
                            <a href="https://facebook.com/SciFY.org" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/social/facebook@2x.png') }} 2x"
                                    src="{{ asset('images/landing/social/facebook.png') }}"
                                    width="35" height="35"
                                    alt="Find us on Facebook"
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="trvl-landing-footer--row--2 pt-3 pt-sm-2 footer-credits">

            <div class="scify text-center">
                <span>Ανάπτυξη</span>
                <a href="https://www.scify.gr">
                    <img
                        class="img-fluid logo logo-h53 scify"
                        srcset="{{ asset('images/logos/53h_scify@3x.png') }} 3x, asset('images/logos/53h_scify@2x.png') }} 2x"
                        src="{{ asset('images/logos/53h_scify.png') }}"
                        width="40" height="53"
                        alt="SciFY - Science for You"
                    >
                </a>
            </div>
            <div class="sponsor text-center">
                <span>Ευγενική χορηγία</span>
                <a href="https://www.lafarge.gr">
                    <img
                        class="img-fluid logo logo-h53 sponsor"
                        srcset="{{ asset('images/logos/53h_heracles@3x.png') }} 3x, {{ asset('images/logos/53h_heracles@2x.png') }} 2x"
                        src="{{ asset('images/logos/53h_heracles.png') }}"
                        width="297" height="53"
                        alt="Ηρακλής - Όμιλος εταιριών"
                    >
                </a>
            </div>

        </div>

    </div>
</footer>
