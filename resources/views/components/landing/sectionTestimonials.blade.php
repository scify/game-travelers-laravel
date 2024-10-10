<!-- /resources/views/component/homeTestimonials.blade.php -->
<section class="landing bg-green px-0 px-md-4 pt-5 pb-6 text-center" aria-labelledby="landing-testimonials-label">
    <h1 id="landing-testimonials-label" class="visually-hidden">Μαρτυρίες</h1>
    <div class="landing-testimonials d-flex ">
        <div id="carouselTestimonials" class="carousel carousel-dark slide" data-bs-ride="true" data-bs-interval="7000">
            <div class="carousel-indicators">
                {{-- Carousel Buttons --}}
                @foreach ($carouselSlides as $slide)
                    @if($slide["active"])
                    <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="{{ $loop->index }}" class="active" aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
                    @else
                    <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="{{ $loop->index }}" aria-label="Slide {{ $loop->iteration }}"></button>
                    @endif
                @endforeach
            </div>
            <div class="carousel-inner">
                {{-- Carousel Slides --}}
                @foreach ($carouselSlides as $slide)
                    <div class="carousel-item {{ $slide['active'] ? 'active' : '' }}">
                        <div class="testimonial d-flex justify-content-between">
                            <div class="testimonial-img d-none d-md-block">
                                <img class="img-fluid"
                                    loading="lazy"
                                    srcset="{{ asset('images/landing/slides/'.$slide['asset'].'@2x.jpg') }} 2x"
                                    src="{{ asset('images/landing/slides/'.$slide['asset'].'.jpg') }}"
                                    width="500" height="500"
                                    alt="{{ $slide['alt'] }}"
                                >
                            </div>
                            <div class="testimonial-text">
                                <div class="quote">
                                    «{{ $slide['quote'] }}»
                                </div>
                                <div class="source">
                                    {{ $slide['source'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
