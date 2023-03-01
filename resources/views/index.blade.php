<x-layoutLanding :title="__('messages.app_name')">

    <!-- section--tree-forest -->
    <section class="landing bg-green px-4">
        <div class="container-lg pt-2 px-4">
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
                        <a href="https://www.scify.gr" target="_blank">
                            <img
                                class="img-fluid"
                                loading="lazy"
                                srcset="{{ asset('images/logos/74h_scify@2x.png') }} 2x"
                                src="{{ asset('images/logos/74h_scify.png') }}"
                                width="56" height="74"
                                alt="SciFY - Science for You"
                            >
                        </a>
                    </div>
                </div>
                <div class="col-0 col-md-2 order-2" aria-role="presentation"></div>
                <div class="col-12 col-md-5 order-1 order-md-3 sponsor">
                    <div class="text-nowrap">Ευγενική χορηγία</div>
                    <div>
                        <a href="https://www.lafarge.gr" target="_blank">
                            <img
                                class="img-fluid"
                                loading="lazy"
                                srcset="{{ asset('images/logos/74h_iraklis@2x.png') }} 2x"
                                src="{{ asset('images/logos/74h_iraklis.png') }}"
                                width="263" height="74"
                                alt="Ηρακλής - Όμιλος εταιριών"
                            >
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section--four-abstrack-blocks -->
    <section class="landing trvl-curve trvl-curve--landing-one-lg--color--green bg-light bg-lg-green px-0 mb-xl-n350">
        <div class="trvl-curve trvl-curve--landing-four-abstract-blocks--sm-xl-dash px-4">
            <div class="pt-2 px-4">
                <div class="container text-center landing-blocks landing-blocks--three">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-around align-items-center gy-5">
                        <div class="col">
                            <div class="landing-block landing-block--abstract">
                                <img class=""
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/blocks-abstract/block_1@2x.png') }} 2x"
                                    src="{{ asset('images/landing/blocks-abstract/block_1.png') }}"
                                    width="264" height="398"
                                    aria-role="presentation"
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
                        </div>
                        <div class="col">
                            <div class="landing-block landing-block--abstract">
                                <img class=""
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/blocks-abstract/block_3@2x.png') }} 2x"
                                    src="{{ asset('images/landing/blocks-abstract/block_3.png') }}"
                                    width="264" height="398"
                                    aria-role="presentation"
                                    alt=""
                                >
                                <div class="landing-block--label">
                                    <h2>
                                        <span>Με τη συνεργασία</span>
                                        <span>ειδικών παιδαγωγών<span>
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
                                    aria-role="presentation"
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
    <div aria-role="presentation" class="d-none d-xl-block trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--color trvl-curve--landing-one-xl--color--green bg-light">
        <div class="trvl-curve trvl-curve--landing-one-xl trvl-curve--landing-one-xl--dash">
            &nbsp;
        </div>
    </div>

    <!-- section--landing-numbers -->
    <section class="landing bg-light px-4 pt-0 pt-lg-4">
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
                        aria-role="presentation"
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
                        aria-role="presentation"
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
    <div aria-role="presentation" class="trvl-curve trvl-curve--landing-two trvl-curve--landing-two--color trvl-curve--landing-two--color--brown bg-light">
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
                            alt="Εικόνα στην οποία απεικονίζονται οι ρυθμίσεις του παιχνιδιού οι οποίες σχετίζονται με τον τρόπο πλοήγησης σε αυτό. Εμφανίζονται οι ρυθμίσεις για το στιλ πλοήγησης (έχει επιλεχθεί «αυτόματο»), την ταχύτητα σάρωσης (κάθε 2 δευτερόλεπτα) και τη βοήθεια μετά από αριθμό λαθών (έχει επιλεχθεί 3)."
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
                            alt="Εικόνα στην οποία εμφανίζεται η οθόνη επιλογής προφίλ παίκτη στο παιχνίδι. Παρουσιάζονται συνολικά 14 προφίλ, όπως επίσης και το πλήκτρο που επιτρέπει τη δημιουργία ακόμη περισσότερων."
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
                            srcset="{{ asset('images/landing/blocks-circle/block_2@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks-circle/block_2.png') }}"
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
                            srcset="{{ asset('images/landing/blocks-circle/block_3@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks-circle/block_3.png') }}"
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
                            srcset="{{ asset('images/landing/blocks-circle/block_4@2x.png') }} 2x"
                            src="{{ asset('images/landing/blocks-circle/block_4.png') }}"
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

    <!-- floating-dash -->
    <div class="floating-dash-container position-relative bg-green mb-2">
        <div class="floating-dash position-relative" aria-role="presentation">
            &nbsp;
        </div>
        <!-- section--testimonials -->
        <section class="landing bg-green px-4 pt-5 pb-6">
            <div class="landing-testimonials d-flex ">
                <div id="carouselTestimonials" class="carousel carousel-dark slide" data-bs-ride="false">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial d-flex justify-content-between">
                                <div class="testimonial-img d-none d-md-block">
                                    <!-- generated via https://app.haikei.app/ -->
                                    <svg class="img img-fluid" id="visual" viewBox="0 0 500 500" width="500" height="500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M0 191L45 191L45 76L91 76L91 146L136 146L136 231L182 231L182 201L227 201L227 121L273 121L273 86L318 86L318 61L364 61L364 131L409 131L409 216L455 216L455 96L500 96L500 126L500 0L500 0L455 0L455 0L409 0L409 0L364 0L364 0L318 0L318 0L273 0L273 0L227 0L227 0L182 0L182 0L136 0L136 0L91 0L91 0L45 0L45 0L0 0Z" fill="#fa7268"></path><path d="M0 261L45 261L45 156L91 156L91 236L136 236L136 296L182 296L182 256L227 256L227 216L273 216L273 131L318 131L318 141L364 141L364 251L409 251L409 256L455 256L455 151L500 151L500 266L500 124L500 94L455 94L455 214L409 214L409 129L364 129L364 59L318 59L318 84L273 84L273 119L227 119L227 199L182 199L182 229L136 229L136 144L91 144L91 74L45 74L45 189L0 189Z" fill="#ea5e66"></path><path d="M0 361L45 361L45 241L91 241L91 331L136 331L136 351L182 351L182 356L227 356L227 301L273 301L273 221L318 221L318 236L364 236L364 346L409 346L409 356L455 356L455 186L500 186L500 316L500 264L500 149L455 149L455 254L409 254L409 249L364 249L364 139L318 139L318 129L273 129L273 214L227 214L227 254L182 254L182 294L136 294L136 234L91 234L91 154L45 154L45 259L0 259Z" fill="#d84a64"></path><path d="M0 411L45 411L45 271L91 271L91 411L136 411L136 401L182 401L182 391L227 391L227 341L273 341L273 286L318 286L318 311L364 311L364 416L409 416L409 406L455 406L455 271L500 271L500 356L500 314L500 184L455 184L455 354L409 354L409 344L364 344L364 234L318 234L318 219L273 219L273 299L227 299L227 354L182 354L182 349L136 349L136 329L91 329L91 239L45 239L45 359L0 359Z" fill="#c53762"></path><path d="M0 501L45 501L45 501L91 501L91 501L136 501L136 501L182 501L182 501L227 501L227 501L273 501L273 501L318 501L318 501L364 501L364 501L409 501L409 501L455 501L455 501L500 501L500 501L500 354L500 269L455 269L455 404L409 404L409 414L364 414L364 309L318 309L318 284L273 284L273 339L227 339L227 389L182 389L182 399L136 399L136 409L91 409L91 269L45 269L45 409L0 409Z" fill="#b0235f"></path></svg>
                                </div>
                                <div class="testimonial-text">
                                    <div class="quote">
                                        «Τα παιδιά ενθουσιάστηκαν πολύ, τους κέντρισε το ενδιαφέρον και αύξησε σημαντικά τον χρόνο συγκέντρωσης και ενασχόλησης τους με το παιχνίδι»
                                    </div>
                                    <div class="source">
                                            Κώστας, 10 χρονών
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="carousel-item">
                        <div class="testimonial d-flex justify-content-between">
                            <div class="testimonial-img d-none d-md-block">
                                <!-- generated via https://app.haikei.app/ -->
                                <svg class="img img-fluid" id="visual" viewBox="0 0 500 500" width="500" height="500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M0 41L45 41L45 51L91 51L91 36L136 36L136 76L182 76L182 81L227 81L227 36L273 36L273 56L318 56L318 46L364 46L364 86L409 86L409 61L455 61L455 46L500 46L500 81L500 0L500 0L455 0L455 0L409 0L409 0L364 0L364 0L318 0L318 0L273 0L273 0L227 0L227 0L182 0L182 0L136 0L136 0L91 0L91 0L45 0L45 0L0 0Z" fill="#696dfa"></path><path d="M0 151L45 151L45 126L91 126L91 131L136 131L136 151L182 151L182 166L227 166L227 106L273 106L273 101L318 101L318 141L364 141L364 161L409 161L409 126L455 126L455 101L500 101L500 181L500 79L500 44L455 44L455 59L409 59L409 84L364 84L364 44L318 44L318 54L273 54L273 34L227 34L227 79L182 79L182 74L136 74L136 34L91 34L91 49L45 49L45 39L0 39Z" fill="#625be8"></path><path d="M0 261L45 261L45 281L91 281L91 261L136 261L136 221L182 221L182 296L227 296L227 236L273 236L273 311L318 311L318 356L364 356L364 231L409 231L409 341L455 341L455 251L500 251L500 326L500 179L500 99L455 99L455 124L409 124L409 159L364 159L364 139L318 139L318 99L273 99L273 104L227 104L227 164L182 164L182 149L136 149L136 129L91 129L91 124L45 124L45 149L0 149Z" fill="#5c49d5"></path><path d="M0 386L45 386L45 421L91 421L91 401L136 401L136 386L182 386L182 451L227 451L227 371L273 371L273 436L318 436L318 446L364 446L364 386L409 386L409 426L455 426L455 411L500 411L500 401L500 324L500 249L455 249L455 339L409 339L409 229L364 229L364 354L318 354L318 309L273 309L273 234L227 234L227 294L182 294L182 219L136 219L136 259L91 259L91 279L45 279L45 259L0 259Z" fill="#5537c2"></path><path d="M0 501L45 501L45 501L91 501L91 501L136 501L136 501L182 501L182 501L227 501L227 501L273 501L273 501L318 501L318 501L364 501L364 501L409 501L409 501L455 501L455 501L500 501L500 501L500 399L500 409L455 409L455 424L409 424L409 384L364 384L364 444L318 444L318 434L273 434L273 369L227 369L227 449L182 449L182 384L136 384L136 399L91 399L91 419L45 419L45 384L0 384Z" fill="#4e23b0"></path></svg>
                            </div>
                            <div class="testimonial-text">
                                <div class="quote">
                                    «Εξαιρετικό. Ενδεικτικά, μαθητής μας με τεράστια διάσπαση προσοχής έμεινε συγκεντρωμένος καθ'όλη τη διάρκεια του παιχνιδιού!»
                                </div>
                                <div class="source">
                                        Αντώνης, 34 χρονών
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="carousel-item">
                            <div class="d-block ">@todo add more testimonials</div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>

            </div>
        </section>

    </div>

    <!-- floating-dash -->
    <div class="floating-dash-container position-relative bg-light mb-2">
        <div class="floating-dash position-relative" aria-role="presentation">
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
                    από φορείς εγνωσμένου κύρους: την ΕΛΕΠΑΠ, το <span class="text-nowrap">ΚΑΣΠ Χατζηπατέρειο</span>, το <span class="text-nowrap">Ειδικό Σχολείο</span> <span class="text-nowrap">Αγριάς Μαγνησίας</span>
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

        <!-- section--links -->
        <section class="landing bg-light px-4 py-6 d-none">
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
                        <a href="https://gamesfortheblind.org" target="_blank">Games for the Blind</a>
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
