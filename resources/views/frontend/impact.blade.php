<div class="ilm-page">
@include('frontend.includes.page-hero', ['pageKey' => 'impact'])

    @php
        $instagramProfile = $setting->instagram ?? 'https://www.instagram.com/';
        $impactStories = [
            [
                'title' => 'Young Mothers Empowered',
                'text' => 'Vocational training, shelter support, food packages, and counseling help young mothers rebuild dignity and provide for their children.',
            ],
            [
                'title' => 'Youth Mentored in Schools',
                'text' => 'School outreaches bring faith-based guidance and mentorship that help students value their lives and pursue purposeful futures.',
            ],
            [
                'title' => 'Leaders Multiplying Hope',
                'text' => 'Leadership development equips emerging voices to carry care beyond one classroom, one village, or one donation cycle.',
            ],
            [
                'title' => 'Partners Walking With Us',
                'text' => 'Churches, organizations, and friends invest in transparent pathways—where generosity becomes lasting community transformation.',
            ],
        ];
    @endphp

    <section class="ilm-impact-page-intro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <span class="ilm-badge">Our Impact</span>
                    <h2 class="ilm-section-title">Lives restored. Communities strengthened.</h2>
                    <p class="ilm-section-subtitle">
                        Every partnership fuels practical care for young mothers and youth across Rwanda—
                        skills learned, homes stabilized, and hope that keeps growing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-impact-page-details">
        <div class="container">
            <div class="row g-4">
                @foreach($impactStories as $story)
                    <div class="col-md-6">
                        <article class="ilm-impact-detail wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                            <span class="ilm-impact-detail__mark" aria-hidden="true"></span>
                            <h3 class="ilm-impact-detail__title">{{ $story['title'] }}</h3>
                            <p class="ilm-impact-detail__text">{{ $story['text'] }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($impacts) && $impacts->isNotEmpty())
    <section class="ilm-impact-stats">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-12 text-center">
                    <h2 class="ilm-section-title text-white">Impact at a glance</h2>
                    <p class="ilm-section-subtitle ilm-section-subtitle--light">Snapshots of the fruit your partnership makes possible.</p>
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

    <section class="ilm-impact-page-gallery">
        <div class="container">
            <div class="text-center mb-40">
                <h2 class="ilm-section-title">Impact in the field</h2>
                <p class="ilm-section-subtitle">Training rooms, outreaches, packages delivered, and joy restored across our programs.</p>
            </div>
            <div class="row g-4">
                @forelse($gallery as $image)
                    @php
                        $imageUrl = method_exists($image, 'imageUrl')
                            ? $image->imageUrl()
                            : (function_exists('ilm_image_url')
                                ? ilm_image_url('images', $image->image ?? $image->path ?? '')
                                : asset('storage/images/' . ltrim($image->image ?? '', '/')));
                        $caption = $image->caption ?? $image->title ?? 'Impact moment';
                    @endphp
                    <div class="col-xl-4 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                        <a class="ilm-gallery-item popup-image" href="{{ $imageUrl }}">
                            <img src="{{ $imageUrl }}" alt="{{ $caption }}" loading="lazy" decoding="async">
                        </a>
                        @if(!empty($image->caption))
                            <p class="ilm-gallery-caption">{{ $image->caption }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ilm-empty-state text-center">
                            <h3>Gallery moments coming soon</h3>
                            <p>Photos from trainings, outreaches, and community care will appear here.</p>
                            <a class="tp-btn ilm-btn-orange" href="{{ route('gallery') }}" wire:navigate>Visit Full Gallery</a>
                        </div>
                    </div>
                @endforelse
            </div>
            @if($gallery->isNotEmpty())
                <div class="text-center mt-45">
                    <a class="tp-btn theme-1-bg" href="{{ route('gallery') }}" wire:navigate>View Full Gallery</a>
                </div>
            @endif
        </div>
    </section>

    <section class="ilm-impact-page-cta">
        <div class="container">
            <div class="ilm-impact-page-cta__inner">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="ilm-eyebrow ilm-eyebrow--light">Partner With Purpose</span>
                        <h2 class="ilm-impact-page-cta__title">Help the next story of hope take root</h2>
                        <p class="ilm-impact-page-cta__text">
                            Whether you give, volunteer, or walk with us as an organization,
                            your partnership fuels dignity for young mothers and youth.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="ilm-impact-page-cta__actions">
                            <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                            <a class="tp-btn ilm-btn-ghost" href="{{ route('getInvolved') }}" wire:navigate>Get Involved</a>
                            <a class="tp-btn ilm-btn-ghost" href="{{ route('testimonials') }}" wire:navigate>Read Testimonials</a>
                            <a class="tp-btn ilm-btn-ghost" href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-instagram" aria-hidden="true"></i> Follow on Instagram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($partners) && $partners->isNotEmpty())
    <section class="ilm-partner-strip grey-bg">
        <div class="container">
            <div class="text-center mb-40">
                <h2 class="ilm-section-title">Trusted partners</h2>
                <p class="ilm-section-subtitle">Friends who walk with us in transforming communities.</p>
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
                                                    <img src="{{ ilm_image_url('images/partners', $partner->image) }}" alt="Partner logo" loading="lazy" decoding="async">
                                                </a>
                                            @else
                                                <img src="{{ ilm_image_url('images/partners', $partner->image) }}" alt="Partner logo" loading="lazy" decoding="async">
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

    @include('frontend.includes.bottom')
</div>
