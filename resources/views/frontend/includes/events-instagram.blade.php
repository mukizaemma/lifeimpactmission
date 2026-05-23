@php
    $instagramProfile = $setting->instagram ?? 'https://www.instagram.com/';
    $igType = data_get($instagramPost, 'media_type', 'post');
    $igIsReel = $igType === 'reel';
    $igEmbedUrl = data_get($instagramPost, 'embed_url');
    $igPermalink = data_get($instagramPost, 'permalink', $instagramProfile);
    $igImage = data_get($instagramPost, 'image');
@endphp

<section id="events" class="ilm-events-section ilm-events-section--pre-footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-blog-2__section-title pb-15 text-center">
                    <span class="ilm-badge">Stay Connected</span>
                    <h4 class="tp-section-title">Events & Highlights</h4>
                </div>
                <p class="ilm-section-intro">
                    Join our upcoming gatherings and follow our latest stories on Instagram.
                </p>
            </div>
        </div>

        <div class="ilm-highlight-row">
            {{-- Column 1: Event flyer --}}
            <article class="ilm-highlight-card">
                <div class="ilm-highlight-card__media">
                    @if(isset($featuredEvent) && $featuredEvent && $featuredEvent->image)
                        <a
                            href="{{ $featuredEvent->slug ? route('event', ['slug' => $featuredEvent->slug]) : route('upcomingEvents') }}"
                            class="ilm-event-flyer"
                            aria-label="View {{ $featuredEvent->title }}"
                        >
                            <img
                                src="{{ asset('storage/images/events/' . $featuredEvent->image) }}"
                                alt="{{ $featuredEvent->title }} event flyer"
                                loading="lazy"
                                decoding="async"
                            >
                        </a>
                    @else
                        <div class="ilm-event-flyer ilm-event-flyer--empty">
                            <i class="far fa-calendar-star fa-3x mb-3 opacity-75"></i>
                            <h5 class="text-white mb-2">No events to display yet</h5>
                            <p class="mb-0 opacity-75 small">Add an event in the admin panel to show a flyer here.</p>
                        </div>
                    @endif
                </div>
                <div class="ilm-highlight-card__body">
                    @if(isset($featuredEvent) && $featuredEvent)
                        <span class="ilm-badge">
                            {{ !empty($eventIsUpcoming) ? 'Upcoming Event' : 'Latest Event' }}
                        </span>
                        <h4 class="tp-blog-2__title-sm mb-15">{{ $featuredEvent->title }}</h4>
                        @if($featuredEvent->date)
                            <p class="ilm-event-meta">
                                <i class="far fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($featuredEvent->date)->format('l, F j, Y') }}
                                @if($featuredEvent->timeStart)
                                    &nbsp;·&nbsp;
                                    <i class="far fa-clock"></i>
                                    {{ $featuredEvent->timeStart }}
                                    @if($featuredEvent->timeEnd) – {{ $featuredEvent->timeEnd }} @endif
                                @endif
                            </p>
                        @endif
                        @if($featuredEvent->location)
                            <p class="ilm-event-meta"><i class="fal fa-map-marker-alt"></i>{{ $featuredEvent->location }}</p>
                        @endif
                        @if($featuredEvent->description)
                            <p class="ilm-card-text mb-20">{{ Str::limit(strip_tags($featuredEvent->description), 140) }}</p>
                        @endif
                        <div class="mt-auto d-flex flex-wrap gap-2">
                            @if($featuredEvent->registerLink)
                                <a class="tp-btn" href="{{ $featuredEvent->registerLink }}" target="_blank" rel="noopener">Register</a>
                            @endif
                            @if($featuredEvent->slug)
                                <a class="tp-btn theme-1-bg" href="{{ route('event', ['slug' => $featuredEvent->slug]) }}">Event Details</a>
                            @endif
                            <a class="tp-btn" href="{{ route('upcomingEvents') }}">All Events</a>
                        </div>
                    @else
                        <span class="ilm-badge">Events</span>
                        <p class="ilm-card-text mb-20">Stay tuned for our next outreach, conference, or community gathering.</p>
                        <a class="tp-btn theme-1-bg" href="{{ route('upcomingEvents') }}">View Events</a>
                    @endif
                </div>
            </article>

            {{-- Column 2: Instagram post or reel --}}
            <article class="ilm-highlight-card">
                <div class="ilm-highlight-card__media">
                    @if($igEmbedUrl)
                        <div class="ilm-ig-media">
                            <span class="ilm-ig-type-badge">
                                <i class="fab fa-instagram"></i>
                                {{ $igIsReel ? 'Instagram Reel' : 'Instagram Post' }}
                            </span>
                            <iframe
                                src="{{ $igEmbedUrl }}"
                                class="ilm-ig-embed {{ $igIsReel ? 'ilm-ig-embed--reel' : 'ilm-ig-embed--post' }}"
                                allowfullscreen
                                loading="lazy"
                                title="Latest Instagram {{ $igIsReel ? 'reel' : 'post' }} from Impact Life Mission"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    @elseif($igImage)
                        <div class="ilm-ig-media">
                            <a
                                href="{{ $igPermalink }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="ilm-ig-thumb {{ $igIsReel ? 'ilm-ig-thumb--reel' : 'ilm-ig-thumb--post' }}"
                            >
                                <span class="ilm-ig-type-badge">
                                    <i class="fab fa-instagram"></i>
                                    {{ $igIsReel ? 'Reel' : 'Post' }}
                                </span>
                                <img
                                    src="{{ $igImage }}"
                                    alt="Latest Instagram {{ $igIsReel ? 'reel' : 'post' }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                                @if($igIsReel)
                                    <span class="ilm-ig-play-overlay" aria-hidden="true">
                                        <span><i class="fas fa-play"></i></span>
                                    </span>
                                @endif
                            </a>
                        </div>
                    @else
                        <a href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer" class="ilm-instagram-card__placeholder">
                            <i class="fab fa-instagram"></i>
                            <p class="mb-0">Add your latest post URL in Settings to display it here</p>
                        </a>
                    @endif
                </div>
                <div class="ilm-highlight-card__body">
                    <span class="ilm-badge"><i class="fab fa-instagram me-1"></i> Latest on Instagram</span>
                    @if(data_get($instagramPost, 'caption'))
                        <p class="ilm-card-text mb-20">{{ Str::limit(data_get($instagramPost, 'caption'), 140) }}</p>
                    @else
                        <p class="ilm-card-text mb-20">
                            @if($igIsReel)
                                Watch our latest reel from the field — outreaches, worship, and community moments.
                            @else
                                See photos and stories from our programs, outreaches, and impact in the community.
                            @endif
                        </p>
                    @endif
                    <a class="tp-btn theme-1-bg mt-auto" href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer">
                        View More Highlights <i class="flaticon-arrow-right ms-1"></i>
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>
