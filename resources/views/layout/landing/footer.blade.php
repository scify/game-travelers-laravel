<!-- /resources/views/layout/landing/footer.blade.php -->
<div aria-role="presentation" class="trvl-curve trvl-curve--footer trvl-curve--footer--color trvl-curve--footer--color--green bg-light">
    <div class="trvl-curve trvl-curve--footer trvl-curve--footer--dash">
        &nbsp;
    </div>
</div>
<footer class="trvl-landing-footer bg-green">
    <div class="container-xxl p-4 px-sm-5 px-lg-4">

        <div class="trvl-landing-footer--row--1 d-flex flex-column flex-sm-row pt-2 pt-sm-5">

            <div class="trvl-landing-footer--links flex-grow-1">
                <ul>
                    <li><a href="#{{-- @todo --}}">Επικοινώνησε μαζί μας</a></li>
                    <li class="d-none"><a href="#{{-- @todo --}}">Cookies Policy</a></li>
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
        <div class="trvl-landing-footer--row--2 d-flex pt-0 pt-sm-5 flex-row-reverse flex-sm-row">

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
