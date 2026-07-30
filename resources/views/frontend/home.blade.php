<div class="ilm-page">
{{-- 1. Hero --}}
    @include('frontend.includes.slides')

    {{-- 2. About + Vision / Mission (mockup split) --}}
    @include('frontend.includes.home-need')

    {{-- 3. Key Programs — 3 cards --}}
    @include('frontend.includes.services')

    {{-- 4. Empowering Young Mothers — 4 colored pillars --}}
    @include('frontend.includes.home-pillars')

    {{-- 5. Our Impact + Instagram spotlight --}}
    @include('frontend.includes.home-impact')

    {{-- 6. Story --}}
    @include('frontend.includes.home-story')

    {{-- 7. Donate band --}}
    <div class="tp-cta-2__area pb-15">
        <div class="tp-cta-2__bg p-relative fix" data-background="{{ !empty($about->image1) ? ilm_image_url('images', $about->image1) : asset('assets/img/cta/cta-bg.jpg') }}">
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

    {{-- 8. Mothers profiles --}}
    @include('frontend.includes.home-mothers')

    {{-- 9. Get involved --}}
    @include('frontend.includes.bottom')
</div>
