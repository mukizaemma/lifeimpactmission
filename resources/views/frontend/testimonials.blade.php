<div class="ilm-page">
@include('frontend.includes.page-hero', ['pageKey' => 'testimonials'])

    <section class="ilm-testimonials-page">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Voices of change</h2>
                <p class="ilm-section-subtitle">Mothers, youth, and community members sharing how hope was restored.</p>
            </div>

            <div class="row g-4">
                @forelse ($testimonials as $rs)
                <div class="col-xl-4 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <article class="ilm-key-card">
                        <a href="{{ route('testimony', ['id' => $rs->id]) }}" class="ilm-key-card__media" wire:navigate>
                            <img src="{{ ilm_image_url('images/testimonies', $rs->image)}}" alt="{{ $rs->names }}" loading="lazy" decoding="async">
                            <span class="ilm-key-card__shine" aria-hidden="true"></span>
                        </a>
                        <div class="ilm-key-card__body">
                            <h3 class="ilm-key-card__title">
                                <a href="{{ route('testimony', ['id' => $rs->id]) }}" wire:navigate>{{ $rs->names }}</a>
                            </h3>
                            <p class="ilm-key-card__text">{{ Str::limit(strip_tags($rs->testimony), 120, '...') }}</p>
                            <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('testimony', ['id' => $rs->id]) }}" wire:navigate>Read Story</a>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12 text-center"><p>Testimonials will appear here soon.</p></div>
                @endforelse
            </div>
        </div>
    </section>

    @if(isset($videos) && $videos->count())
    <section class="ilm-testimonials-videos">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Stories on video</h2>
                <p class="ilm-section-subtitle">Watch shared YouTube stories from our community.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($videos as $video)
                    @php $embed = $video->videoEmbedUrl(); @endphp
                    <div class="col-xl-4 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                        <article class="ilm-video-card ilm-video-card--portrait">
                            @if($embed)
                                <div class="ilm-video-card__frame">
                                    <iframe
                                        src="{{ $embed }}"
                                        title="{{ $video->title }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy"
                                    ></iframe>
                                </div>
                            @else
                                <a class="ilm-video-card__thumb" href="{{ $video->video_url }}" target="_blank" rel="noopener">
                                    <img src="{{ $video->thumbnailUrl() }}" alt="{{ $video->title }}" loading="lazy" decoding="async">
                                    <span class="ilm-video-card__play" aria-hidden="true">▶</span>
                                </a>
                            @endif
                            <div class="ilm-video-card__body">
                                <h3 class="ilm-video-card__title">{{ $video->title }}</h3>
                                @if(!empty($video->caption))
                                    <p class="ilm-video-card__caption">{{ $video->caption }}</p>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-40">
                <a class="tp-btn ilm-btn-outline" href="{{ route('videos') }}" wire:navigate>View all videos</a>
            </div>
        </div>
    </section>
    @endif

    @include('frontend.includes.backImage')
</div>
