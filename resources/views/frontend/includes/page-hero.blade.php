@php
    $header = isset($pageKey) ? ($pageHeaders[$pageKey] ?? null) : null;

    $heroTitle = $heroTitle ?? $header?->title ?? ($title ?? 'Page');
    $heroSubtitle = $heroSubtitle ?? $header?->subtitle;

    // Page-specific image → site default page header → theme fallback
    if (empty($heroImage)) {
        $heroImage = function_exists('ilm_page_header_url')
            ? ilm_page_header_url($header)
            : ($header?->imageUrl()
                ?? (!empty($about->image2) ? asset('storage/images/' . ltrim($about->image2, '/')) : null)
                ?? (!empty($about->image1) ? asset('storage/images/' . ltrim($about->image1, '/')) : null)
                ?? asset('assets/img/cta/cta-bg-3.jpg'));
    }

    $showHomeCrumb = $showHomeCrumb ?? true;
    $heroAlign = $heroAlign ?? 'center';
@endphp

<section class="ilm-page-hero p-relative fix" data-background="{{ $heroImage }}">
    <div class="ilm-page-hero__overlay ilm-page-hero__overlay--base" aria-hidden="true"></div>
    <div class="ilm-page-hero__overlay ilm-page-hero__overlay--accent" aria-hidden="true"></div>
    <div class="ilm-page-hero__glow" aria-hidden="true"></div>

    <div class="container ilm-page-hero__container">
        <div class="ilm-page-hero__content text-{{ $heroAlign }}">
            @if($showHomeCrumb)
                <nav class="ilm-page-hero__crumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" wire:navigate>Home</a>
                    <span class="ilm-page-hero__crumb-sep" aria-hidden="true">/</span>
                    <span class="ilm-page-hero__crumb-current">{{ $heroTitle }}</span>
                </nav>
            @endif
            <h1 class="ilm-page-hero__title">{{ $heroTitle }}</h1>
            @if($heroSubtitle)
                <p class="ilm-page-hero__subtitle">{{ $heroSubtitle }}</p>
            @endif
        </div>
    </div>

    <div class="ilm-page-hero__curve" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,48 C360,0 720,96 1080,40 C1260,12 1380,28 1440,48 L1440,80 L0,80 Z" fill="currentColor"/>
        </svg>
    </div>
</section>
