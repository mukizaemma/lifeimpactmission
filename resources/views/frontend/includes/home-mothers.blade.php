<section class="ilm-home-mothers" id="mothers">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="ilm-section-title">Meet our mothers</h2>
            <p class="ilm-section-subtitle">Inspiring young mothers whose journeys show how skills, support, and dignity restore hope.</p>
        </div>

        @if(isset($mothers) && $mothers->isNotEmpty())
            <div class="row g-4">
                @foreach ($mothers as $mother)
                    <div class="col-xl-3 col-lg-3 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                        <article class="ilm-mother-profile-card">
                            <div class="ilm-mother-profile-card__media">
                                <img src="{{ $mother->imageUrl() }}" alt="{{ $mother->names }}" loading="lazy" decoding="async">
                            </div>
                            <div class="ilm-mother-profile-card__body">
                                <h3 class="ilm-mother-profile-card__name">{{ $mother->names }}</h3>
                                <p class="ilm-mother-profile-card__text">
                                    {{ Str::limit(strip_tags($mother->description ?: $mother->story), 90, '...') }}
                                </p>
                                <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('mother', ['slug' => $mother->slug]) }}">View More</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-45">
                <a class="tp-btn ilm-btn-orange" href="{{ route('mothers') }}">View More Mothers</a>
            </div>
        @else
            <div class="text-center">
                <p class="ilm-section-subtitle">Mother profiles will appear here soon.</p>
                <a class="tp-btn ilm-btn-orange" href="{{ route('mothers') }}">Explore Mothers Program</a>
            </div>
        @endif
    </div>
</section>
