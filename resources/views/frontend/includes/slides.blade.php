        <div class="tp-slider-3__area p-relative custom-banners">
            <div class="tp-slider-3__wrapper">
                <div class="swiper-container tp-slider-3__active">
                    <div class="swiper-wrapper">
                        @foreach ($slides as $index => $slide)
                        <div class="swiper-slide">
                            <div class="tp-slider-3__bg z-index fix p-relative ilm-hero-slide" data-background="{{ asset('storage/images/slides/'). $slide->image }}">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="tp-slider-3__content text-center">
                                                <h2 class="tp-slider-3-title pb-30">{{ $slide->heading }}</h2>
                                                @if($slide->button && $slide->link)
                                                    <a class="tp-btn theme-1-bg" href="{{ $slide->link }}" @if(str_starts_with($slide->link, 'http')) target="_blank" rel="noopener" @endif>{{ $slide->button }}</a>
                                                @elseif($slide->button)
                                                    <a class="tp-btn theme-1-bg" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">{{ $slide->button }}</a>
                                                @else
                                                    <a class="tp-btn theme-1-bg" href="https://secure.qgiv.com/for/impactlifemission" target="_blank" rel="noopener">Donate Now</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($slides->isNotEmpty())
            @push('head')
                <link rel="preload" as="image" href="{{ asset('storage/images/slides/') . $slides->first()->image }}">
            @endpush
        @endif
