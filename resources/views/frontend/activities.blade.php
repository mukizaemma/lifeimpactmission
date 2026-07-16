<div class="ilm-page">
@include('frontend.includes.page-hero', [
            'pageKey' => 'program_detail',
            'heroTitle' => $program->title,
            'heroImage' => $program->image
                ? asset('storage/images/projects') . $program->image
                : null,
        ])

    <!-- service-area-start -->

        @include('frontend.includes.services')

    <!-- service-area-end -->

        <!-- cta-area-start -->
            @include('frontend.includes.backImage')
        <!-- cta-area-end -->
</div>
