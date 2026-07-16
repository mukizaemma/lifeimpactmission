@php
    $heroSlides = $slides->isNotEmpty() ? $slides : collect([(object) [
        'image' => null,
        'heading' => 'Empowering young mothers and youth to live with dignity',
        'subheading' => 'Vocational training, shelter & food, health care, and faith-centered mentorship in Rwanda.',
        'button' => 'Donate Now',
        'link' => 'https://secure.qgiv.com/for/impactlifemission',
    ]]);
    $heroFallbackBg = !empty($about->image)
        ? asset('storage/images/' . $about->image)
        : asset('assets/img/slider/slider-3-1.jpg');
@endphp

<div class="tp-slider-3__area p-relative custom-banners ilm-hero">
    <div class="tp-slider-3__wrapper">
        <div class="swiper-container tp-slider-3__active">
            <div class="swiper-wrapper">
                @foreach ($heroSlides as $index => $slide)
                @php
                    $slideBg = !empty($slide->image)
                        ? asset('storage/images/slides/') . $slide->image
                        : $heroFallbackBg;
                    $subtitle = !empty($slide->subheading)
                        ? $slide->subheading
                        : 'Vocational training, shelter & food, health care, and faith-centered mentorship in Rwanda.';
                @endphp
                <div class="swiper-slide">
                    <div class="tp-slider-3__bg z-index fix p-relative ilm-hero-slide" data-background="{{ $slideBg }}">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 col-lg-11">
                                    <div class="tp-slider-3__content text-center ilm-hero__content">
                                        <h1 class="tp-slider-3-title ilm-hero__title">
                                            {{ $slide->heading ?: 'Empowering young mothers and youth to live with dignity' }}
                                        </h1>
                                        <p class="ilm-hero__lead">{{ $subtitle }}</p>
                                        <div class="ilm-hero__actions">
                                            @if(!empty($slide->button) && !empty($slide->link))
                                                <a class="tp-btn ilm-btn-orange" href="{{ $slide->link }}" @if(str_starts_with($slide->link, 'http')) target="_blank" rel="noopener" @endif>{{ $slide->button }}</a>
                                            @else
                                                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                                            @endif
                                            <a class="tp-btn ilm-btn-outline" href="#programs">Our Programs</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@if($slides->isNotEmpty())
    @push('head')
        <link rel="preload" as="image" href="{{ asset('storage/images/slides/') . $slides->first()->image }}">
    @endpush
@endif
