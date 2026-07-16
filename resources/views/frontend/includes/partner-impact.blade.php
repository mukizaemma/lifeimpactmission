@if(isset($impacts) && $impacts->isNotEmpty())
<section class="ilm-impact-stats">
    <div class="container">
        <div class="row mb-40">
            <div class="col-xl-12 text-center">
                <span class="ilm-badge" style="color: rgba(255,255,255,0.85);">Our Impact</span>
                <h4 class="tp-section-title text-white">Lives Transformed Through Your Partnership</h4>
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

<section class="ilm-why-partner grey-bg pt-80 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center mb-50">
                {{-- <span class="ilm-badge"></span> --}}
                <h4 class="tp-section-title">Partner With Us</h4>
                <p class="ilm-section-intro">
                    We deliver measurable community transformation through faith-centered programs,
                    skilled mentorship, and sustainable outreach across Rwanda.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="ilm-why-partner__item wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <h5>Proven Community Reach</h5>
                    <p>School outreaches, young mothers empowerment, and leadership training that meet real needs on the ground.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ilm-why-partner__item wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                    <h5>Transparent Stewardship</h5>
                    <p>Partners receive clear reporting on program outcomes, volunteer engagement, and how resources advance our mission.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ilm-why-partner__item wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".6s">
                    <h5>Collaborative Impact</h5>
                    <p>Co-branded initiatives, event sponsorships, and volunteer pathways tailored to your organization's goals.</p>
                </div>
            </div>
        </div>
        <div class="row mt-40">
            <div class="col-12 text-center">
                <a class="tp-btn me-2" href="{{ route('contacts') }}" wire:navigate>Become a Partner</a>
                <a class="tp-btn theme-1-bg" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Support Our Work</a>
            </div>
        </div>
    </div>
</section>

@if(isset($partners) && $partners->isNotEmpty())
<section class="ilm-partner-strip">
    <div class="container">
        <div class="tp-about-4__section-title text-center mb-40">
            <span class="ilm-badge">Trusted By</span>
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
                                        @if($partner->website)
                                            <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('storage/images/partners') . $partner->image }}" alt="Partner logo" loading="lazy" decoding="async">
                                            </a>
                                        @else
                                            <img src="{{ asset('storage/images/partners') . $partner->image }}" alt="Partner logo" loading="lazy" decoding="async">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
