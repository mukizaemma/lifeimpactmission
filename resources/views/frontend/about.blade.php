<div class="ilm-page">
@php
        $storyMilestones = [
            [
                'icon' => 'flaticon-map',
                'title' => 'Founded in Rwanda',
                'text' => 'Impact Life Mission began with a desire to restore hope in communities facing social and economic hardship.',
            ],
            [
                'icon' => 'flaticon-open-book',
                'title' => 'School Outreaches Began',
                'text' => 'We started walking into schools with faith-based guidance, mentorship, and messages that help students value their lives.',
            ],
            [
                'icon' => 'flaticon-home',
                'title' => 'Young Mothers Empowerment',
                'text' => 'Vocational training, shelter support, food packages, and counseling became a pathway back to dignity for young mothers.',
            ],
            [
                'icon' => 'flaticon-people',
                'title' => 'Leadership Development Expanded',
                'text' => 'Mentoring young leaders multiplied our impact beyond one room, one school, or one village.',
            ],
        ];

        $coreValues = [
            [
                'icon' => 'flaticon-handshake',
                'title' => 'Integrity',
                'text' => 'We serve with honesty, transparency, and faithful stewardship of every opportunity entrusted to us.',
            ],
            [
                'icon' => 'flaticon-love',
                'title' => 'Compassion',
                'text' => 'We respond to pain with practical care, listening hearts, and a commitment to restore dignity.',
            ],
            [
                'icon' => 'flaticon-people',
                'title' => 'Empowerment',
                'text' => 'We believe vulnerable people can become resilient leaders when given skills, support, and hope.',
            ],
            [
                'icon' => 'flaticon-pray',
                'title' => 'Faith',
                'text' => 'Our Christian identity shapes how we mentor, encourage, and walk with communities toward transformation.',
            ],
        ];
    @endphp

    @include('frontend.includes.page-hero', ['pageKey' => 'about'])

    <section class="ilm-about-story">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".15s">
                    <div class="ilm-about-home__media">
                        <div class="ilm-about-home__frame">
                            @if(!empty($about->image))
                                <img src="{{ ilm_image_url('images', $about->image) }}" alt="About Impact Life Mission" loading="lazy" decoding="async">
                            @endif
                        </div>
                        <div class="ilm-about-home__accent" aria-hidden="true"></div>
                    </div>
                </div>
                <div class="col-lg-6 wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".3s">
                    <h2 class="ilm-section-title">Who we are</h2>
                    <p class="ilm-section-subtitle">A youth-focused Christian organization restoring dignity through faith, skills, and community care.</p>
                    <div class="ilm-about-story__text">
                        <p>{{ $about->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-vision-mission grey-bg">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Vision & Mission</h2>
                <p class="ilm-section-subtitle">The compass that guides every outreach, training, and act of care.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <article class="ilm-vm-card">
                        <div class="ilm-vm-card__icon" aria-hidden="true"><i class="flaticon-vision"></i></div>
                        <h3 class="ilm-vm-card__title">Our Vision</h3>
                        <p class="ilm-vm-card__text">{{ $mission->vision }}</p>
                    </article>
                </div>
                <div class="col-lg-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".35s">
                    <article class="ilm-vm-card">
                        <div class="ilm-vm-card__icon" aria-hidden="true"><i class="flaticon-mission"></i></div>
                        <h3 class="ilm-vm-card__title">Our Mission</h3>
                        <p class="ilm-vm-card__text">{{ $mission->mission }}</p>
                    </article>
                </div>
            </div>

            <div class="ilm-approach mt-60">
                <div class="text-center mb-40">
                    <h2 class="ilm-section-title">How we work</h2>
                    <p class="ilm-section-subtitle">Skills, mentorship, and faith—woven into every program.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="ilm-approach__item">
                            <h4>Practical Skills</h4>
                            <p>Vocational training and capacity building that open doors to economic independence.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ilm-approach__item">
                            <h4>Mentorship</h4>
                            <p>Guidance and counseling that restore confidence, identity, and healthy choices.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ilm-approach__item">
                            <h4>Faith-Driven Values</h4>
                            <p>Spiritual transformation that shapes responsible leaders and change-makers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ilm-about-timeline">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Our story</h2>
                <p class="ilm-section-subtitle">From a local burden in Rwanda to a growing mission of dignity, discipleship, and empowerment.</p>
            </div>
            <div class="ilm-timeline-grid">
                @foreach ($storyMilestones as $item)
                    <article class="ilm-timeline-card wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                        <div class="ilm-timeline-card__icon" aria-hidden="true">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <h3 class="ilm-timeline-card__title">{{ $item['title'] }}</h3>
                        <p class="ilm-timeline-card__text">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ilm-core-values grey-bg">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Our core values</h2>
                <p class="ilm-section-subtitle">The beliefs shaping how we serve young mothers, youth, and vulnerable communities.</p>
            </div>
            <div class="row g-4">
                @foreach ($coreValues as $value)
                    <div class="col-lg-3 col-md-6">
                        <article class="ilm-value-card wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                            <div class="ilm-value-card__icon" aria-hidden="true">
                                <i class="{{ $value['icon'] }}"></i>
                            </div>
                            <h3 class="ilm-value-card__title">{{ $value['title'] }}</h3>
                            <p class="ilm-value-card__text">{{ $value['text'] }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($impacts) && $impacts->isNotEmpty())
    <section class="ilm-about-impact">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-5">
                    <h2 class="ilm-section-title">Our impact</h2>
                    <p class="ilm-section-subtitle">Every number points to a young life encouraged, a mother supported, or a community strengthened.</p>
                </div>
                <div class="col-lg-7">
                    <div class="ilm-about-impact__grid">
                        @foreach($impacts->take(4) as $impact)
                            <div class="ilm-about-impact__item wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                                <div class="ilm-about-impact__number">{{ $impact->title }}</div>
                                <div class="ilm-about-impact__label">{{ $impact->description }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="ilm-team-section">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Meet our team</h2>
                <p class="ilm-section-subtitle">Hands and hearts committed to seeing young lives thrive.</p>
            </div>
            <div class="row justify-content-center">
                @foreach ($staff as $member)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                    <article class="ilm-team-card">
                        <div class="ilm-team-card__media">
                            <img src="{{ ilm_image_url('images/staff', $member->image) }}" alt="{{ $member->names }}" loading="lazy" decoding="async">
                        </div>
                        <h3 class="ilm-team-card__name">{{ $member->names }}</h3>
                        <p class="ilm-team-card__role">{{ $member->position }}</p>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($partners) && $partners->isNotEmpty())
    <section class="ilm-partner-strip grey-bg">
        <div class="container">
            <div class="text-center mb-40">
                <h2 class="ilm-section-title">Our partners</h2>
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
                                                <img src="{{ ilm_image_url('images/partners', $partner->image)}}" alt="Partner logo" loading="lazy" decoding="async">
                                            </a>
                                        @else
                                            <img src="{{ ilm_image_url('images/partners', $partner->image)}}" alt="Partner logo" loading="lazy" decoding="async">
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

    @include('frontend.includes.home-agriculture')
    @include('frontend.includes.backImage')
</div>
