@extends('layouts.frontbase')

@section('title', 'Videos Gallery')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'videos'])

    <section class="ilm-videos-page">
        <div class="container">
            <div class="text-center mb-40">
                <h2 class="ilm-section-title">Stories in motion</h2>
                <p class="ilm-section-subtitle">Watch young mothers, youth, and communities walk toward dignity and hope.</p>
            </div>

            <div class="ilm-gallery-switch text-center mb-50">
                <a class="ilm-gallery-switch__link" href="{{ route('gallery') }}">Images</a>
                <a class="ilm-gallery-switch__link is-active" href="{{ route('videos') }}">Videos</a>
            </div>

            <div class="row g-4">
                @forelse($videos as $video)
                    @php $embed = $video->videoEmbedUrl(); @endphp
                    <div class="col-lg-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                        <article class="ilm-video-card">
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
                                @if($video->program)
                                    <span class="ilm-video-card__tag">{{ $video->program->title }}</span>
                                @endif
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ilm-empty-state text-center">
                            <h3>Videos coming soon</h3>
                            <p>Program stories and field highlights will be published here. Meanwhile, explore our image gallery.</p>
                            <a class="tp-btn ilm-btn-orange" href="{{ route('gallery') }}">View Images</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('frontend.includes.bottom')

@endsection
