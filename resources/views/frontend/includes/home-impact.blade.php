@php
    if (! isset($impacts) || (is_object($impacts) && method_exists($impacts, 'isEmpty') && $impacts->isEmpty())) {
        $impacts = \App\Models\Impact::where('status', 'Active')->latest()->take(5)->get();
        if ($impacts->isEmpty()) {
            $impacts = \App\Models\Impact::latest()->take(5)->get();
        }
    }

    $impactBullets = collect($impacts ?? [])
        ->map(function ($impact) {
            $description = trim((string) ($impact->description ?? ''));
            $title = trim((string) ($impact->title ?? ''));
            if ($description !== '') {
                return $description;
            }
            if ($title !== '' && ! preg_match('/^[\d,.\s+kKmM%]+$/', $title)) {
                return $title;
            }

            return null;
        })
        ->filter()
        ->unique()
        ->take(5)
        ->values();

    if ($impactBullets->isEmpty()) {
        $impactBullets = collect([
            'Young mothers equipped with vocational skills, shelter support, and renewed dignity',
            'Students mentored through school outreaches that restore purpose and hope',
            'Emerging leaders trained to multiply care across their communities',
            'Transparent partnership pathways with clear reporting and shared outcomes',
            'Faith-centered programs that turn generosity into lasting community change',
        ]);
    }

    $instagramService = app(\App\Services\InstagramService::class);

    if (! isset($instagramFeed)) {
        $instagramFeed = $instagramService->getFeedPosts(6);
    }

    if (! isset($instagramPost)) {
        $instagramPost = $instagramFeed[0] ?? $instagramService->getLatestPost();
    }

    $instagramProfile = trim((string) ($setting->instagram ?? ''));
    if ($instagramProfile === '') {
        $instagramProfile = 'https://www.instagram.com/';
    }

    $instagramHandle = 'Impact Life Mission';
    if (preg_match('#instagram\.com/([A-Za-z0-9._]+)/?#i', $instagramProfile, $handleMatch)) {
        $candidate = $handleMatch[1];
        if (! in_array(strtolower($candidate), ['p', 'reel', 'reels', 'stories', 'explore'], true)) {
            $instagramHandle = '@' . $candidate;
        }
    }

    $igType = data_get($instagramPost, 'media_type', 'post');
    $igIsReel = $igType === 'reel';
    $igEmbedUrl = data_get($instagramPost, 'embed_url');
    $igImage = data_get($instagramPost, 'image');
    $igModalId = 'ilm-ig-feed-modal';
@endphp

<section class="ilm-impact-spotlight" id="our-impact">
    <div class="ilm-impact-spotlight__inner">
        <div class="ilm-impact-spotlight__copy wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".2s">
            <span class="ilm-impact-spotlight__eyebrow">Proven Outcomes</span>
            <h2 class="ilm-impact-spotlight__title">Our Impact</h2>
            <p class="ilm-impact-spotlight__text">
                Partners help us turn faith into measurable change—restoring dignity for young mothers,
                mentoring youth, and building communities that keep growing beyond a single gift.
            </p>
            <ul class="ilm-impact-spotlight__points">
                @foreach($impactBullets as $bullet)
                    <li>{{ $bullet }}</li>
                @endforeach
            </ul>
            <div class="ilm-impact-spotlight__actions">
                <a class="tp-btn ilm-btn-orange" href="{{ route('impact') }}" wire:navigate>View More</a>
                <a class="tp-btn ilm-btn-ghost" href="{{ route('getInvolved') }}" wire:navigate>Get Involved</a>
            </div>
        </div>

        <div class="ilm-impact-spotlight__media wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".35s">
            <button
                type="button"
                class="ilm-impact-spotlight__frame"
                data-ilm-ig-open="{{ $igModalId }}"
                aria-haspopup="dialog"
                aria-controls="{{ $igModalId }}"
                aria-label="View Instagram posts from {{ $instagramHandle }}"
            >
                @if($igEmbedUrl)
                    <iframe
                        src="{{ $igEmbedUrl }}"
                        class="ilm-impact-spotlight__embed"
                        tabindex="-1"
                        loading="lazy"
                        title="Latest Instagram {{ $igIsReel ? 'reel' : 'post' }} from Impact Life Mission"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <span class="ilm-impact-spotlight__ig-badge" aria-hidden="true">
                        <i class="fab fa-instagram"></i> View posts
                    </span>
                @elseif($igImage)
                    <span class="ilm-impact-spotlight__thumb">
                        <img
                            src="{{ $igImage }}"
                            alt="Latest Instagram {{ $igIsReel ? 'reel' : 'post' }} from Impact Life Mission"
                            loading="lazy"
                            decoding="async"
                        >
                        @if($igIsReel)
                            <span class="ilm-ig-play-overlay" aria-hidden="true">
                                <span><i class="fas fa-play"></i></span>
                            </span>
                        @endif
                    </span>
                    <span class="ilm-impact-spotlight__ig-badge" aria-hidden="true">
                        <i class="fab fa-instagram"></i> View posts
                    </span>
                @else
                    <span class="ilm-impact-spotlight__placeholder">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <p>Add Instagram post URLs in Contacts Settings to feature our latest activity here.</p>
                    </span>
                @endif
            </button>
        </div>
    </div>
</section>

<div
    id="{{ $igModalId }}"
    class="ilm-ig-feed-modal"
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    aria-labelledby="{{ $igModalId }}-title"
    hidden
>
    <div class="ilm-ig-feed-modal__backdrop" data-ilm-ig-close tabindex="-1"></div>
    <div class="ilm-ig-feed-modal__panel" role="document">
        <div class="ilm-ig-feed-modal__header">
            <div>
                <p class="ilm-ig-feed-modal__eyebrow"><i class="fab fa-instagram" aria-hidden="true"></i> Our Instagram</p>
                <h3 id="{{ $igModalId }}-title" class="ilm-ig-feed-modal__title">{{ $instagramHandle }}</h3>
            </div>
            <div class="ilm-ig-feed-modal__header-actions">
                <a class="tp-btn ilm-btn-orange ilm-ig-feed-modal__follow" href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer">
                    Open Profile
                </a>
                <button type="button" class="ilm-ig-feed-modal__close" data-ilm-ig-close aria-label="Close Instagram posts">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="ilm-ig-feed-modal__body">
            @if(!empty($instagramFeed))
                <div class="ilm-ig-feed-modal__grid">
                    @foreach($instagramFeed as $feedPost)
                        @php
                            $feedEmbed = data_get($feedPost, 'embed_url');
                            $feedImage = data_get($feedPost, 'image');
                            $feedPermalink = data_get($feedPost, 'permalink', $instagramProfile);
                            $feedType = data_get($feedPost, 'media_type', 'post');
                            $feedIsReel = $feedType === 'reel';
                        @endphp
                        <article class="ilm-ig-feed-modal__item">
                            @if($feedEmbed)
                                <iframe
                                    src="{{ $feedEmbed }}"
                                    class="ilm-ig-feed-modal__embed"
                                    loading="lazy"
                                    title="Instagram {{ $feedIsReel ? 'reel' : 'post' }} from Impact Life Mission"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    allowfullscreen
                                ></iframe>
                            @elseif($feedImage)
                                <a href="{{ $feedPermalink }}" target="_blank" rel="noopener noreferrer" class="ilm-ig-feed-modal__thumb">
                                    <img src="{{ $feedImage }}" alt="Instagram post from Impact Life Mission" loading="lazy" decoding="async">
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="ilm-ig-feed-modal__empty">
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                    <p>No Instagram posts are ready to display yet. Add one or more post URLs in Contacts Settings, or connect the Instagram API.</p>
                    <a class="tp-btn ilm-btn-orange" href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer">Visit our Instagram</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
(function () {
    if (window.__ilmIgFeedModalBound) return;
    window.__ilmIgFeedModalBound = true;

    function panel(id) {
        return document.getElementById(id);
    }

    function openModal(id) {
        var modal = panel(id);
        if (!modal) return;
        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('ilm-ig-feed-open');
        var closeBtn = modal.querySelector('[data-ilm-ig-close].ilm-ig-feed-modal__close');
        if (closeBtn) closeBtn.focus();
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('ilm-ig-feed-open');
    }

    document.addEventListener('click', function (event) {
        var openTrigger = event.target.closest('[data-ilm-ig-open]');
        if (openTrigger) {
            event.preventDefault();
            openModal(openTrigger.getAttribute('data-ilm-ig-open'));
            return;
        }

        var closeTrigger = event.target.closest('[data-ilm-ig-close]');
        if (closeTrigger) {
            closeModal(closeTrigger.closest('.ilm-ig-feed-modal'));
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;
        document.querySelectorAll('.ilm-ig-feed-modal:not([hidden])').forEach(closeModal);
    });
})();
</script>
