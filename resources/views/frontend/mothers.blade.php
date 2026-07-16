<div class="ilm-page">
@include('frontend.includes.page-hero', [
        'pageKey' => 'mothers',
        'heroTitle' => $pageHeaders['mothers']->title ?? 'Empowered Mothers, Transformed Communities',
        'heroSubtitle' => $pageHeaders['mothers']->subtitle ?? 'Meet the inspiring mothers and discover how you can support their journey.',
    ])

    <section class="ilm-mothers-page">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Our mothers</h2>
                <p class="ilm-section-subtitle">Each story reflects restored confidence, practical skills, and a future rebuilt with dignity.</p>
            </div>

            <div class="row g-4">
                @forelse ($mothers as $mother)
                    <div class="col-xl-3 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ min($loop->iteration + 1, 6) }}s">
                        <article class="ilm-mother-profile-card">
                            <div class="ilm-mother-profile-card__media">
                                <img src="{{ $mother->imageUrl() }}" alt="{{ $mother->names }}" loading="lazy" decoding="async">
                            </div>
                            <div class="ilm-mother-profile-card__body">
                                <h3 class="ilm-mother-profile-card__name">{{ $mother->names }}</h3>
                                @if(!empty($mother->title))
                                    <p class="ilm-mother-profile-card__role">{{ $mother->title }}</p>
                                @endif
                                <p class="ilm-mother-profile-card__text">
                                    {{ Str::limit(strip_tags($mother->description ?: $mother->story), 100, '...') }}
                                </p>
                                <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('mother', ['slug' => $mother->slug]) }}" wire:navigate>View More</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Mother profiles will be published here soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="ilm-mothers-support">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Ways to support our mothers</h2>
                <p class="ilm-section-subtitle">Practical care that helps young mothers rebuild homes, health, skills, and hope.</p>
            </div>

            <div class="ilm-mothers-support__grid">
                <article class="ilm-mother-tile ilm-mother-tile--peach">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-open-book"></i></div>
                    <h3 class="ilm-mother-tile__title">Vocational Training</h3>
                    <p class="ilm-mother-tile__text">Tailoring, baking, and small business skills that open doors to independence.</p>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--clay">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-home"></i></div>
                    <h3 class="ilm-mother-tile__title">Home Shelter & Food</h3>
                    <p class="ilm-mother-tile__text">Stable shelter and food packages while mothers rebuild their lives.</p>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--sage">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-stethoscope"></i></div>
                    <h3 class="ilm-mother-tile__title">Health Insurance</h3>
                    <p class="ilm-mother-tile__text">Protection for mother and child so health needs do not erase progress.</p>
                </article>
                <article class="ilm-mother-tile ilm-mother-tile--sand">
                    <div class="ilm-mother-tile__icon" aria-hidden="true"><i class="flaticon-drops"></i></div>
                    <h3 class="ilm-mother-tile__title">Hygiene & Sanitation</h3>
                    <p class="ilm-mother-tile__text">Essential materials that safeguard health and affirm dignity.</p>
                </article>
            </div>

            <div class="text-center mt-45">
                <a class="tp-btn ilm-btn-orange" href="{{ route('getInvolved') }}" wire:navigate>Get Involved</a>
            </div>
        </div>
    </section>

    @include('frontend.includes.bottom')
</div>
