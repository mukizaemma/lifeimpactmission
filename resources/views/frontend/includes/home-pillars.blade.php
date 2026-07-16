@php
    $motherPillars = [
        [
            'title' => 'Vocational Training',
            'text' => 'Tailoring, baking, and small business skills that restore confidence and open doors to economic independence.',
            'tone' => 'peach',
            'svg' => '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 44h40v6H12v-6zm6-22h8v6h-8v-6zm20 0h8v6h-8v-6zM18 18h28v4H18v-4zm-2 28V28h32v18H16z" fill="currentColor"/><circle cx="32" cy="36" r="4" fill="currentColor"/></svg>',
        ],
        [
            'title' => 'Home Shelter & Food Packages',
            'text' => 'Safe shelter and nourishing food packages while young mothers rebuild stable homes for their children.',
            'tone' => 'clay',
            'svg' => '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M32 10L8 30h6v24h16V40h4v14h16V30h6L32 10z" fill="currentColor"/><path d="M28 36h8v8h-8v-8z" fill="#fff" fill-opacity=".35"/></svg>',
        ],
        [
            'title' => 'Health Insurance',
            'text' => 'Health coverage that protects mothers and children so illness does not erase hard-won progress.',
            'tone' => 'sage',
            'svg' => '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M32 8c-10 8-20 12-20 26 0 14 12 22 20 26 8-4 20-12 20-26 0-14-10-18-20-26z" fill="currentColor"/><path d="M29 24h6v7h7v6h-7v7h-6v-7h-7v-6h7v-7z" fill="#fff"/></svg>',
        ],
        [
            'title' => 'Hygiene & Sanitation',
            'text' => 'Essential hygiene and sanitation materials that safeguard health and affirm every person’s dignity.',
            'tone' => 'sand',
            'svg' => '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M28 8h8v10c8 2 14 10 14 18v20H14V36c0-8 6-16 14-18V8z" fill="currentColor"/><path d="M24 40h16v4H24v-4zm0 8h16v4H24v-4z" fill="#fff" fill-opacity=".4"/></svg>',
        ],
    ];
@endphp

<section class="ilm-mothers" id="young-mothers">
    <div class="container">
        <div class="text-center mb-50">
            <h2 class="ilm-section-title">Empowering <span class="ilm-text-accent">Young Mothers</span></h2>
            <p class="ilm-section-subtitle">Practical care that restores dignity—skills, shelter, health, and hygiene for mothers rebuilding their lives.</p>
        </div>

        <div class="ilm-mothers__grid">
            @foreach ($motherPillars as $pillar)
                <article class="ilm-mother-tile ilm-mother-tile--{{ $pillar['tone'] }} wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".{{ $loop->iteration + 1 }}s">
                    <div class="ilm-mother-tile__icon">{!! $pillar['svg'] !!}</div>
                    <h3 class="ilm-mother-tile__title">{{ $pillar['title'] }}</h3>
                    <p class="ilm-mother-tile__text">{{ $pillar['text'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-45">
            @php
                $mothersProgram = collect($ourPrograms ?? [])->first(function ($program) {
                    $title = strtolower($program->title ?? '');
                    return str_contains($title, 'young mother') || str_contains($title, 'mother');
                });
            @endphp
            @if($mothersProgram)
                <a class="tp-btn ilm-btn-orange" href="{{ route('project', ['slug' => $mothersProgram->slug]) }}">Explore This Program</a>
            @else
                <a class="tp-btn ilm-btn-orange" href="{{ route('showPrograms') }}">Explore Our Programs</a>
            @endif
        </div>
    </div>
</section>
