@extends('layouts.frontbase')

@section('title', 'Our Team')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'team'])

    <section class="ilm-team-section">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Leadership team</h2>
                <p class="ilm-section-subtitle">Servants and mentors guiding the mission day to day.</p>
            </div>

            <div class="row g-4">
                @foreach ($team as $rs)
                <div class="col-lg-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <article class="ilm-team-feature">
                        <div class="ilm-team-feature__media">
                            <img src="{{ asset('storage/images/staff') . $rs->image }}" alt="{{ $rs->names }}" loading="lazy" decoding="async">
                        </div>
                        <div class="ilm-team-feature__body">
                            <h3>{{ $rs->names }}</h3>
                            <p class="ilm-team-feature__role">{{ $rs->position }}</p>
                            <p>{{ $rs->bio }}</p>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($advisors) && count($advisors))
    <section class="ilm-team-section grey-bg">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Our advisors</h2>
                <p class="ilm-section-subtitle">Wise counsel helping us stay faithful and effective.</p>
            </div>
            <div class="row justify-content-center">
                @foreach ($advisors as $adv)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <article class="ilm-team-card">
                        <div class="ilm-team-card__media">
                            <img src="{{ asset('storage/images/staff') . $adv->image }}" alt="{{ $adv->names }}" loading="lazy" decoding="async">
                        </div>
                        <h3 class="ilm-team-card__name">{{ $adv->names }}</h3>
                        <p class="ilm-team-card__role">{{ $adv->position }}</p>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('frontend.includes.backImage')

@endsection
