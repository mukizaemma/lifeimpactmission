@extends('layouts.frontbase')

@section('content')

    <!-- slider-area-start -->
    @include('frontend.includes.slides')
    <!-- slider-area-end -->
    
    <!-- about-area-start -->
    <div class="tp-about-4__area tp-about-4__space p-relative fix grey-bg">
        <div class="tp-about-4__bg" data-background="{{ asset('storage/images/' . $about->image) }}">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="offset-xl-6 offset-lg-6 col-xl-6 col-lg-6 wow tpfadeRight" data-wow-duration=".9s"
                data-wow-delay=".5s">
                    <div class="tp-about-4__left-side">
                        <div class="tp-about-4__section-title">
                            <h4 class="tp-section-title">About Impact Life Mission </h4>
                        </div>
                        <div class="tp-about-4__content">
                            <div class="tp-about-4__text">
                                @php
                                $words = Str::limit($about->description, 400, '...');
                                @endphp

                                <p style="font-size: 20px; text-align:left">{{ $words }}</p>

                                @if(strlen($about->description) > 400)
                                <div class="tp-about-3__btn">
                                    <a class="tp-btn" href="{{route('backgroundDetails')}}">Learn More</a>
                                </div>
                                @endif
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area-end -->
     
    <!-- service-area-start -->
    @include('frontend.includes.services')
    <!-- service-area-end -->

    <!-- partner impact & why partner -->
    @include('frontend.includes.partner-impact')

    <!-- cta-area-start -->
    <div class="tp-cta-2__area pb-15">
        <div class="tp-cta-2__bg p-relative fix" data-background="{{ asset('storage/images/' . $about->image1) }}">
            <div class="tp-cta-2__shape-3 d-none d-lg-block">
                <img src="{{ asset('assets/img/cta/cta-shape-3.png') }}" alt="" loading="lazy" decoding="async">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-cta-2__content text-center">
                            <span class="tp-cta-2__subtitle wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".3s">Impact Life Mission</span>
                            <h4 class="tp-cta-2__title wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".5s">When a young heart kneels, a mighty future is born.</h4>
                            <a href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener" class="tp-btn theme-1-bg wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".7s">Donate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cta-area-end -->

    <!-- testimonial-area-start -->
    @if(isset($testimonials) && $testimonials->count())
        @include('frontend.includes.testimonials')
    @endif
    <!-- testimonial-area-end -->

    <!-- events & highlights (last section before footer) -->
    @include('frontend.includes.events-instagram')

    <!-- volunteer cta above footer -->
    @include('frontend.includes.bottom')

@endsection
