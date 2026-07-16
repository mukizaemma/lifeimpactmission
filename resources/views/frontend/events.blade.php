@extends('layouts.frontbase')

@section('title', 'Events')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'events'])

    <section class="ilm-events-page">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Upcoming gatherings</h2>
                <p class="ilm-section-subtitle">Outreaches, trainings, and community moments where faith meets action.</p>
            </div>

            <div class="row g-4">
                @forelse ($events as $event)
                <div class="col-lg-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".2s">
                    <article class="ilm-event-card">
                        <a href="{{ route('event', ['slug' => $event->slug]) }}" class="ilm-event-card__media">
                            <img src="{{ asset('storage/images/events/') . $event->image }}" alt="{{ $event->title }}" loading="lazy" decoding="async">
                        </a>
                        <div class="ilm-event-card__body">
                            <div class="ilm-event-card__meta">
                                @if(!empty($event->timeStart))
                                    <span><i class="far fa-clock"></i> {{ $event->timeStart }}@if(!empty($event->timeEnd)) – {{ $event->timeEnd }}@endif</span>
                                @endif
                                @if(!empty($event->location))
                                    <span><i class="fal fa-map-marker-alt"></i> {{ $event->location }}</span>
                                @endif
                            </div>
                            <h3 class="ilm-event-card__title">
                                <a href="{{ route('event', ['slug' => $event->slug]) }}">{{ $event->title }}</a>
                            </h3>
                            <a class="ilm-program__link" href="{{ route('event', ['slug' => $event->slug]) }}">
                                View details <i class="flaticon-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No upcoming events right now. Check back soon or follow our updates.</p>
                    <a class="tp-btn ilm-btn-orange mt-3" href="{{ route('posts') }}">Recent Updates</a>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('frontend.includes.backImage')

@endsection
