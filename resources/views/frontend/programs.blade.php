@extends('layouts.frontbase')

@section('title', 'Our Programs')

@section('content')

    @include('frontend.includes.page-hero', ['pageKey' => 'programs'])

    @include('frontend.includes.services')

    @include('frontend.includes.home-pillars')

    @include('frontend.includes.home-agriculture')

    @include('frontend.includes.backImage')

@endsection
