<x-layoutContent
    :title="__('messages.app_name')"
    :header-background-color="'white'"
>
    <section class="landing bg-green px-4">
        <div class="container-lg pt-2 px-4 pb-5">
            <div class="landing-trees d-flex justify-content-center">
                <img class="img-xl"
                    loading="lazy"
                    srcset="{{ asset('images/landing/trees/trees-xl@2x.png') }} 2x"
                    src="{{ asset('images/landing/trees/trees-xl.png') }}"
                    width="928" height="250"
                    aria-role="presentation"
                    alt=""
                    style="display: none;"
                >
                <img class="img-lg"
                    loading="lazy"
                    srcset="{{ asset('images/landing/trees/trees-lg@2x.png') }} 2x"
                    src="{{ asset('images/landing/trees/trees-lg.png') }}"
                    width="628" height="236"
                    aria-role="presentation"
                    alt=""
                    style="display: none;"
                >
                <img class="img-sm"
                    loading="lazy"
                    srcset="{{ asset('images/landing/trees/tree@2x.png') }} 2x"
                    src="{{ asset('images/landing/trees/tree.png') }}"
                    width="124" height="191"
                    aria-role="presentation"
                    alt=""
                >
            </div>
            <div class="landing-title pt-4">
                <h1>
                    <span>Ταξίδι στο παιχνίδι,</span>
                    <span>για όλα τα παιδιά!</span></h1>
            </div>
            <div class="landing-call-to-action pt-4 text-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand" tabindex="1">
                    παίξε
                </a>
            </div>
        </div>
    </section>

    {{--  @todo replace with proper curve when exported | hidden >= lg
        MISSING CURVE for <LG viewports, there's nothing to see here atm.
        --}}
    {{--
    <div aria-role="presentation" class="d-lg-none trvl-curve trvl-curve--header trvl-curve--header--color trvl-curve--header--color--white bg-green">
        <div class="trvl-curve trvl-curve--header trvl-curve--header--dash">
            &nbsp;
        </div>
    </div>
    --}}

    <section class="landing bg-light bg-lg-green px-4 pt-6 mb-lg-n350">
        <div class="container-lg pt-2 px-4">
            <div class="landing-blocks landing-blocks--three">
                <div class="d-flex flex-column flex-lg-row justify-content-around align-items-center">
                    <div class="landing-block landing-block--abstract">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/blocks/balloon@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks/balloon.png') }}"
                            width="264" height="398"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <span>Ευκαιρία για παιχνίδι</span>
                            <span>και χαρά</span>
                        </div>
                    </div>
                    <div class="landing-block landing-block--abstract mt-6 mt-lg-0">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/blocks/unicorn@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks/unicorn.png') }}"
                            width="264" height="398"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <span>Ενισχύει την αυτονομία</span>
                            <span>και την αυτοπεποίθηση<span>
                        </div>
                    </div>
                    <div class="landing-block landing-block--abstract mt-6 mt-lg-0">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/blocks/vase@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks/vase.png') }}"
                            width="264" height="398"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <span>Ενισχύει τη μάθηση</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--  @todo replace with proper curve when exported | hidden < lg
            MISSING PROPER CURVE FOR >=LG SCREENS (this stands as a replacement)
    --}}
    <div aria-role="presentation" class="d-none d-lg-block trvl-curve trvl-curve--landing-one trvl-curve--landing-one--color trvl-curve--landing-one--color--green bg-light">
        <div class="trvl-curve trvl-curve--landing-one trvl-curve--landing-one--dash">
            &nbsp;
        </div>
    </div>

    <section class="landing bg-light px-4 pt-0 pt-lg-4 pt-lg-6">
        <div class="container-lg pt-2">
            <div class="landing-numbers py-1 py-md-6 d-flex flex-column justify-content-around ">
                <div class="landing-numbers--one d-flex flex-column flex-lg-row align-items-center">
                    <img class=""
                        loading="lazy"
                        srcset="{{ asset('images/landing/numbers/one@2x.png') }} 2x"
                        src="{{ asset('images/landing/numbers/one.png') }}"
                        width="168" height="162"
                        aria-role="presentation"
                        alt=""
                    >
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">Για παιδιά με αναπηρία</div>
                </div>
                <div class="landing-numbers--two d-flex flex-column flex-lg-row align-items-center" >
                    <img class=""
                        loading="lazy"
                        srcset="{{ asset('images/landing/numbers/two@2x.png') }} 2x"
                        src="{{ asset('images/landing/numbers/two.png') }}"
                        width="168" height="162"
                        aria-role="presentation"
                        alt=""
                    >
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">Για φορείς φροντίδας ΑμεΑ</div>
                </div>
                <div class="landing-numbers--three d-flex flex-column flex-lg-row align-items-center ">
                    <img class=""
                        loading="lazy"
                        srcset="{{ asset('images/landing/numbers/three@2x.png') }} 2x"
                        src="{{ asset('images/landing/numbers/three.png') }}"
                        width="168" height="162"
                        aria-role="presentation"
                        alt=""
                    >
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">...και για όλους!</div>
                </div>
            </div>
        </div>
    </section>

</x-layout>
