@extends('layouts.frontbase')

@section('title', 'Home Page')

@section('content')


        <!-- breadcrumb-area-start -->
        <div class="tp-breadcrumb__area p-relative fix tp-breadcrumb-height" data-background="{{ asset('storage/images/' . $about->image2) }}" >
            <div class="tp-breadcrumb__shape-1 z-index-5">
                <img src="assets/img/breadcrumb/breadcrumb-shape-1.png" alt="">
            </div>
            <div class="tp-breadcrumb__shape-2 z-index-5">
                <img src="assets/img/breadcrumb/breadcrumb-shape-2.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tp-breadcrumb__content z-index-5">
                            <div class="tp-breadcrumb__list">
                               <span><a href="{{ route('home') }}">home</a></span>
                            </div>
                            <h3 class="tp-breadcrumb__title text-center">About us</h3>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- about-area-start -->
    <div class="tp-about-4__area tp-about-4__space p-relative fix grey-bg mt-60">
        <div class="container">
            <div class="row">
                <div class="offset-xl-12 wow tpfadeRight" data-wow-duration=".9s"
                data-wow-delay=".5s">
                    <div class="tp-about-4__left-side">
                        <div class="tp-about-4__section-title">
                            <h4 class="tp-section-title">About Us</h4>
                        </div>
                        <div class="tp-about-4__content">
                            <div class="tp-about-4__text">
                                <p style="font-size: 20px; font-wight:700; text-align:center" > {{ $about->description }} </p>

                                <div class="tp-about-3__btn">
                                    <a class="tp-btn" href="{{route('backgroundDetails')}}">Read More</a>
                                </div>

                            </div>  
                                                          
 
                        </div>
                    </div>
                </div>
                <div class="tp-about-4__wraper pb-45 d-flex justify-content-between">

                    <div class="tp-about-4__list-item d-flex align-items-start">
                    <div class="tp-about-4__list-content" style="display: flex; flex-direction: column; align-items: center; text-align: start;">
                        <div class="tp-about-4__list-icon">
                            <i class="flaticon-mission"></i>
                        </div>
                        <h4 class="tp-about-4__title-sm">Our Mission</h4>
                        <p>{{ $mission->mission }}</p>
                    </div>

                    </div>
                    <div class="tp-about-4__list-item d-flex align-items-start">
                    <div class="tp-about-4__list-content" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <div class="tp-about-4__list-icon">
                            <i class="flaticon-vision"></i>
                        </div>
                        <h4 class="tp-about-4__title-sm">Our Vision</h4>
                        <p>{{ $mission->vision }}</p>
                    </div>

                    </div>
                </div> 
            </div>
        </div>
    </div>
        <!-- about-area-end -->

        <!-- brand-area-start -->
        <div class="tp-brand-2__area">
            <div class="container">
                <div class="tp-brand-2__border">
                        <div class="tp-about-4__section-title">
                            <h4 class="tp-section-title">Our Partners</h4>
                        </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="tp-brand-2__wrapper">
                                <div class="swiper-container tp-brand-2__active">
                                    <div class="swiper-wrapper">
                                        @foreach ($partners as $partner)
                                        <div class="swiper-slide">
                                            <div class="tp-brand-2__item text-center">
                                                <a href="{{ $partner->website }}" target="_blank">
                                                    <img src="{{ asset('storage/images/partners') . $partner->image }}" alt="" style="height: 90px; object-fit: contain;">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-area-end -->

        <!-- cta-area-start -->
    @include('frontend.includes.backImage')
        <!-- cta-area-end -->


@endsection
