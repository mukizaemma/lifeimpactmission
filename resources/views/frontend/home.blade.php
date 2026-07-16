@extends('layouts.frontbase')

@section('content')

    {{-- 1. Hero --}}
    @include('frontend.includes.slides')

    {{-- 2. About + Vision / Mission (mockup split) --}}
    @include('frontend.includes.home-need')

    {{-- 3. Key Programs — 3 cards --}}
    @include('frontend.includes.services')

    {{-- 4. Empowering Young Mothers — 4 colored pillars --}}
    @include('frontend.includes.home-pillars')

    {{-- 5. Agriculture independence band --}}
    @include('frontend.includes.home-agriculture')

    {{-- 6. Impact numbers --}}
    @if(isset($impacts) && $impacts->isNotEmpty())
    <section class="ilm-impact-stats">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-12 text-center">
                    <h2 class="ilm-section-title text-white">Lives transformed through partnership</h2>
                    <p class="ilm-section-subtitle ilm-section-subtitle--light">Numbers that point to restored dignity and growing hope.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($impacts->take(4) as $impact)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                        <div class="ilm-stat-item wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                            <div class="ilm-stat-item__number">{{ $impact->title }}</div>
                            <div class="ilm-stat-item__label">{{ $impact->description }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 7. Story --}}
    @include('frontend.includes.home-story')

    {{-- 8. Donate band --}}
    <div class="tp-cta-2__area pb-15">
        <div class="tp-cta-2__bg p-relative fix" data-background="{{ asset('storage/images/' . ($about->image1 ?? $about->image)) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-cta-2__content text-center">
                            <span class="tp-cta-2__subtitle wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">Impact Life Mission</span>
                            <h4 class="tp-cta-2__title wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">When a young heart kneels, a mighty future is born.</h4>
                            <a href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener" class="tp-btn ilm-btn-orange wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 9. Mothers profiles (replaces events & highlights) --}}
    @include('frontend.includes.home-mothers')

    {{-- 10. Get involved --}}
    @include('frontend.includes.bottom')

@endsection
