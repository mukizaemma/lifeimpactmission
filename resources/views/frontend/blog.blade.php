<div class="ilm-page">
@php
    $galleryImages = $images ?? collect();
    $related = ($relatedBlogs instanceof \Illuminate\Support\Collection)
        ? $relatedBlogs
        : collect($relatedBlogs ?? []);
@endphp

    <section class="ilm-update-banner">
        <div class="container">
            <div class="ilm-update-banner__inner">
                <p class="ilm-update-banner__eyebrow">
                    <a href="{{ route('posts') }}" wire:navigate>Updates</a>
                    <span aria-hidden="true">/</span>
                    Story
                </p>
                <h1 class="ilm-section-title">{{ $blog->title }}</h1>
                <p class="ilm-section-subtitle">
                    {{ optional($blog->created_at)->format('d M, Y') }}
                    @if(!empty($blog->author))
                        · {{ $blog->author }}
                    @endif
                </p>
            </div>
        </div>
    </section>

    <section class="ilm-update-article">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    @if(!empty($blog->image))
                        <div class="ilm-update-article__hero">
                            <img src="{{ ilm_image_url('images/news', $blog->image) }}" alt="{{ $blog->title }}" loading="eager" decoding="async">
                        </div>
                    @endif

                    <div class="ilm-update-article__body">
                        {!! nl2br(e($blog->body)) !!}
                    </div>

                    @if($galleryImages->count())
                        <div class="ilm-update-article__gallery">
                            <h2 class="ilm-update-article__gallery-title">From this story</h2>
                            <div class="row g-3">
                                @foreach($galleryImages as $image)
                                    <div class="col-md-6">
                                        <a class="ilm-gallery-item popup-image" href="{{ $image->imageUrl() }}">
                                            <img src="{{ $image->imageUrl() }}" alt="{{ $image->caption ?: $blog->title }}" loading="lazy" decoding="async">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <aside class="ilm-update-sidebar">
                        <h2 class="ilm-update-sidebar__title">More updates</h2>
                        <div class="ilm-update-sidebar__list">
                            @forelse($related as $rs)
                                <a class="ilm-update-related" href="{{ route('postSingle', $rs->slug) }}" wire:navigate>
                                    <span class="ilm-update-related__media">
                                        <img src="{{ ilm_image_url('images/news', $rs->image) }}" alt="" loading="lazy" decoding="async">
                                    </span>
                                    <span class="ilm-update-related__body">
                                        <span class="ilm-update-related__date">{{ optional($rs->created_at)->format('d M, Y') }}</span>
                                        <span class="ilm-update-related__title">{{ $rs->title }}</span>
                                    </span>
                                </a>
                            @empty
                                <p>More stories will appear here soon.</p>
                            @endforelse
                        </div>
                        <a class="tp-btn ilm-btn-orange ilm-btn-sm mt-20" href="{{ route('posts') }}" wire:navigate>All Updates</a>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.includes.bottom')
</div>
