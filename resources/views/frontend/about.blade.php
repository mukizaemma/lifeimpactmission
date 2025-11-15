@extends('layouts.frontbase')

@section('title', 'Home Page')

@section('content')


        <!-- breadcrumb-area-start -->
        <div class="tp-breadcrumb__area p-relative fix tp-breadcrumb-height" data-background="{{ asset('storage/images/' . $about->image2) }}"  >
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
                                <p style="font-size: 20px; font-wight:700; text-align:left" > {{ $about->description }} </p>

                                <div class="tp-about-3__btn">
                                    <a class="tp-btn" href="{{route('backgroundDetails')}}">Read More</a>
                                </div>

                            </div>  
                                                          
 
                        </div>
                    </div>
                </div>
                <div class="container">
                                    <div class="tp-about-4__wraper pb-45 d-flex justify-content-between">

                    <div class="tp-about-4__list-item d-flex align-items-start" style="width: 80%">
                    <div class="tp-about-4__list-content" style="display: flex; flex-direction: column; align-items: center; text-align: start;">
                        <div class="tp-about-4__list-icon">
                            <i class="flaticon-mission"></i>
                        </div>
                        <h4 class="tp-about-4__title-sm">Our Mission</h4>
                        <p>{{ $mission->mission }}</p>
                    </div>

                    </div>
                    <div class="tp-about-4__list-item d-flex align-items-start" style="width: 30%">
                    <div class="tp-about-4__list-content" style="display: flex; flex-direction: column; align-items: center; text-align: start;">
                        <div class="tp-about-4__list-icon">
                            {{-- <i class="flaticon-mission"></i> --}}
                        </div>
                        <h4 class="tp-about-4__title-sm"></h4>
                        <p></p>
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
    </div>
        <!-- about-area-end -->

        <div class="container">
    <div class="tp-brand-2__border">

        <div class="tp-about-4__section-title text-center mb-40">
            <h4 class="tp-section-title">Meet Our Team</h4>
        </div>

        <div class="row justify-content-center">

            @foreach ($staff as $member)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div style="
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
                    overflow: hidden;
                    text-align: center;
                    padding: 20px;
                    transition: all .3s ease-in-out;
                "
                onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)'">

                    {{-- Image --}}
                    <div style="width: 100%; height: 220px; overflow: hidden; border-radius: 10px; margin-bottom: 15px;">
                        <img src="{{ asset('storage/images/staff/' . $member->image) }}"
                             alt="{{ $member->names }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    {{-- Name --}}
                    <h4 style="font-size: 20px; font-weight:700; margin-bottom: 5px;">
                        {{ $member->names }}
                    </h4>

                    {{-- Position --}}
                    <p style="color:#555; font-size: 15px; margin-bottom: 10px;">
                        {{ $member->position }}
                    </p>

                    {{-- Phone --}}
                    <p style="margin:0; font-size:14px;">
                        📞 <a href="tel:{{ $member->phone }}" style="color:#333; text-decoration:none;">
                            {{ $member->phone }}
                        </a>
                    </p>

                    {{-- Email --}}
                    <p style="margin:0; font-size:14px;">
                        ✉ <a href="mailto:{{ $member->email }}" style="color:#333; text-decoration:none;">
                            {{ $member->email }}
                        </a>
                    </p>

                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>

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
