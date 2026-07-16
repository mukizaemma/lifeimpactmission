@php
    $aboutCopy = Str::limit(strip_tags($about->description ?? ''), 360, '...');
    $visionCopy = $mission->vision
        ?? 'To see thriving, empowered communities where every individual lives with dignity, purpose, and hope.';
    $missionCopy = $mission->mission
        ?? 'To empower individuals and communities through capacity building, education, leadership development, and spiritual transformation.';
@endphp

<section class="ilm-about-home" id="about">
    <div class="container">
        <div class="row align-items-center g-4 g-xl-5">
            <div class="col-lg-6 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".15s">
                <div class="ilm-about-home__media">
                    <div class="ilm-about-home__frame">
                        @if(!empty($about->image))
                            <img
                                src="{{ ilm_image_url('images', $about->image) }}"
                                alt="Mentorship and empowerment"
                                loading="lazy"
                                decoding="async"
                                width="680"
                                height="560"
                            >
                        @endif
                    </div>
                    <div class="ilm-about-home__accent" aria-hidden="true"></div>
                </div>
            </div>

            <div class="col-lg-6 wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="ilm-about-home__content">
                    <h2 class="ilm-section-title">About our mission</h2>
                    <p class="ilm-section-subtitle">Faith, mentorship, and practical empowerment for young mothers and vulnerable youth in Rwanda.</p>
                    <p class="ilm-about-home__lead">{{ $aboutCopy }}</p>

                    <div class="ilm-about-home__vm">
                        <article class="ilm-about-home__vm-item">
                            <div class="ilm-about-home__vm-icon" aria-hidden="true"><i class="flaticon-vision"></i></div>
                            <h3>Our Vision</h3>
                            <p>{{ Str::limit($visionCopy, 140, '...') }}</p>
                        </article>
                        <article class="ilm-about-home__vm-item">
                            <div class="ilm-about-home__vm-icon" aria-hidden="true"><i class="flaticon-mission"></i></div>
                            <h3>Our Mission</h3>
                            <p>{{ Str::limit($missionCopy, 140, '...') }}</p>
                        </article>
                    </div>

                    <a class="tp-btn ilm-btn-orange" href="{{ route('backgroundDetails') }}" wire:navigate>Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>
