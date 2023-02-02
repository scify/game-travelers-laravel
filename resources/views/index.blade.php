<x-layoutContent
    :title="__('messages.app_name')"
    :header-background-color="'white'"
>

    <!-- section--tree-forest -->
    <section class="landing bg-green px-4">
        <div class="container-lg pt-2 px-4 pb-6 pb-lg-7">
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
                    <span>για όλα τα παιδιά!</span>
                </h1>
            </div>
            <div class="landing-call-to-action pt-4 text-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand">
                    παίξε
                </a>
            </div>
        </div>
    </section>

    <!-- section--three-blocks -->
    <section class="landing trvl-curve trvl-curve--landing-one-lg--color--green bg-light bg-lg-green px-0 mb-lg-n350">
        <div class="trvl-curve trvl-curve--landing-three-blocks--sm-lg-dash px-4">
            <div class="container-lg pt-2 px-4">
                <div class="landing-blocks landing-blocks--three">
                    <div class="d-flex flex-column flex-lg-row justify-content-around align-items-center">
                        <div class="landing-block landing-block--abstract">
                            <img class=""
                                loading="lazy"
                                srcset="{{ asset('images/landing/three-blocks/balloon@2x.png') }} 2x"
                                src="{{ asset('images/landing/three-blocks/balloon.png') }}"
                                width="264" height="398"
                                aria-role="presentation"
                                alt=""
                            >
                            <div class="landing-block--label">
                                <h2>
                                    <span>Ευκαιρία για παιχνίδι</span>
                                    <span>και χαρά</span>
                                </h2>
                            </div>
                        </div>
                        <div class="landing-block landing-block--abstract mt-6 mt-lg-0">
                            <img class=""
                                loading="lazy"
                                srcset="{{ asset('images/landing/three-blocks/unicorn@2x.png') }} 2x"
                                src="{{ asset('images/landing/three-blocks/unicorn.png') }}"
                                width="264" height="398"
                                aria-role="presentation"
                                alt=""
                            >
                            <div class="landing-block--label">
                                <h2>
                                    <span>Ενισχύει την αυτονομία</span>
                                    <span>και την αυτοπεποίθηση<span>
                                </h2>
                            </div>
                        </div>
                        <div class="landing-block landing-block--abstract mt-6 mt-lg-0">
                            <img class=""
                                loading="lazy"
                                srcset="{{ asset('images/landing/three-blocks/vase@2x.png') }} 2x"
                                src="{{ asset('images/landing/three-blocks/vase.png') }}"
                                width="264" height="398"
                                aria-role="presentation"
                                alt=""
                            >
                            <div class="landing-block--label">
                                <h2>
                                    <span>Ενισχύει τη μάθηση</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- curve--landing-one-xl -->
    <div aria-role="presentation" class="d-none d-lg-block trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--color trvl-curve--landing-one-xl--color--green bg-light">
        <div class="trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--dash">
            &nbsp;
        </div>
    </div>

    <!-- section--landing-numbers -->
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
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">
                        <h2>Για παιδιά με αναπηρία</h2>
                    </div>
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
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">
                        <h2>Για φορείς φροντίδας ΑμεΑ</h2>
                    </div>
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
                    <div class="ps-0 ps-md-4 pt-4 pt-md-0">
                        <h2>...και για όλους!</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- curve--landing-two -->
    <div aria-role="presentation" class="trvl-curve trvl-curve--landing-two trvl-curve--landing-two--color trvl-curve--landing-two--color--brown bg-light">
        &nbsp;
    </div>

    <!-- section--screenshots -->
    <section class="landing bg-brown px-4 pt-4 pb-6">
        <div class="container-lg pb-4">
            <div class="landing-screenshots justify-content-start py-6">
                <div class="screenshot px-0 px-sm-5 px-xl-0 pb-5">
                    <div class="offset-xl-0">
                        <h2>
                            <span>Προσαρμόζεται πλήρως</span>
                            <span>στις ανάγκες του παιδιού</span>
                        </h2>
                    </div>
                    <div class="pt-2 offset-xl-1">
                        <img class="img-fluid screenshot rounded"
                            loading="lazy"
                            srcset="{{ asset('images/landing/screenshots/screenshot-01@2x.png') }} 2x"
                            src="{{ asset('images/landing/screenshots/screenshot-01.png') }}"
                            width="760" height="427"
                            alt="Εικόνα στην οποία απεικονίζονται οι ρυθμίσεις του παιχνιδιού οι οποίες σχετίζονται με τον τρόπο πλοήγησης σε αυτό. Εμφανίζονται οι ρυθμίσεις για το στυλ πλοήγησης (έχει επιλεχθεί «αυτόματο»), την ταχύτητα σάρωσης (8 δευτερόλεπτα) και τη βοήθεια μετά από αριθμό λαθών (έχει επιλεχθεί 1)."
                        >
                    </div>
                </div>
                <div class="screenshot pt-6 px-0 px-sm-5 px-xl-0">
                    <div class="pt-2 offset-xl-4 text-center">
                        <h2 class="pb-2">
                            <span>Διαφορετικό προφίλ</span>
                            <span>για κάθε παίκτη</span>
                        </h2>
                        <img class="img-fluid screenshot rounded"
                            loading="lazy"
                            srcset="{{ asset('images/landing/screenshots/screenshot-02@2x.png') }} 2x"
                            src="{{ asset('images/landing/screenshots/screenshot-02.png') }}"
                            width="760" height="427"
                            alt="Εικόνα στην οποία εμφανίζεται η οθόνη επιλογής προφίλ παίκτη στο παιχνίδι. Παρουσιάζονται συνολικά 14 προφίλ, όπως επίσης και το πλήκτρο που επιτρέπει τη δημιουργία ακόμη περισσότερων."
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--section--four--blocks -->
    <section class="landing bg-light px-4 py-6 py-xl-7 ">
        <div class="landing-blocks landing-blocks--four container-xxl pt-2 px-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-around gy-6">
                <div class="col">
                    <div class="landing-block landing-block--abstract-round m-auto">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/four-blocks/puzzle@2x.png') }} 2x"
                            src="{{ asset('images/landing/four-blocks/puzzle.png') }}"
                            width="226" height="243"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <h2>
                                <span>Προσαρμόσιμη δυσκολία</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="landing-block landing-block--abstract-round m-auto">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/four-blocks/hearts@2x.png') }} 2x"
                            src="{{ asset('images/landing/four-blocks/hearts.png') }}"
                            width="226" height="243"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <h2>
                                <span>Ενσωματωμένη βοήθεια</span>
                                <span>και ενθάρρυνση</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="landing-block landing-block--abstract-round m-auto">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/four-blocks/pencil@2x.png') }} 2x"
                            src="{{ asset('images/landing/four-blocks/pencil.png') }}"
                            width="226" height="243"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <h2>
                                <span>Πολλοί τρόποι χειρισμού</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="landing-block landing-block--abstract-round m-auto">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/four-blocks/rainbow@2x.png') }} 2x"
                            src="{{ asset('images/landing/four-blocks/rainbow.png') }}"
                            width="226" height="243"
                            aria-role="presentation"
                            alt=""
                        >
                        <div class="landing-block--label">
                            <h2>
                                <span>Χωρίς ανάγκη επίβλεψης</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- curve--landing-two -->
    <div aria-role="presentation" class="trvl-curve trvl-curve--landing-two trvl-curve--landing-two--color trvl-curve--landing-two--color--brown bg-light">
        &nbsp;
    </div>

    <!-- section--laptop -->
    <section class="landing bg-brown px-4 pt-4 pb-5 pt-lg-6 pb-lg-7">
        <picture>
            <source type="image/webp" srcset="{{ asset('images/landing/laptop/laptop.webp') }}">
            <source type="image/png" srcset="{{ asset('images/landing/laptop/laptop.png') }}">
            <img
                class="img-fluid mx-auto d-block"
                loading="lazy"
                src="{{ asset('images/landing/laptop/laptop.png') }}"
                width="1042" height="765"
                alt="Εικαστική σύνθεση στην οποία απεικονίζονται μερικοί από τους ήρωες του παιχνιδιού μπροστά από την οθόνη ενός φορητού υπολογιστή. Στην οθόνη του εμφανίζεται μια από τις πίστες του παιχνιδιού «Ταξιδιώτες»."
            >
          </picture>
    </section>


</x-layout>
