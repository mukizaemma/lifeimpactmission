@extends('layouts.frontbase')

@section('content')

    <!-- slider-area-start -->
    @include('frontend.includes.slides')
    <!-- slider-area-end -->
    
    <!-- about-area-start -->
    <div class="tp-about-4__area tp-about-4__space p-relative fix grey-bg mt-60">
        <div class="tp-about-4__bg" data-background="{{ asset('storage/images/' . $about->image) }}">
        </div>
        <div class="container">
            <div class="row">
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

                                <p style="font-size: 20px; font-wight:700; text-align:left" > {{ $words }} </p>

                                @if(strlen($about->description) > 400)
                                
                                <div class="tp-about-3__btn">
                                    <a class="tp-btn" href="{{route('backgroundDetails')}}">Read More</a>
                                </div>
                                @endif
                            </div>                                
                            {{-- <div class="tp-about-4__wraper pb-45 d-flex justify-content-between">

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
                            </div>      --}}
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

    <!-- cta-area-start -->
    <div class="tp-cta-2__area pb-15">
        <div class="tp-cta-2__bg p-relative fix" data-background="{{ asset('storage/images/' . $about->image1) }}">
            <div class="tp-cta-2__shape-3 d-none d-lg-block">
                <img src="assets/img/cta/cta-shape-3.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-cta-2__content text-center">
                            <span class="tp-cta-2__subtitle wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".3s">A generation is rising with purpose, passion, and faith.</span>
                            <h4 class="tp-cta-2__title wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".5s">It starts with one moment of encouragement that changes everything</h4>
                            <a href="{{route('contacts')}}" class="tp-btn theme-1-bg wow tpfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".7s">Get Involved</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cta-area-end -->
    
        <!-- event-area-start -->
            @include('frontend.includes.events')
        <!-- event-area-end -->


    <!-- testimonial-area-start -->
    
    {{-- @include('frontend.includes.testimonials') --}}
    <!-- testimonial-area-end -->

    <!-- blog-area-start -->
    <div class="tp-blog-2__area pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-blog-2__section-title pb-50 text-center">
                        <h4 class="tp-section-title">Our Latest Updates</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $blog)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                data-wow-delay=".3s">
                    <div class="tp-blog-2__item">
                        <a href="{{route('postSingle',$blog->slug)}}">
                            <div class="tp-blog-2__thumb p-relative">
                                <img src="{{ asset('storage/images/news/' . $blog->image) }}" alt="">
                            </div>
                        </a>
                        <div class="tp-blog-2__content">
                            <div class="{{route('postSingle',$blog->slug)}}">
                            </div>
                            <a href="{{route('postSingle',$blog->slug)}}"><h4 class="tp-blog-2__title-sm">{{$blog->title}}</h4></a>
                            <span class="tp-blog-2__meta-3">{{$blog->created_at->format('d M,Y')}}</span>
                            <a href="{{route('postSingle',$blog->slug)}}">
                                <div class="tp-blog-2__link text-center">
                                    <span>Read More<i class="flaticon-arrow-right"></i><span>
                                </span></span></div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- blog-area-end -->

    <!-- cta-area-start -->
    @include('frontend.includes.bottom')
    <!-- cta-area-end -->

@endsection