@php
    $programOrder = function ($program) {
        $title = strtolower($program->title ?? '');
        if (str_contains($title, 'school') || str_contains($title, 'outreach')) {
            return 0;
        }
        if (str_contains($title, 'young mother') || str_contains($title, 'mother')) {
            return 1;
        }
        if (str_contains($title, 'leadership')) {
            return 2;
        }
        return 3;
    };

    $orderedPrograms = collect($ourPrograms ?? [])->sortBy($programOrder)->values();

    $fallbackPrograms = [
        (object) [
            'title' => 'School Outreaches',
            'slug' => null,
            'image' => null,
            'description' => 'Faith-based guidance and mentorship that help students value their lives, make healthy choices, and find purpose.',
            'fallback_image' => !empty($about->image) ? asset('storage/images/' . $about->image) : asset('assets/img/blog/blog-1.jpg'),
        ],
        (object) [
            'title' => 'Young Mothers Empowerment',
            'slug' => null,
            'image' => null,
            'description' => 'Counseling, life skills, and vocational training so teen mothers rebuild confidence and raise children in dignity.',
            'fallback_image' => !empty($about->image1) ? asset('storage/images/' . $about->image1) : asset('assets/img/blog/blog-2.jpg'),
        ],
        (object) [
            'title' => 'Leadership Empowerment',
            'slug' => null,
            'image' => null,
            'description' => 'Seminars and mentoring that raise leaders grounded in integrity, faith, and responsibility.',
            'fallback_image' => !empty($about->image2) ? asset('storage/images/' . $about->image2) : asset('assets/img/blog/blog-3.jpg'),
        ],
    ];

    if ($orderedPrograms->isEmpty()) {
        $orderedPrograms = collect($fallbackPrograms);
    }
@endphp

<section class="ilm-key-programs" id="programs">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="ilm-section-title">Key Programs</h2>
            <p class="ilm-section-subtitle">Three pathways of hope—reaching students, empowering young mothers, and raising community leaders.</p>
        </div>

        <div class="row g-4">
            @foreach ($orderedPrograms->take(3) as $rs)
                @php
                    $desc = trim(strip_tags($rs->description ?? ''));
                    $excerpt = $desc !== '' ? Str::limit($desc, 130, '...') : '';
                    $href = !empty($rs->slug) ? route('project', ['slug' => $rs->slug]) : route('showPrograms');
                    $img = !empty($rs->image)
                        ? asset('storage/images/projects') . $rs->image
                        : ($rs->fallback_image ?? asset('assets/img/blog/blog-1.jpg'));
                @endphp
                <div class="col-lg-4 col-md-6 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                    <article class="ilm-key-card">
                        <a href="{{ $href }}" class="ilm-key-card__media">
                            <img src="{{ $img }}" alt="{{ $rs->title }}" loading="lazy" decoding="async" width="480" height="280">
                            <span class="ilm-key-card__shine" aria-hidden="true"></span>
                        </a>
                        <div class="ilm-key-card__body">
                            <h3 class="ilm-key-card__title"><a href="{{ $href }}">{{ $rs->title }}</a></h3>
                            <p class="ilm-key-card__text">{{ $excerpt }}</p>
                            <a class="tp-btn ilm-btn-orange ilm-btn-sm" href="{{ $href }}">Learn More</a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
