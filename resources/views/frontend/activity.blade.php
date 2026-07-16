@extends('layouts.frontbase')

@section('content')

@php
    $isYoungMothers = str_contains(strtolower($activity->title ?? ''), 'mother');
@endphp

@include('frontend.includes.page-hero', [
    'pageKey' => 'programs',
    'heroTitle' => $activity->title,
    'heroSubtitle' => $isYoungMothers
        ? 'Vocational training, shelter, health, and mentorship that restore dignity.'
        : null,
])

<section class="ilm-activity-detail">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <article class="ilm-activity-detail__main wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <div class="ilm-activity-detail__media">
                        <img
                            src="{{ asset('storage/images/projects/' . ltrim($activity->image, '/')) }}"
                            alt="{{ $activity->title }}"
                            loading="eager"
                            decoding="async"
                        >
                    </div>
                    <h1 class="ilm-activity-detail__title">{{ $activity->title }}</h1>
                    <div class="ilm-activity-detail__text">
                        {!! nl2br(e($activity->description)) !!}
                    </div>
                </article>

                @if($isYoungMothers)
                    <div class="ilm-activity-support wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                        <span class="ilm-eyebrow">How this program supports mothers</span>
                        <h2 class="ilm-section-title">Practical care. Lasting dignity.</h2>
                        <ul class="ilm-activity-support__list">
                            <li>Vocational training in tailoring, baking, and small business</li>
                            <li>Home shelter and food packages during transition</li>
                            <li>Health insurance for mother and child</li>
                            <li>Hygiene and sanitation materials</li>
                            <li>Counseling, mentorship, and faith-centered guidance</li>
                        </ul>
                        <a class="tp-btn theme-1-bg" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Support This Work</a>
                    </div>
                @endif

                @if($images->count())
                    <div class="ilm-activity-gallery pt-60 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".35s">
                        <h2 class="ilm-section-title">Program Gallery</h2>
                        <div class="row">
                            @foreach ($images as $image)
                            <div class="col-md-6 mb-30">
                                <div class="ilm-activity-gallery__item">
                                    <a class="popup-image" href="{{ asset('storage/images/projects/' . ltrim($image->image, '/')) }}">
                                        <img
                                            src="{{ asset('storage/images/projects/' . ltrim($image->image, '/')) }}"
                                            alt="{{ $activity->title }} gallery image"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <aside class="col-lg-4">
                <div class="ilm-activity-sidebar wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                    <h3 class="ilm-activity-sidebar__title">More Programs</h3>
                    @foreach ($relatedActivities as $rs)
                        <a href="{{ route('project', ['slug' => $rs->slug]) }}" class="ilm-activity-sidebar__item">
                            <span class="ilm-activity-sidebar__thumb">
                                <img
                                    src="{{ asset('storage/images/projects') . $rs->image }}"
                                    alt="{{ $rs->title }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </span>
                            <span class="ilm-activity-sidebar__name">{{ $rs->title }}</span>
                        </a>
                    @endforeach

                    <div class="ilm-activity-sidebar__cta">
                        <p>Partner with us to empower young mothers and youth across Rwanda.</p>
                        <a class="tp-btn" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
