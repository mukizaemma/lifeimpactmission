@extends('layouts.frontbase')

@section('title', 'Image Gallery')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'gallery'])

    <section class="ilm-gallery-page">
        <div class="container">
            <div class="text-center mb-40">
                <h2 class="ilm-section-title">Moments that matter</h2>
                <p class="ilm-section-subtitle">Training rooms, school visits, packages delivered, and joy restored across our programs.</p>
            </div>

            <div class="ilm-gallery-switch text-center mb-40">
                <a class="ilm-gallery-switch__link is-active" href="{{ route('gallery') }}">Images</a>
                <a class="ilm-gallery-switch__link" href="{{ route('videos') }}">Videos</a>
            </div>

            <ul class="nav nav-tabs ilm-gallery-tabs justify-content-center mb-4" id="galleryTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                </li>
                @foreach($programs as $program)
                    @if($program->images->count())
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="program-{{ $program->id }}-tab" data-bs-toggle="tab" data-bs-target="#program-{{ $program->id }}" type="button" role="tab">
                                {{ $program->title }}
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>

            <div class="tab-content" id="galleryTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="row g-4">
                        @forelse($gallery as $image)
                            <div class="col-xl-4 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                                <a class="ilm-gallery-item popup-image" href="{{ $image->imageUrl() }}">
                                    <img src="{{ $image->imageUrl() }}" alt="{{ $image->caption ?: 'Gallery moment' }}" loading="lazy" decoding="async">
                                </a>
                                @if(!empty($image->caption))
                                    <p class="ilm-gallery-caption">{{ $image->caption }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="ilm-empty-state text-center">
                                    <h3>Gallery coming soon</h3>
                                    <p>Photos from trainings, outreaches, and community moments will appear here.</p>
                                    <a class="tp-btn ilm-btn-orange" href="{{ route('videos') }}">Watch Videos</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                @foreach($programs as $program)
                    @if($program->images->count())
                        <div class="tab-pane fade" id="program-{{ $program->id }}" role="tabpanel">
                            <div class="row g-4">
                                @foreach($program->images as $image)
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                        <a class="ilm-gallery-item popup-image" href="{{ $image->imageUrl() }}">
                                            <img src="{{ $image->imageUrl() }}" alt="{{ $image->caption ?: $program->title }}" loading="lazy" decoding="async">
                                        </a>
                                        @if(!empty($image->caption))
                                            <p class="ilm-gallery-caption">{{ $image->caption }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.includes.bottom')

@endsection
