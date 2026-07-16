@if(isset($testimonials) && $testimonials->count())
@php $story = $testimonials->first(); @endphp
<section class="ilm-story">
    <div class="container">
        <div class="ilm-story__panel wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
            <div class="row align-items-center g-0">
                <div class="col-lg-5">
                    <div class="ilm-story__media">
                        <img
                            src="{{ asset('storage/images/testimonies') . $story->image }}"
                            alt="{{ $story->names }}"
                            loading="lazy"
                            decoding="async"
                            width="520"
                            height="560"
                        >
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ilm-story__body">
                        <h2 class="ilm-section-title">Stories that restore hope</h2>
                        <p class="ilm-section-subtitle">Real transformation from mothers and youth walking with us.</p>
                        <blockquote class="ilm-story__quote">
                            “{{ Str::limit(strip_tags($story->testimony), 280, '...') }}”
                        </blockquote>
                        <p class="ilm-story__name">{{ $story->names }}</p>
                        <div class="ilm-story__actions">
                            <a class="tp-btn ilm-btn-orange" href="{{ route('testimony', ['id' => $story->id]) }}" wire:navigate>Read Full Story</a>
                            <a class="tp-btn ilm-btn-ghost" href="{{ route('testimonials') }}" wire:navigate>More Testimonials</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
