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

    // Lightweight preview only — never fetch Instagram embeds/oEmbed on page paint.
    if (! isset($instagramPost)) {
        $instagramPost = app(\App\Services\InstagramService::class)->getCardPreview();
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
    $igImage = data_get($instagramPost, 'image');
    $igModalId = 'ilm-ig-feed-modal';
    $igFeedUrl = route('instagram.feed');
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
                data-ilm-ig-feed-url="{{ $igFeedUrl }}"
                aria-haspopup="dialog"
                aria-controls="{{ $igModalId }}"
                aria-label="View Instagram posts from {{ $instagramHandle }}"
            >
                @if($igImage)
                    <span class="ilm-impact-spotlight__thumb">
                        <img
                            src="{{ $igImage }}"
                            alt="Latest Instagram {{ $igIsReel ? 'reel' : 'post' }} from Impact Life Mission"
                            loading="lazy"
                            decoding="async"
                            fetchpriority="low"
                        >
                        @if($igIsReel)
                            <span class="ilm-ig-play-overlay" aria-hidden="true">
                                <span><i class="fas fa-play"></i></span>
                            </span>
                        @endif
                    </span>
                @else
                    <span class="ilm-impact-spotlight__placeholder">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <p>Tap to view our latest Instagram posts</p>
                    </span>
                @endif
                <span class="ilm-impact-spotlight__ig-badge" aria-hidden="true">
                    <i class="fab fa-instagram"></i> View posts
                </span>
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
    data-ilm-ig-feed-url="{{ $igFeedUrl }}"
    data-ilm-ig-profile="{{ $instagramProfile }}"
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

        <div class="ilm-ig-feed-modal__body" data-ilm-ig-body>
            <div class="ilm-ig-feed-modal__loading" data-ilm-ig-loading>
                <span class="ilm-ig-feed-modal__spinner" aria-hidden="true"></span>
                <p>Loading posts…</p>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    if (window.__ilmIgFeedModalBound) return;
    window.__ilmIgFeedModalBound = true;

    var feedCache = null;
    var feedPromise = null;

    function qs(root, sel) {
        return (root || document).querySelector(sel);
    }

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function setModalMode(modal, count) {
        modal.classList.remove('ilm-ig-feed-modal--single', 'ilm-ig-feed-modal--multi');
        modal.classList.add(count > 1 ? 'ilm-ig-feed-modal--multi' : 'ilm-ig-feed-modal--single');
    }

    function renderPosts(modal, posts, profile) {
        var body = qs(modal, '[data-ilm-ig-body]');
        if (!body) return;

        if (!posts || !posts.length) {
            setModalMode(modal, 0);
            body.innerHTML =
                '<div class="ilm-ig-feed-modal__empty">' +
                '<i class="fab fa-instagram" aria-hidden="true"></i>' +
                '<p>No Instagram posts are ready to display yet. Add post URLs in Contacts Settings.</p>' +
                '<a class="tp-btn ilm-btn-orange" href="' + escapeHtml(profile) + '" target="_blank" rel="noopener noreferrer">Visit our Instagram</a>' +
                '</div>';
            return;
        }

        setModalMode(modal, posts.length);

        var html = '<div class="ilm-ig-feed-modal__grid">';
        posts.forEach(function (post) {
            var type = post.media_type === 'reel' ? 'reel' : 'post';
            html += '<article class="ilm-ig-feed-modal__item">';
            if (post.embed_url) {
                html +=
                    '<iframe data-src="' + escapeHtml(post.embed_url) + '" ' +
                    'class="ilm-ig-feed-modal__embed" title="Instagram ' + type + ' from Impact Life Mission" ' +
                    'loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>';
            } else if (post.image) {
                html +=
                    '<a href="' + escapeHtml(post.permalink || profile) + '" target="_blank" rel="noopener noreferrer" class="ilm-ig-feed-modal__thumb">' +
                    '<img src="' + escapeHtml(post.image) + '" alt="Instagram post from Impact Life Mission" loading="lazy" decoding="async">' +
                    '</a>';
            }
            html += '</article>';
        });
        html += '</div>';
        body.innerHTML = html;

        // Activate embeds only after the modal is open (keeps homepage free of IG iframes).
        body.querySelectorAll('iframe[data-src]').forEach(function (frame) {
            frame.src = frame.getAttribute('data-src');
            frame.removeAttribute('data-src');
        });
    }

    function fetchFeed(url) {
        if (feedCache) return Promise.resolve(feedCache);
        if (feedPromise) return feedPromise;

        feedPromise = fetch(url, {
            headers: { Accept: 'application/json' },
            credentials: 'same-origin'
        })
            .then(function (res) {
                if (!res.ok) throw new Error('Feed request failed');
                return res.json();
            })
            .then(function (data) {
                feedCache = data || { posts: [] };
                return feedCache;
            })
            .catch(function () {
                feedPromise = null;
                return { posts: [], profile: null };
            });

        return feedPromise;
    }

    function openModal(modal) {
        if (!modal) return;

        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('ilm-ig-feed-open');

        var body = qs(modal, '[data-ilm-ig-body]');
        var profile = modal.getAttribute('data-ilm-ig-profile') || 'https://www.instagram.com/';
        var feedUrl = modal.getAttribute('data-ilm-ig-feed-url');

        if (!feedCache && body) {
            body.innerHTML =
                '<div class="ilm-ig-feed-modal__loading" data-ilm-ig-loading>' +
                '<span class="ilm-ig-feed-modal__spinner" aria-hidden="true"></span>' +
                '<p>Loading posts…</p>' +
                '</div>';
        }

        if (feedUrl) {
            fetchFeed(feedUrl).then(function (data) {
                renderPosts(modal, data.posts || [], data.profile || profile);
            });
        }

        var closeBtn = qs(modal, '[data-ilm-ig-close].ilm-ig-feed-modal__close');
        if (closeBtn) closeBtn.focus();
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('ilm-ig-feed-open');

        // Unload iframes so they stop network/CPU when closed.
        modal.querySelectorAll('iframe').forEach(function (frame) {
            if (frame.src) {
                frame.setAttribute('data-src', frame.src);
                frame.removeAttribute('src');
            }
        });
    }

    document.addEventListener('click', function (event) {
        var openTrigger = event.target.closest('[data-ilm-ig-open]');
        if (openTrigger) {
            event.preventDefault();
            openModal(document.getElementById(openTrigger.getAttribute('data-ilm-ig-open')));
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
