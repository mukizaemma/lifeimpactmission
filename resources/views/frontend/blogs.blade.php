@extends('layouts.frontbase')

@section('title', 'Updates')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'updates'])

    <section class="ilm-updates-page">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="ilm-section-title">Latest from the field</h2>
                <p class="ilm-section-subtitle">Stories, progress, and highlights from our programs across Rwanda.</p>
            </div>

            <div class="row g-4">
                @forelse ($news as $blog)
                <div class="col-xl-4 col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ min($loop->iteration + 1, 5) }}s">
                    <article class="ilm-update-card">
                        <a href="{{ route('postSingle', $blog->slug) }}" class="ilm-update-card__media">
                            <img src="{{ asset('storage/images/news/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async">
                        </a>
                        <div class="ilm-update-card__body">
                            <span class="ilm-update-date">{{ optional($blog->created_at)->format('d M, Y') }}</span>
                            <h3 class="ilm-update-card__title">
                                <a href="{{ route('postSingle', $blog->slug) }}">{{ $blog->title }}</a>
                            </h3>
                            <p class="ilm-update-card__excerpt">
                                {{ Str::limit(strip_tags($blog->body), 110, '...') }}
                            </p>
                            <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ route('postSingle', $blog->slug) }}">Read More</a>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12">
                    <div class="ilm-empty-state text-center">
                        <h3>Stories are on the way</h3>
                        <p>Field updates from young mothers, school outreaches, and community work will appear here soon.</p>
                        <a class="tp-btn ilm-btn-orange" href="{{ route('getInvolved') }}">Get Involved</a>
                    </div>
                </div>
                @endforelse
            </div>

            @if(method_exists($news, 'hasPages') && $news->hasPages())
                <div class="ilm-pagination mt-50">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </section>

    @include('frontend.includes.bottom')

@endsection
