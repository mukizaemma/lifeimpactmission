    <div class="tp-blog-2__area tp-blog-2__space">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-blog-2__section-title pb-50 text-center">
                        <h4 class="tp-section-title">Our Programs</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($programs as $rs)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s"
                data-wow-delay=".3s">
                    <div class="tp-blog-2__item">
                        <a href="{{route('singleProgram',['slug'=>$rs->slug])}}">
                            <div class="tp-blog-2__thumb p-relative">
                                <img src="{{ asset('storage/images/projects') . $rs->image }}" alt="" style="height: 250px; object-fit: cover;">
                            </div>
                        </a>
                        <div class="tp-blog-2__content ">
                            <div class="tp-blog-2__tag">
                                <a href="{{route('singleProgram',['slug'=>$rs->slug])}}"><h5 class="tp-donate__title">{{ $rs->title }}</h5></a>
                            </div>


                            <div class="tp-about-3__text">
                                @php
                                $words = Str::limit($rs->description, 100, '...');
                                @endphp

                                <p style="font-size: 20px; font-wight:700; text-align:left; color: #000;" > {{ $words }} </p>

                                @if(strlen($rs->description) > 100)
                                <a href="{{route('singleProgram',['slug'=>$rs->slug])}}">
                                    <div class="tp-blog-2__link text-center">
                                        <span>Read More<i class="flaticon-arrow-right"></i><span>
                                    </span></span></div>
                                </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>