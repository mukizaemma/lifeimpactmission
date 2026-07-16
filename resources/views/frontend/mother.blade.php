@extends('layouts.frontbase')

@section('title', $mother->names . ' | Mother\'s Story')

@section('content')

@php
    $supportWays = [
        [
            'tone' => 'peach',
            'icon' => 'flaticon-open-book',
            'title' => 'Vocational Training',
            'text' => 'Help her learn practical skills for lasting independence.',
            'cta' => 'Support Skills',
        ],
        [
            'tone' => 'clay',
            'icon' => 'flaticon-home',
            'title' => 'Safe Housing',
            'text' => 'Provide shelter stability while she rebuilds her home.',
            'cta' => 'Support Housing',
        ],
        [
            'tone' => 'sage',
            'icon' => 'flaticon-stethoscope',
            'title' => 'Health Insurance',
            'text' => 'Protect her health and her child’s future.',
            'cta' => 'Support Health',
        ],
        [
            'tone' => 'sand',
            'icon' => 'flaticon-drops',
            'title' => 'Hygiene & Supplies',
            'text' => 'Give essential hygiene and sanitation materials.',
            'cta' => 'Support Supplies',
        ],
    ];
    $videoEmbed = $mother->videoEmbedUrl();
    $quote = $mother->quote ?: 'I found strength and purpose through this program.';
@endphp

    <section class="ilm-mother-story-banner">
        <div class="container">
            <div class="ilm-mother-story-banner__inner">
                <h1 class="ilm-section-title">Mother's Story</h1>
                <p class="ilm-section-subtitle">Empowering lives through faith and opportunity.</p>
            </div>
        </div>
    </section>

    <section class="ilm-mother-profile">
        <div class="container">
            <div class="row g-4 g-xl-5 align-items-center">
                <div class="col-lg-4">
                    <div class="ilm-mother-profile__photo">
                        <img src="{{ $mother->imageUrl() }}" alt="{{ $mother->names }}" loading="eager" decoding="async">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ilm-mother-profile__content">
                        <h2 class="ilm-mother-profile__name">{{ $mother->names }}</h2>
                        <div class="ilm-mother-profile__rule" aria-hidden="true"></div>
                        <p class="ilm-mother-profile__intro">
                            {{ $mother->description ?: 'A young mother walking toward dignity, skills, and renewed hope.' }}
                        </p>
                        <div class="ilm-mother-profile__rule" aria-hidden="true"></div>
                        <ul class="ilm-mother-profile__meta">
                            <li>
                                <span aria-hidden="true">▸</span>
                                Location: {{ $mother->location ?: 'Rwanda' }}
                            </li>
                            <li>
                                <span aria-hidden="true">▸</span>
                                Program: {{ $mother->program ?: ($mother->title ?: 'Young Mothers Empowerment') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($videoEmbed)
    <section class="ilm-mother-video">
        <div class="container">
            <div class="ilm-mother-video__frame">
                <iframe
                    src="{{ $videoEmbed }}"
                    title="{{ $mother->names }} story video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
            <p class="ilm-mother-video__caption">Her journey of hope and transformation.</p>
        </div>
    </section>
    @elseif(!empty($mother->video_url))
    <section class="ilm-mother-video">
        <div class="container text-center">
            <a class="ilm-mother-video__link" href="{{ $mother->video_url }}" target="_blank" rel="noopener">
                Watch her journey of hope and transformation
            </a>
        </div>
    </section>
    @endif

    <section class="ilm-mother-narrative">
        <div class="container">
            <div class="ilm-mother-narrative__inner">
                <h2 class="ilm-section-title">Her Story</h2>
                <div class="ilm-mother-profile__rule ilm-mother-profile__rule--center" aria-hidden="true"></div>
                <div class="ilm-mother-narrative__text">
                    {!! nl2br(e($mother->story ?: $mother->description ?: 'Her full story will be shared here soon.')) !!}
                </div>
                <blockquote class="ilm-mother-narrative__quote">
                    “{{ $quote }}”
                </blockquote>
                <div class="ilm-mother-profile__rule ilm-mother-profile__rule--center" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    <section class="ilm-mother-support-ways">
        <div class="container">
            <div class="ilm-section-divider">
                <span>Ways to Support Her</span>
            </div>

            <div class="ilm-mother-support-ways__grid">
                @foreach ($supportWays as $way)
                    <article class="ilm-support-way ilm-support-way--{{ $way['tone'] }}">
                        <div class="ilm-support-way__icon" aria-hidden="true">
                            <i class="{{ $way['icon'] }}"></i>
                        </div>
                        <h3 class="ilm-support-way__title">{{ $way['title'] }}</h3>
                        <p class="ilm-support-way__text">{{ $way['text'] }}</p>
                        <a class="ilm-support-way__btn" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">{{ $way['cta'] }}</a>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-45">
                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Get Involved</a>
            </div>
        </div>
    </section>

    <section class="ilm-mother-cta-band">
        <div class="container">
            <div class="ilm-section-divider ilm-section-divider--light">
                <span>Support the Journey of Transformation</span>
            </div>
            <div class="ilm-mother-cta-band__actions">
                <a class="tp-btn ilm-btn-outline" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate</a>
                <a class="tp-btn ilm-btn-outline" href="{{ route('contacts') }}">Become a Partner</a>
                <a class="tp-btn ilm-btn-orange" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Get Involved</a>
            </div>
        </div>
    </section>

@endsection
