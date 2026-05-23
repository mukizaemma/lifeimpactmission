@extends('layouts.frontbase')

@section('title', 'Home Page')

@section('content')


        @include('frontend.includes.page-hero', ['pageKey' => 'testimonials'])

    <!-- testimonial-area-start -->
    @include('frontend.includes.testimonials')
    <!-- testimonial-area-end -->

        <!-- cta-area-start -->
            @include('frontend.includes.backImage')
        <!-- cta-area-end -->


@endsection
