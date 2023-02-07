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
            <div class="landing-call pt-4 text-center">
                <h1 class="action">
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
    <section class="landing bg-light px-4 pt-6 pb-4 pt-xl-7 pb-xl-6">
        <div class="landing-blocks landing-blocks--four container-xxl py-2 px-4">
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
                class="img-fluid mx-auto d-block px-sm-5 px-xxl-0"
                loading="lazy"
                src="{{ asset('images/landing/laptop/laptop.png') }}"
                width="1042" height="765"
                alt="Εικαστική σύνθεση στην οποία απεικονίζονται μερικοί από τους χαρακτήρες του παιχνιδιού μπροστά από την οθόνη ενός φορητού υπολογιστή. Στην οθόνη του εμφανίζεται μια από τις πίστες του παιχνιδιού «Ταξιδιώτες»."
            >
          </picture>
    </section>

    <!-- section--portraits -->
    <section class="landing bg-brown px-4 pt-4 pb-5 pt-lg-6 pb-lg-7">
        <picture>
            <source type="image/webp" srcset="{{ asset('images/landing/portraits/portraits.webp') }}">
            <source type="image/png" srcset="{{ asset('images/landing/portraits/portraits.png') }}">
            <img
                class="img-fluid mx-auto d-block px-3 px-sm-6 px-xxl-3"
                loading="lazy"
                src="{{ asset('images/landing/portraits/portraits.png') }}"
                width="1168" height="863"
                alt="Εικαστική σύνθεση στην οποία απεικονίζονται πορτρέτα με κάποιους από τους χαρακτήρες του παιχνιδιού «Ταξιδιώτες»."
            >
          </picture>
    </section>

    <!-- floating-dash -->
    <div class="floating-dash-container position-relative bg-light mb-2">
        <div class="floating-dash position-relative" aria-role="presentation">
            &nbsp;
        </div>

        <!-- section--partners -->
        <section class="landing bg-light px-4 pt-4 pb-4 pt-lg-6">
            <div class="landing-partners container-lg px-0 px-xl-5 px-xxl-6">
                <div class="px-2 px-lg-6 px-xl-6 pb-5 text-center">
                    Το παιχνίδι αναπτύχθηκε σε στενή συνεργασία με ειδικούς παιδαγωγούς
                    από φορείς εγνωσμένου κύρους: η ΕΛΕΠΑΠ, το <span class="text-nowrap">ΚΑΣΠ Χατζηπατέρειο</span>, το <span class="text-nowrap">Ειδικό Σχολείο</span> <span class="text-nowrap">Αγριάς Μαγνησίας</span>
                    και το Κέντρο Κοινωνικής Πρόνοιας <span class="text-nowrap">Περιφέρειας Αττικής</span>.
                </div>
                <div class="landing-partners--logos container py-5">
                    <div class="row row-cols-1 row-cols-sm-3 gy-6 justify-content-around text-center">
                        <div>
                            <a href="https://elepap.gr" target="_blank">
                                <img class="img-fluid"
                                    loading="lazy"
                                    src="{{ asset('images/landing/partners/elepap.png') }}"
                                    width="203" height="90"
                                    alt="ΕΛΕΠΑΠ"
                                >
                            </a>
                        </div>
                        <div>
                            <a href="https://kasp.gr" target="_blank">
                                <img class="img-fluid"
                                    loading="lazy"
                                    src="{{ asset('images/landing/partners/kasp.png') }}"
                                    width="78" height="90"
                                    alt="«Χατζηπατέρειο» Κέντρο Αποκατάστασης & Στήριξης Παιδιού (Κ.Α.Σ.Π.)"
                                >
                            </a>
                        </div>
                        <div >
                            <a href="https://www.kkppa.gr" target="_blank">
                                <img class="img-fluid"
                                    loading="lazy"
                                    src="{{ asset('images/landing/partners/kkppa.png') }}"
                                    width="298" height="90"
                                    alt="Κέντρο Κοινωνικής Πρόνοιας Περιφέρειας Αττικής (Κ.Κ.Π.Π.Α.)"
                                >
                            </a>
                        </div>
                    </div>
                </div>
                <div class="partner px-2 px-lg-6 px-xl-6 pt-5 pb-5 text-center">
                    <strong>
                    Με την χρηματοδότηση
                    <span class="text-nowrap">του Ομίλου Ηρακλή</span>
                    </strong>
                    <div class="pt-2 px-4 px-sm-0">
                        <a href="https://www.lafarge.gr" target="_blank">
                            <img class="img-fluid"
                                loading="lazy"
                                src="{{ asset('images/landing/partners/iraklis.png') }}"
                                width="488" height="142"
                                alt="Όμιλος Ηρακλής"
                            >
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- section--simple-call -->
        <section class="landing bg-light px-4 py-6">
            <div class="landing-call container-lg text-center">
                <div class="text-center">
                    <h1 class="action text-center">
                        Ενδιαφέρεσαι για το παιχνίδι;
                    </h1>
                </div>
                <div class="landing-call pt-4 text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand">
                        παίξε
                    </a>
                </div>
            </div>
        </section>

        <!-- section--links -->
        <section class="landing bg-light px-4 py-6">
            <div class="landing-links container-lg text-center">
                <div class="text-center">
                    <h1>
                        Άλλες βοηθητικές τεχνολογίες για ΑμεΑ
                    </h1>
                </div>
                <div class="row pt-5 gy-5 landing-links">
                    <div class="col-lg-4 link">
                        <a href="https://talkandplay.scify.org" target="_blank">Talk and Play</a>
                        <div class="pt-2">
                            Σύστημα επικοινωνίας και ψυχαγωγίας
                            για παιδιά με εγκεφαλική παράλυση
                        </div>
                    </div>
                    <div class="col-lg-4 link">
                        <a href="https://memoristudio.scify.org" target="_blank">Memor-i Studio</a>
                        <div class="pt-2">
                            Ηλεκτρονικά παιχνίδια για τυφλά παιδιά.
                            Πλατφόρμα ανάπτυξης νέων παιχνιδιών
                        </div>
                    </div>
                    <div class="col-lg-4 link">
                        <a href="http://gamesfortheblind.org" target="_blank">Games for the Blind</a>
                        <div class="pt-2">
                            Και άλλα ηλεκτρονικά παιχνίδια
                            για τυφλά παιδιά
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

</x-layout>
