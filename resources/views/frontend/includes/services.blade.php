    <div class="tp-blog-2__area tp-blog-2__space" id="programs">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-blog-2__section-title pb-50 text-center">
                        <h4 class="tp-section-title">Our Programs</h4>
                    </div>
                </div>
            </div>
            <div class="row ilm-card-grid">
                @foreach ($ourPrograms as $rs)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                data-wow-delay=".3s">
                    <div class="tp-blog-2__item ilm-card">
                        <a href="{{route('project',['slug'=>$rs->slug])}}">
                            <div class="tp-blog-2__thumb p-relative">
                                <img
                                    src="{{ asset('storage/images/projects') . $rs->image }}"
                                    alt="{{ $rs->title }}"
                                    loading="lazy"
                                    decoding="async"
                                    width="480"
                                    height="250"
                                >
                            </div>
                        </a>
                        <div class="tp-blog-2__content ilm-card-body">
                            <div class="tp-blog-2__tag">
                                <a href="{{route('project',['slug'=>$rs->slug])}}"><h5 class="tp-donate__title">{{ $rs->title }}</h5></a>
                            </div>

                            <div class="tp-about-3__text ilm-card-text">
                                @php
                                $words = Str::limit($rs->description, 100, '...');
                                @endphp

                                <p style="font-size: 16px; text-align:left; color: #333;">{{ $words }}</p>
                            </div>

                            <a href="{{route('project',['slug'=>$rs->slug])}}" class="mt-auto d-block">
                                <div class="tp-blog-2__link text-center">
                                    <span>Read More<i class="flaticon-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
