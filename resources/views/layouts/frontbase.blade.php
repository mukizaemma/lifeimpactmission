<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $setting->company ?? ''}}</title>
    <meta name="description" content="Impact Life Mission empowers young mothers and vulnerable youth in Rwanda through vocational training, shelter and food support, health insurance, hygiene materials, mentorship, and faith—building pathways to lasting independence.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://img.youtube.com" crossorigin>
    <link rel="dns-prefetch" href="https://img.youtube.com">
    @stack('head')

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage\images').$setting->logo}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ilm-home.css') }}">
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->

    <!-- back-to-top-start  -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="far fa-angle-double-up"></i>
    </button>
    <!-- back-to-top-end  -->

        <!-- tp-offcanvus-area-start -->
    <div class="tpoffcanvas-area">
        <div class="tpoffcanvas">
            <div class="tpoffcanvas__close-btn">
                <button class="close-btn"><i class="fal fa-times"></i></button>
            </div>
            <div class="tpoffcanvas__logo">
                <a href="{{ route('home') }}">
                    <img src="{{asset('storage\images').$setting->logo}}" alt="" width="120px">
                </a>
            </div>
            <div class="tpoffcanvas__title">
                
            </div>
            <div class="tp-main-menu-mobile d-xl-none"></div>
            {{-- <div class="tpoffcanvas__contact-info">
                <div class="tpoffcanvas__contact-title">
                    <h5>Contact us</h5>
                </div>
                <ul>
                    <li>
                    <i class="fa-light fa-location-dot"></i>
                    <a  target="_blank">{{ $setting->address }}</a>
                    </li>
                    <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:{{ $setting->email ?? '' }}">{{ $setting->email ?? '' }}</a>
                    </li>
                    <li>
                    <i class="fal fa-phone-alt"></i>
                    <a href="tel:{{ $setting->phone ?? '' }}">{{ $setting->phone ?? '' }}</a>
                    </li>
                </ul>
            </div>
            
            <div class="tpoffcanvas__social">
                <div class="row align-items-center">
                    <div class="col-12 mt-5">
                        <div class="tp-copyright__socials text-center text-sm-start">
                            <a href="{{ $setting->facebook ?? '' }}" class="btn btn-secondary" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $setting->instagram ?? '' }}" class="btn btn-secondary" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $setting->twitter ?? '' }}" class="btn btn-secondary" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $setting->youtube ?? '' }}" class="btn btn-secondary" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        </div>
        
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->

    <header class="tp-header-height">
        
        <!-- header-area-start -->
        <div id="header-sticky" class="tp-header-3__area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-1 col-lg-6 col-md-4 col-7">
                        <div class="tp-header-3__logo">
                            <a href="{{route('home')}}">
                                <img src="{{asset('storage\images').$setting->logo}}" alt="" width="90px">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 d-none d-xl-block">
                        <div class="tp-header-3__main-menu">
                            <nav class="tp-main-menu-content">
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li><a href="{{route('backgroundDetails')}}">Who We Are</a>
                                    </li>

                                    <li class="has-dropdown"><a href="{{ route('showPrograms') }}">Our Programs</a>
                                        <ul class="submenu tp-submenu">
                                            @foreach ($ourPrograms as $program)
                                                <li><a href="{{ route('project',['slug'=>$program->slug]) }}">{{ $program->title }}</a></li>           
                                            @endforeach
                                            <li><a href="{{ route('mothers') }}">Mothers</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="{{ route('posts') }}">Stories & Updates</a>
                                        <ul class="submenu tp-submenu">
                                            <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                                            <li><a href="{{ route('upcomingEvents') }}">Events</a></li>
                                            <li><a href="{{ route('posts') }}">Recent Updates</a></li>
                                            <li><a href="{{ route('home') }}#events">Highlights</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="{{ route('gallery') }}">Gallery</a>
                                        <ul class="submenu tp-submenu">
                                            <li><a href="{{ route('gallery') }}">Images</a></li>
                                            <li><a href="{{ route('videos') }}">Videos</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('getInvolved') }}">Get Involved</a></li>
                                    <li><a href="{{route('contacts')}}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-6 col-md-8 col-5">
                        <div class="tp-header-3__right-box">
                            <div class="tp-header-3__right-action text-end">
                                <ul class="d-flex align-items-center justify-content-end">
                                    {{-- <li>
                                        <div class="tp-header-3__icon-box d-none d-md-block">
                                            <button class="search-open-btn"><i class="flaticon-loupe"></i></button><a href="{{ route('login') }}"><i class="flaticon-user"></i></a>
                                        </div>
                                    </li>                                     --}}
                                    <li>
                                        <div class="tp-header-3__btn d-none d-md-block">
                                            <a class="tp-btn" href="https://secure.qgiv.com/for/impactlifemission" target="_blank">Donate Now</a>
                                        </div>
                                    </li>  
                                    <li>
                                        <div class="tp-header-3__bar d-xl-none">
                                            <button class="tp-menu-bar"><i class="fa-solid fa-bars-staggered"></i></button>
                                        </div>
                                    </li>                                  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-area-end -->
    </header>

    <main>
        
        @yield('content')
    </main>

    <footer>
        <!-- footer-area-start -->
        <div class="tp-footer__area">
            <div class="tp-footer__bg" data-background="#">
                <div class="container">
                    <div class="row ilm-footer-row">
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-45 ilm-footer-col-brand wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                            <div class="tp-footer__widget footer-2-col-1">
                                <div class="tp-footer__logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('storage/images') . $setting->logo }}" alt="Impact Life Mission" height="120">
                                    </a>
                                </div>
                                <div class="tp-footer__text">
                                    <p style="color:#fff">Empowering young mothers and youth to live with dignity, purpose, and hope.</p>
                                </div>
                                <a class="tp-btn mt-15" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 mb-45 ilm-footer-col-links wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                            <div class="tp-footer__widget">
                                <h4 class="tp-footer__widget-title-3">Quick Links</h4>
                                <div class="tp-footer__list">
                                    <ul class="ilm-footer-quicklinks">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('backgroundDetails') }}">Who We Are</a></li>
                                        <li><a href="{{ route('showPrograms') }}">Our Programs</a></li>
                                        <li><a href="{{ route('mothers') }}">Mothers</a></li>
                                        <li><a href="{{ route('upcomingEvents') }}">Events</a></li>
                                        <li><a href="{{ route('posts') }}">Updates</a></li>
                                        <li><a href="{{ route('gallery') }}">Images</a></li>
                                        <li><a href="{{ route('videos') }}">Videos</a></li>
                                        <li><a href="{{ route('getInvolved') }}">Get Involved</a></li>
                                        <li><a href="{{ route('contacts') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 mb-45 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                            <div class="tp-footer__widget ilm-footer-connect">
                                <h4 class="tp-footer__widget-title-3">Connect With Us</h4>

                                <div class="ilm-footer-connect__cards">
                                    @if(!empty($setting->email))
                                        <a href="mailto:{{ $setting->email }}" class="ilm-footer-connect__card">
                                            <span class="ilm-footer-connect__icon"><i class="flaticon-mail"></i></span>
                                            <span class="ilm-footer-connect__text">
                                                <small>Email</small>
                                                {{ $setting->email }}
                                            </span>
                                        </a>
                                    @endif
                                    @if(!empty($setting->phone))
                                        <a href="tel:{{ $setting->phone }}" class="ilm-footer-connect__card">
                                            <span class="ilm-footer-connect__icon"><i class="flaticon-phone"></i></span>
                                            <span class="ilm-footer-connect__text">
                                                <small>Phone</small>
                                                {{ $setting->phone }}
                                            </span>
                                        </a>
                                    @endif
                                    @if(!empty($setting->phone1))
                                        <a href="tel:{{ $setting->phone1 }}" class="ilm-footer-connect__card">
                                            <span class="ilm-footer-connect__icon"><i class="flaticon-phone"></i></span>
                                            <span class="ilm-footer-connect__text">
                                                <small>Phone 2</small>
                                                {{ $setting->phone1 }}
                                            </span>
                                        </a>
                                    @endif
                                    @if(!empty($setting->address))
                                        <div class="ilm-footer-connect__card ilm-footer-connect__card--static">
                                            <span class="ilm-footer-connect__icon"><i class="flaticon-location"></i></span>
                                            <span class="ilm-footer-connect__text">
                                                <small>Address</small>
                                                {{ $setting->address }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                @include('frontend.includes.social-links')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-area-end -->

        <!-- copyright-area-start -->
        <div class="tp-copyright__area tp-copyright__bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="tp-copyright__text text-center text-sm-start">
                            <span style="color: #fff !important">
                            &copy; Impact Life Mission 
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            | Site Developed by
                            </span>
                             <a href="https://iremetech.com"
                                target="_blank" style="color: #fff">Ireme Technologies</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                    </div>
                </div>
            </div>
        </div>
        <!-- copyright-area-end -->

    </footer>


    <!-- JS here -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/purecounter.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>



</body>

</html>