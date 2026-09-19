{{-- /resources/views/components/layout/landing/footer.blade.php --}}
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
                    <li>
                        <a href="https://scify.org/#footer-form" target="_blank" rel="noopener">
                            {{ __('messages.contact_us') }}
                        </a>
                    </li>
                    <li><a href="{{ route('credits') }}">{{ __('messages.credits') }}</a></li>
                    <li>
                        <a href="https://go.scify.org/game-travellers-privacy-policy-gr" target="_blank" rel="noopener">
                            {{ __('messages.privacy_policy') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://go.scify.org/game-travellers-cookies-policy-gr" target="_blank" rel="noopener">
                            {{ __('messages.cookies_policy') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://go.scify.org/game-travellers-terms-of-use-gr" target="_blank" rel="noopener">
                            {{ __('messages.terms_of_use') }}
                        </a>
                    </li>
                    <li>
                        <a href="#consent-settings">
                            {{ __('cookies_consent::messages.cookies_settings') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="trvl-landing-footer--social pt-2 pt-sm-0">
                <div class="social-container">
                    {{ __('messages.follow_us') }}
                    <ul class="social-links">
                        <li class="social-links--linkedin">
                            <a href="https://linkedin.com/company/scify-not-for-profit-company" target="_blank" rel="noopener noreferrer">
                                <img
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/social/linkedin@2x.png') }} 2x"
                                    src="{{ asset('images/landing/social/linkedin.png') }}"
                                    width="36" height="36"
                                    alt="{{ __('messages.follow_us_on', ['network' => 'LinkedIn']) }}"
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
                                    alt="{{ __('messages.follow_us_on', ['network' => 'Twitter']) }}"
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
                                    alt="{{ __('messages.follow_us_on', ['network' => 'Facebook']) }}"
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="trvl-landing-footer--row--2 pt-3 pt-sm-2 footer-credits">

            <div class="scify text-center">
                <span>{{ __('messages.development') }}</span>
                <a href="https://scify.org">
                    <img
                        class="img-fluid mx-auto logo logo-h53 scify"
                        srcset="{{ asset('images/logos/53h_scify@3x.png') }} 3x, {{ asset('images/logos/53h_scify@2x.png') }} 2x"
                        src="{{ asset('images/logos/53h_scify.png') }}"
                        width="40" height="53"
                        alt="{{ __('messages.developer_logo_alt') }}"
                    >
                </a>
            </div>
            <div class="sponsor text-center">
                <span>{{ __('messages.sponsored_by') }}</span>
                <a href="https://www.lafarge.gr">
                    <img
                        class="img-fluid mx-auto logo logo-h53 sponsor"
                        srcset="{{ asset('images/logos/53h_heracles@3x.png') }} 3x, {{ asset('images/logos/53h_heracles@2x.png') }} 2x"
                        src="{{ asset('images/logos/53h_heracles.png') }}"
                        width="297" height="53"
                        alt="{{ __('messages.sponsor_logo_alt') }}"
                    >
                </a>
            </div>

        </div>

    </div>
</footer>
