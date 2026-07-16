<section class="ilm-testimonials-page pt-60">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="ilm-section-title">Voices of change</h2>
            <p class="ilm-section-subtitle">Mothers, youth, and community members sharing how hope was restored.</p>
        </div>
        <div class="row g-4">
            @foreach ($testimonials as $rs)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                <article class="ilm-key-card">
                    <a href="{{ route('testimony',['id'=>$rs->id]) }}" class="ilm-key-card__media" wire:navigate>
                        <img src="{{ asset('storage/images/testimonies') . $rs->image }}" alt="{{ $rs->names }}" loading="lazy" decoding="async" width="480" height="250">
                        <span class="ilm-key-card__shine" aria-hidden="true"></span>
                    </a>
                    <div class="ilm-key-card__body">
                        <h3 class="ilm-key-card__title"><a href="{{ route('testimony',['id'=>$rs->id]) }}" wire:navigate>{{ $rs->names }}</a></h3>
                        <p class="ilm-key-card__text">{{ Str::limit(strip_tags($rs->testimony), 100, '...') }}</p>
                        <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('testimony',['id'=>$rs->id]) }}" wire:navigate>Read Story</a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-30">
            <a class="tp-btn ilm-btn-orange" href="{{ route('testimonials') }}" wire:navigate>View More Testimonials</a>
        </div>
    </div>
</section>
