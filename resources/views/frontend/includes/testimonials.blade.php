    <div class="tp-blog-2__area tp-blog-2__spaces pt-60">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-blog-2__section-title pb-50 text-center">
                        <span class="ilm-badge">Stories of Change</span>
                        <h4 class="tp-section-title">What People Say</h4>
                    </div>
                </div>
            </div>
            <div class="row ilm-card-grid">
                @foreach ($testimonials as $rs)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                data-wow-delay=".3s">
                    <div class="tp-blog-2__item ilm-card">
                        <a href="{{ route('testimony',['id'=>$rs->id]) }}">
                            <div class="tp-blog-2__thumb p-relative">
                                <img
                                    src="{{ asset('storage/images/testimonies') . $rs->image }}"
                                    alt="{{ $rs->names }}"
                                    loading="lazy"
                                    decoding="async"
                                    width="480"
                                    height="250"
                                >
                            </div>
                        </a>
                        <div class="tp-blog-2__content ilm-card-body">
                            <div class="tp-blog-2__tag">
                                <span>{{ $rs->names }}</span>
                            </div>

                            <div class="tp-about-3__text ilm-card-text">
                                @php
                                $words = Str::limit($rs->testimony, 100, '...');
                                @endphp

                                <p style="font-size: 16px; text-align:left">{{ $words }}</p>
                            </div>

                            <a href="{{ route('testimony',['id'=>$rs->id]) }}" class="mt-auto d-block">
                                <div class="tp-blog-2__link text-center">
                                    <span>Read More<i class="flaticon-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="row">
                <div class="tp-about-3__btn text-center">
                    <a class="tp-btn" href="{{route('testimonials')}}">View More Testimonials</a>
                </div>
            </div>
        </div>
    </div>
