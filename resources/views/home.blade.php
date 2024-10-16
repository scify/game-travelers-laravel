<x-layoutLanding :title="__('messages.app_name')">
    <main>

        <!-- section--tree-forest -->
        <section class="landing bg-green px-4">
            <div class="container-lg pt-2 px-0 px-lg-4">
                <div class="landing-trees d-flex justify-content-center">
                    <img class="img-xl"
                        loading="lazy"
                        srcset="{{ asset('images/landing/trees/trees-xl@2x.png') }} 2x"
                        src="{{ asset('images/landing/trees/trees-xl.png') }}"
                        width="928" height="250"
                        alt=""
                        style="display: none;"
                    >
                    <img class="img-lg"
                        loading="lazy"
                        srcset="{{ asset('images/landing/trees/trees-lg@2x.png') }} 2x"
                        src="{{ asset('images/landing/trees/trees-lg.png') }}"
                        width="628" height="236"
                        alt=""
                        style="display: none;"
                    >
                    <img class="img-sm"
                        loading="lazy"
                        srcset="{{ asset('images/landing/trees/tree@2x.png') }} 2x"
                        src="{{ asset('images/landing/trees/tree.png') }}"
                        width="124" height="191"
                        alt=""
                    >
                </div>
                <div class="landing-call pt-4 text-center">
                    <h1 class="action">
                        <span>Ταξίδι στο παιχνίδι,</span>
                        <span>για παιδιά με αναπηρία!</span>
                    </h1>
                </div>
                <div class="landing-call-to-action pt-4 text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand">
                        παίξε εδώ
                    </a>
                </div>
            </div>
            <div class="landing-made-by container-lg text-center pt-5 pb-5">
                <div class="row">
                    <div class="col-12 col-md-5 pt-5 pt-md-0 order-2 order-md-1 scify">
                        <div>Ανάπτυξη</div>
                        <div>
                            <a href="https://www.scify.gr">
                                <img
                                    class="img-fluid logo logo-h74 scify"
                                    loading="lazy"
                                    srcset="{{ asset('images/logos/74h_scify@3x.png') }} 3x, {{ asset('images/logos/74h_scify@2x.png') }} 2x"
                                    src="{{ asset('images/logos/74h_scify.png') }}"
                                    width="56" height="74"
                                    alt="SciFY - Science for You"
                                >
                            </a>
                        </div>
                    </div>
                    <div class="col-0 col-md-2 order-2" aria-hidden="true"></div>
                    <div class="col-12 col-md-5 order-1 order-md-3 sponsor">
                        <div class="text-nowrap">Ευγενική χορηγία</div>
                        <div>
                            <a href="https://www.lafarge.gr">
                                <!-- 263 x 74 -->
                                <img
                                    class="img-fluid logo logo-h74 sponsor"
                                    loading="lazy"
                                    srcset="{{ asset('images/logos/74h_heracles@3x.png') }} 3x, {{ asset('images/logos/74h_heracles@2x.png') }} 2x"
                                    src="{{ asset('images/logos/74h_heracles.png') }}"
                                    width="414" height="74"
                                    alt="Ηρακλής - Όμιλος εταιριών"
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section--four-abstract-blocks -->
        <section class="landing trvl-curve trvl-curve--landing-one-lg--color--green bg-light bg-lg-green px-0 mb-xl-n350">
            <div class="trvl-curve trvl-curve--landing-four-abstract-blocks--sm-xl-dash px-0 px-lg-4">
                <div class="pt-2 px-0 px-sm-4">
                    <div class="container text-center landing-blocks landing-blocks--three">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-around align-items-center gy-5">
                            <div class="col">
                                <div class="landing-block landing-block--abstract">
                                    <img class=""
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/blocks-abstract/block_1@2x.png') }} 2x"
                                        src="{{ asset('images/landing/blocks-abstract/block_1.png') }}"
                                        width="264" height="398"
                                        alt=""
                                    >
                                    <div class="landing-block--label">
                                        <h2>
                                            <span>Σχεδιασμένο για παιδιά</span>
                                            <span>με εγκεφαλική παράλυση</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="landing-block landing-block--abstract">
                                    <img class=""
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/blocks-abstract/block_2@2x.png') }} 2x"
                                        src="{{ asset('images/landing/blocks-abstract/block_2.png') }}"
                                        width="264" height="398"
                                        alt=""
                                    >
                                    <div class="landing-block--label">
                                        <h2>
                                            <span>Ευκαιρία για παιχνίδι</span>
                                            <span>και χαρά</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="landing-block landing-block--abstract">
                                    <img class=""
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/blocks-abstract/block_3@2x.png') }} 2x"
                                        src="{{ asset('images/landing/blocks-abstract/block_3.png') }}"
                                        width="264" height="398"
                                        alt=""
                                    >
                                    <div class="landing-block--label">
                                        <h2>
                                            <span>Με τη συνεργασία</span>
                                            <span>ειδικών παιδαγωγών</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="landing-block landing-block--abstract">
                                    <img class=""
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/blocks-abstract/block_4@2x.png') }} 2x"
                                        src="{{ asset('images/landing/blocks-abstract/block_4.png') }}"
                                        width="264" height="398"
                                        alt=""
                                    >
                                    <div class="landing-block--label">
                                        <h2>
                                            <span>Ενισχύει την αυτονομία</span>
                                            <span>και την αυτοπεποίθηση</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- curve--landing-one-xl -->
        <div aria-hidden="true" class="d-none d-xl-block trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--color trvl-curve--landing-one-xl--color--green bg-light">
            <div class="trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--dash">
                &nbsp;
            </div>
        </div>

        <!-- section--landing-numbers -->
        <section class="landing bg-light px-4 pt-6 pt-lg-4">
            <div class="container-lg pt-2">
                <div class="landing-numbers py-1 py-md-6 d-flex flex-column justify-content-around ">
                    <div class="landing-numbers--one d-flex flex-column flex-lg-row align-items-center">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/numbers/one@2x.png') }} 2x"
                            src="{{ asset('images/landing/numbers/one.png') }}"
                            width="168" height="162"
                            alt=""
                        >
                        <div class="ps-0 ps-md-4 pt-4 pt-lg-0">
                            <h2>Για παιδιά με αναπηρία</h2>
                        </div>
                    </div>
                    <div class="landing-numbers--two d-flex flex-column flex-lg-row align-items-center" >
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/numbers/two@2x.png') }} 2x"
                            src="{{ asset('images/landing/numbers/two.png') }}"
                            width="168" height="162"
                            alt=""
                        >
                        <div class="ps-0 ps-md-4 pt-4 pt-lg-0">
                            <h2>Για φορείς φροντίδας ΑμεΑ</h2>
                        </div>
                    </div>
                    <div class="landing-numbers--three d-flex flex-column flex-lg-row align-items-center ">
                        <img class=""
                            loading="lazy"
                            srcset="{{ asset('images/landing/numbers/three@2x.png') }} 2x"
                            src="{{ asset('images/landing/numbers/three.png') }}"
                            width="168" height="162"
                            alt=""
                        >
                        <div class="ps-0 ps-md-4 pt-4 pt-lg-0">
                            <h2>...και για όλους!</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- curve--landing-two -->
        <div aria-hidden="true" class="trvl-curve trvl-curve--landing-two trvl-curve--landing-two--color trvl-curve--landing-two--color--brown bg-light">
            &nbsp;
        </div>

        <!-- section--screenshots -->
        <section class="landing bg-brown px-4 py-2">
            <div class="container-lg text-center pb-4">
                <div class="landing-screenshots justify-content-start py-6">
                    <div class="screenshot px-0 px-sm-5 pb-4">
                        <div>
                            <h2>
                                <span>Προσαρμόζεται πλήρως</span>
                                <span>στις ανάγκες του παιδιού</span>
                            </h2>
                        </div>
                        <div class="pt-2">
                            <img class="img-fluid screenshot rounded"
                                loading="lazy"
                                srcset="{{ asset('images/landing/screenshots/screenshot_01@2x.png') }} 2x"
                                src="{{ asset('images/landing/screenshots/screenshot_01.png') }}"
                                width="1366" height="862"
                                alt="Εικόνα απο το παιχνίδι Ταξιδιώτες με τις ρυθμίσεις του, οι οποίες σχετίζονται με τον τρόπο πλοήγησης σε αυτό. Παρουσιάζονται οι επιλογές για το στιλ πλοήγησης (έχει επιλεχθεί «αυτόματο»), την ταχύτητα σάρωσης (κάθε 2 δευτερόλεπτα) και τη βοήθεια, που παρέχεται στον παίκτη, μετά από συγκεκριμένο αριθμό λαθών (έχει επιλεχθεί ο αριθμός 3)."
                            >
                        </div>
                    </div>
                    <div class="screenshot pt-5 px-0 px-sm-5">
                        <div class="pt-2 text-center">
                            <h2 class="pb-2">
                                <span>Διαφορετικό προφίλ</span>
                                <span>για κάθε παίκτη</span>
                            </h2>
                            <img class="img-fluid screenshot rounded"
                                loading="lazy"
                                srcset="{{ asset('images/landing/screenshots/screenshot_02@2x.png') }} 2x"
                                src="{{ asset('images/landing/screenshots/screenshot_02.png') }}"
                                width="1366" height="862"
                                alt="Εικόνα από το παιχνίδι Ταξιδιώτες και συγκεκριμένα την οθόνη επιλογής προφίλ παίκτη στο παιχνίδι. Παρουσιάζονται συνολικά 14 προφίλ, όπως επίσης και το πλήκτρο που επιτρέπει τη δημιουργία ακόμη περισσότερων."
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--section--four--blocks -->
        <section class="landing bg-light px-4 pt-6 pb-5 pt-xl-7 pb-xl-7">
            <div class="landing-blocks landing-blocks--four container-xxl py-2 px-4">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-around gy-6">
                    <div class="col">
                        <div class="landing-block landing-block--abstract-round m-auto">
                            <img class=""
                                loading="lazy"
                                srcset="{{ asset('images/landing/blocks-circle/block_1@2x.png') }} 2x"
                                src="{{ asset('images/landing/blocks-circle/block_1.png') }}"
                                width="226" height="243"
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
                                srcset="{{ asset('images/landing/blocks-circle/block_2@2x.png') }} 2x"
                                src="{{ asset('images/landing/blocks-circle/block_2.png') }}"
                                width="226" height="243"
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
                                srcset="{{ asset('images/landing/blocks-circle/block_3@2x.png') }} 2x"
                                src="{{ asset('images/landing/blocks-circle/block_3.png') }}"
                                width="226" height="243"
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
                                srcset="{{ asset('images/landing/blocks-circle/block_4@2x.png') }} 2x"
                                src="{{ asset('images/landing/blocks-circle/block_4.png') }}"
                                width="226" height="243"
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
        <div aria-hidden="true" class="trvl-curve trvl-curve--landing-two trvl-curve--landing-two--color trvl-curve--landing-two--color--brown bg-light">
            &nbsp;
        </div>

        <!-- section--laptop -->
        <section class="landing bg-brown px-4 pt-4 pb-5">
            <div class="landing-ingame">
                <div class="text-center pb-5">
                    <h2>
                        <span>Πολύχρωμα γραφικά</span>
                        <span>που μαγνητίζουν το βλέμμα των παιδιών</span>
                    </h2>
                </div>
                <picture>
                    <source type="image/webp" srcset="{{ asset('images/landing/laptop/laptop_screenshot.webp') }}">
                    <source type="image/png" srcset="{{ asset('images/landing/laptop/laptop_screenshot.png') }}">
                    <img
                        class="img-fluid mx-auto d-block px-sm-5 px-xxl-0"
                        loading="lazy"
                        src="{{ asset('images/landing/laptop/laptop_screenshot.png') }}"
                        width="1042" height="765"
                        alt="Εικαστική σύνθεση στην οποία απεικονίζονται μερικοί από τους χαρακτήρες του παιχνιδιού μπροστά από την οθόνη ενός φορητού υπολογιστή. Σε αυτήν εμφανίζεται μια από τις πίστες του παιχνιδιού «Ταξιδιώτες»."
                    >
                </picture>
            </div>
        </section>

        <!-- section--portraits -->
        <section class="landing bg-brown px-4 pt-4 pb-6">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/landing/portraits/chars.webp') }}">
                <source type="image/png" srcset="{{ asset('images/landing/portraits/chars.png') }}">
                <img
                    class="img-fluid mx-auto d-block px-3 px-sm-6 px-xxl-3"
                    loading="lazy"
                    src="{{ asset('images/landing/portraits/chars.png') }}"
                    width="1118" height="413"
                    alt="Εικαστική σύνθεση στην οποία απεικονίζονται πορτρέτα με κάποιους από τους χαρακτήρες του παιχνιδιού «Ταξιδιώτες»."
                >
              </picture>
        </section>

        <!-- floating-dash  -->
        <div class="floating-dash-container position-relative bg-light mb-2">
            <div class="floating-dash position-relative" aria-hidden="true">
                &nbsp;
            </div>

            <!-- section-gameplay-videos -->
            <section class="landing bg-light px-4 py-3 py-md-6" id="gameplay-videos">
                <div class="container-lg landing-gameplay-videos">
                    <div class="text-center pb-2">
                        <h1 id="gameplay-videos-label">Πάρε μια γεύση από το παιχνίδι</h1>
                    </div>
                    <div class="container-lg pt-5 pb-6 px-4 px-md-5 px-lg-6">
                        <div class="row text-center gap-4">
                            <div class="col gameplay-video">
                                <a href="https://www.youtube.com/watch?v=SXi1U0Zzzkw" target="_blank" rel="noopener noreferrer" class="btn btn-video mx-auto" aria-labelledby="video-1-label">
                                    <img class="video-thumb" src="{{ asset('images/landing/thumbs/SXi1U0Zzzkw.webp') }}" alt="" />
                                    <span id="video-1-label" class="visually-hidden">Δείτε πώς να παίξετε το παιχνίδι, με ζάρι με χρώματα, χωρίς αριθμούς, υπολογισμούς και αυτόματο scanning. Η αναπαραγωγή του βίντεο θα γίνει σε νέο παράθυρο.</span>
                                </a>
                            </div>
                            <div class="col gameplay-video">
                                <a href="https://www.youtube.com/watch?v=CaiOV7vu554" target="_blank" rel="noopener noreferrer" class="btn btn-video mx-auto" aria-labelledby="video-2-label">
                                    <img class="video-thumb" src="{{ asset('images/landing/thumbs/CaiOV7vu554.webp') }}" alt="" />
                                    <span id="video-2-label" class="visually-hidden">Δείτε πώς να παίξετε το παιχνίδι, με ζάρι με αριθμούς, ιδανικό για παιδιά που μπορούν να καταλάβουν αριθμούς και να κάνουν υπολογισμούς. Η αναπαραγωγή του βίντεο θα γίνει σε νέο παράθυρο.</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <!-- section-testimonials -->
        <x-landing.sectionTestimonials :carousel-slides='$carouselSlides'>
        </x-landing.sectionTestimonials>

        <!-- floating-dash -->
        <div class="floating-dash-container position-relative bg-light">
            <div class="floating-dash position-relative" aria-hidden="true">
                &nbsp;
            </div>

            <!-- section--simple-call -->
            <section class="landing bg-light px-4 py-5">
                <div class="landing-call-to-action container-lg text-center">
                    <div class="text-center">
                        <h1 class="action text-center">
                            Σε τι διαφέρει από τα υπόλοιπα παιχνίδια;
                        </h1>
                    </div>
                    <div class="landing-call pt-4 text-center">
                        <a href="{{ route('about') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand">
                            μάθε εδώ
                        </a>
                    </div>
                </div>
            </section>

            <!-- section--partners -->
            <section class="landing bg-light px-4 pt-4 pb-5 pt-lg-5">
                <div class="landing-partners container-lg px-0 px-xl-5 px-xxl-6">
                    <div class="px-2 px-lg-6 px-xl-6 pb-5 text-center">
                        Το παιχνίδι αναπτύχθηκε σε στενή συνεργασία με ειδικούς παιδαγωγούς
                        από φορείς εγνωσμένου κύρους:
                        την ΕΛΕΠΑΠ, το <span class="text-nowrap">ΚΑΣΠ Χατζηπατέρειο</span>,
                        το <span class="text-nowrap">Ειδικό Σχολείο</span> <span class="text-nowrap">Αγριάς Μαγνησίας</span>
                        και το Κέντρο Κοινωνικής Πρόνοιας <span class="text-nowrap">Περιφέρειας Αττικής</span>.
                    </div>
                    <div class="landing-partners--logos container py-5">
                        <div class="row row-cols-1 row-cols-sm-3 gy-5 justify-content-around text-center">
                            <div>
                                <a href="https://elepap.gr" target="_blank" rel="noopener">
                                    <img class="img-fluid"
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/partners/elepap@2x.png') }} 2x"
                                        src="{{ asset('images/landing/partners/elepap.png') }}"
                                        width="219" height="90"
                                        alt="ΕΛΕΠΑΠ"
                                    >
                                </a>
                            </div>
                            <div>
                                <a href="https://kasp.gr" target="_blank" rel="noopener">
                                    <img class="img-fluid"
                                        loading="lazy"
                                        srcset="{{ asset('images/landing/partners/kasp@2x.png') }} 2x"
                                        src="{{ asset('images/landing/partners/kasp.png') }}"
                                        width="78" height="90"
                                        alt="«Χατζηπατέρειο» Κέντρο Αποκατάστασης & Στήριξης Παιδιού (Κ.Α.Σ.Π.)"
                                    >
                                </a>
                            </div>
                            <div class="silent">
                                <a href="https://dim-eid-agrias.mag.sch.gr/" target="_blank" rel="noopener">
                                ΕΙΔΙΚΟ ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ<br />
                                &amp; ΝΗΠΙΑΓΩΓΕΙΟ ΑΓΡΙΑΣ
                                </a>
                            </div>
                            <div class="d-none">
                                <a href="https://www.kkppa.gr" target="_blank" rel="noopener">
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
                </div>
            </section>

            <!-- section--simple-call -->
            <section class="landing bg-light px-4 pt-5 pb-3">
                <div class="landing-call-to-action container-lg text-center">
                    <div class="text-center">
                        <h1 class="action text-center">
                            Πάμε να παίξουμε;
                        </h1>
                    </div>
                    <div class="landing-call pt-4 text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-nowrap responsive-expand">
                            παίξε εδώ
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </main>

</x-layoutLanding>
