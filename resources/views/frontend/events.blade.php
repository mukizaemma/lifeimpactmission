@extends('layouts.frontbase')

@section('title', 'Home Page')

@section('content')


        <!-- breadcrumb-area-start -->
        <div class="tp-breadcrumb__area p-relative fix tp-breadcrumb-height" data-background="{{ asset('storage/images/') . $about->image }}" style="height: 550px; margin: 0 auto;">
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
                            <h3 class="tp-breadcrumb__title text-center">Upcoming Events</h3>
                         </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- event-area-start -->
        <div class="tp-event__area pt-115 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay=".3s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-1.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="evant-details.html">
                                        <h4 class="tp-event__title">Charities Learn Forward <br>Integrate Social</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="evant-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay=".5s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-2.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="evant-details.html">
                                        <h4 class="tp-event__title">Be Hungry No More and <br>Leave no One Behind</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="evant-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay=".7s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-3.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="donation-details.html">
                                        <h4 class="tp-event__title">Help Us Touch Their Live <br> of These Youth</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="donation-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay=".9s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-3.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="evant-details.html">
                                        <h4 class="tp-event__title">Helping the Homeless <br>During Hopeless</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="evant-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay="1s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-5.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="evant-details.html">
                                        <h4 class="tp-event__title">Share Your Hungboa <br>Blessing With Childrens</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="evant-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                    data-wow-delay="1.2s">
                        <div class="tp-event__wrapper">
                            <div class="tp-event__item">
                                <div class="tp-event__thumb p-relative">
                                    <img src="assets/img/event/event-1-6.jpg" alt="">
                                    <div class="tp-event__thumb-text">
                                        <h4 class="tp-event__thumb-date">17 <br><span>Jan</span></h4>
                                    </div>
                                </div>
                                <div class="tp-event__content">
                                    <div class="tp-event__meta">
                                        <span><i class="far fa-clock"></i>4:30 am - 7:30 pm</span>
                                        <a href="#"><span><i class="fal fa-map-marker-alt"></i>Watsica 24,
                                                USA</span></a>
                                    </div>
                                    <a href="evant-details.html">
                                        <h4 class="tp-event__title">Poorex Charity of Month <br>Plan on America</h4>
                                    </a>
                                    <div class="tp-event__link">
                                        <a href="evant-details.html">Read More<i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- event-area-end -->

        <!-- cta-area-start -->
            @include('frontend.includes.backImage')
        <!-- cta-area-end -->


@endsection
