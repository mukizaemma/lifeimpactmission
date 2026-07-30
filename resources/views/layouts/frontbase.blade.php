<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title ?? ($setting->company ?? 'Impact Life Mission') }}</title>
    <meta name="description" content="Impact Life Mission empowers young mothers and vulnerable youth in Rwanda through vocational training, shelter and food support, health insurance, hygiene materials, mentorship, and faith—building pathways to lasting independence.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://img.youtube.com" crossorigin>
    <link rel="dns-prefetch" href="https://img.youtube.com">
    @stack('head')

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ ilm_image_url('images', $setting->logo ?? '') }}">

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
    @livewireStyles
</head>

<body>

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
                <a href="{{ route('home') }}" wire:navigate>
                    <img src="{{ ilm_image_url('images', $setting->logo ?? '') }}" alt="" width="120px">
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
                            <a href="{{route('home')}}" wire:navigate>
                                <img src="{{ ilm_image_url('images', $setting->logo ?? '') }}" alt="" width="90px">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 d-none d-xl-block">
                        <div class="tp-header-3__main-menu">
                            <nav class="tp-main-menu-content">
                                <ul>
                                    <li><a href="{{route('home')}}" wire:navigate>Home</a>
                                    </li>
                                    <li class="has-dropdown"><a href="{{route('backgroundDetails')}}" wire:navigate>Who We Are</a>
                                        <ul class="submenu tp-submenu">
                                            <li><a href="{{ route('backgroundDetails') }}" wire:navigate>About Us</a></li>
                                            <li><a href="{{ route('impact') }}" wire:navigate>Our Impact</a></li>
                                            <li><a href="{{ route('team') }}" wire:navigate>Our Team</a></li>
                                        </ul>
                                    </li>

                                    <li class="has-dropdown"><a href="{{ route('showPrograms') }}" wire:navigate>Our Programs</a>
                                        <ul class="submenu tp-submenu">
                                            @foreach ($ourPrograms as $program)
                                                <li><a href="{{ route('project',['slug'=>$program->slug]) }}" wire:navigate>{{ $program->title }}</a></li>           
                                            @endforeach
                                            <li><a href="{{ route('mothers') }}" wire:navigate>Mothers</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="{{ route('posts') }}" wire:navigate>Stories & Updates</a>
                                        <ul class="submenu tp-submenu">
                                            <li><a href="{{ route('testimonials') }}" wire:navigate>Testimonials</a></li>
                                            <li><a href="{{ route('upcomingEvents') }}" wire:navigate>Events</a></li>
                                            <li><a href="{{ route('posts') }}" wire:navigate>Recent Updates</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="{{ route('gallery') }}" wire:navigate>Gallery</a>
                                        <ul class="submenu tp-submenu">
                                            <li><a href="{{ route('gallery') }}" wire:navigate>Images</a></li>
                                            <li><a href="{{ route('videos') }}" wire:navigate>Videos</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('contacts')}}" wire:navigate>Contact</a></li>
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
                                            <button class="search-open-btn"><i class="flaticon-loupe"></i></button><a href="{{ route('login') }}" wire:navigate><i class="flaticon-user"></i></a>
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
        
        {{ $slot }}
    </main>

    <footer class="ilm-footer">
        <div class="ilm-footer__main">
            <div class="container">
                <div class="ilm-footer__grid">
                    <div class="ilm-footer__brand wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                        <a href="{{ route('home') }}" class="ilm-footer__logo" wire:navigate>
                            <img src="{{ ilm_image_url('images', $setting->logo ?? '') }}" alt="Impact Life Mission" height="96" width="auto">
                        </a>
                        <p class="ilm-footer__tagline">
                            Empowering young mothers and youth to live with dignity, purpose, and hope.
                        </p>
                        <div class="ilm-footer__actions">
                            <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                            <a class="tp-btn ilm-btn-ghost ilm-footer__ghost" href="{{ route('getInvolved') }}" wire:navigate>Get Involved</a>
                        </div>
                        @include('frontend.includes.social-links')
                    </div>

                    <div class="ilm-footer__nav wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".35s">
                        <div class="ilm-footer__nav-col">
                            <h4 class="ilm-footer__heading">Explore</h4>
                            <ul class="ilm-footer__links">
                                <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                                <li><a href="{{ route('backgroundDetails') }}" wire:navigate>Who We Are</a></li>
                                <li><a href="{{ route('impact') }}" wire:navigate>Our Impact</a></li>
                                <li><a href="{{ route('showPrograms') }}" wire:navigate>Our Programs</a></li>
                                <li><a href="{{ route('mothers') }}" wire:navigate>Mothers</a></li>
                                <li><a href="{{ route('team') }}" wire:navigate>Our Team</a></li>
                            </ul>
                        </div>
                        <div class="ilm-footer__nav-col">
                            <h4 class="ilm-footer__heading">Stories &amp; Media</h4>
                            <ul class="ilm-footer__links">
                                <li><a href="{{ route('testimonials') }}" wire:navigate>Testimonials</a></li>
                                <li><a href="{{ route('upcomingEvents') }}" wire:navigate>Events</a></li>
                                <li><a href="{{ route('posts') }}" wire:navigate>Updates</a></li>
                                <li><a href="{{ route('gallery') }}" wire:navigate>Images</a></li>
                                <li><a href="{{ route('videos') }}" wire:navigate>Videos</a></li>
                                <li><a href="{{ route('contacts') }}" wire:navigate>Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="ilm-footer__connect wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                        <h4 class="ilm-footer__heading">Connect With Us</h4>
                        <div class="ilm-footer__contact">
                            @if(!empty($setting->email))
                                <a href="mailto:{{ $setting->email }}" class="ilm-footer__contact-item">
                                    <span class="ilm-footer__contact-icon" aria-hidden="true"><i class="flaticon-mail"></i></span>
                                    <span class="ilm-footer__contact-copy">
                                        <small>Email</small>
                                        <span>{{ $setting->email }}</span>
                                    </span>
                                </a>
                            @endif
                            @if(!empty($setting->phone))
                                <a href="tel:{{ $setting->phone }}" class="ilm-footer__contact-item">
                                    <span class="ilm-footer__contact-icon" aria-hidden="true"><i class="flaticon-phone"></i></span>
                                    <span class="ilm-footer__contact-copy">
                                        <small>Phone</small>
                                        <span>{{ $setting->phone }}</span>
                                    </span>
                                </a>
                            @endif
                            @if(!empty($setting->phone1))
                                <a href="tel:{{ $setting->phone1 }}" class="ilm-footer__contact-item">
                                    <span class="ilm-footer__contact-icon" aria-hidden="true"><i class="flaticon-phone"></i></span>
                                    <span class="ilm-footer__contact-copy">
                                        <small>Phone 2</small>
                                        <span>{{ $setting->phone1 }}</span>
                                    </span>
                                </a>
                            @endif
                            @if(!empty($setting->address))
                                <div class="ilm-footer__contact-item ilm-footer__contact-item--static">
                                    <span class="ilm-footer__contact-icon" aria-hidden="true"><i class="flaticon-location"></i></span>
                                    <span class="ilm-footer__contact-copy">
                                        <small>Address</small>
                                        <span>{{ $setting->address }}</span>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ilm-footer__bottom">
            <div class="container">
                <div class="ilm-footer__bottom-inner">
                    <p class="ilm-footer__copyright">
                        &copy; {{ date('Y') }} Impact Life Mission.
                        Site developed by
                        <a href="https://iremetech.com" target="_blank" rel="noopener noreferrer">Ireme Technologies</a>
                    </p>
                    <div class="ilm-footer__bottom-links">
                        <a href="{{ route('getInvolved') }}" wire:navigate>Partner With Us</a>
                        <a href="{{ route('contacts') }}" wire:navigate>Say Hello</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- JS here -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/slick.js') }}" defer></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}" defer></script>
    <script src="{{ asset('assets/js/purecounter.js') }}" defer></script>
    <script src="{{ asset('assets/js/wow.js') }}" defer></script>
    <script src="{{ asset('assets/js/nice-select.js') }}" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}" defer></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}" defer></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}" defer></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

    @livewireScripts
    <script src="{{ asset('assets/js/ilm-spa.js') }}"></script>

</body>

</html>