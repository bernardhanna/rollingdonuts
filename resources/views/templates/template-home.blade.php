<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-03 10:21:45
 */
?>
{{--
    Template Name: Home
--}}
@extends('layouts.app')

@section('content')
    {{-- Include the Space block  --}} 
    @include('partials.space')
    {{-- Include the HomeHero partial  --}}
    @include('home.hero')
    {{-- Include the HomeServices partial --}}
    @include('home.services')
    {{-- Include the HomeFeaturedSlider partial --}}
    @include('home.featuredslider')
    {{-- Include the HomeBestSellers partial --}}
    @include('home.bestsellers')
    {{-- Include the Info partial --}}
    @include('home.info')
    {{-- Include the StorySlider partial
    @include('home.storyslider')--}}
    {{-- Include the TrustPilot partial
    @include('partials.trust-pilot')--}}
    {{-- Include the Faqs partial  --}}
    @include('partials.faqs')

    {{-- Include the Site Links partial  --}}
    @include('partials.site-links')
  {{-- Use the content from the template-home.blade.php --}}
  {!! get_post_field('post_content', get_the_ID()) !!}
@endsection
