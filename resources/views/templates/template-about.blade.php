<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-06 10:45:08
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-31 11:40:39
 */
?>
{{--
    Template Name: About
--}}
@extends('layouts.app')
@section('content')
@php
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
@endphp
    <div style="background-image: url('{{ $featured_image_url }}'); background-size: cover; background-position: center center;  width: 100%;">
        @include('partials.page-header')
        @php
            $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        @endphp
        <div class="w-full bg-transparent laptop:w-90 m-auto">
            <div class="relative pt-20 pb-20 px-4 w-full max-w-max-1038 ml-auto mr-auto gutenburg">
                @include('partials.content-page')
            </div>
        <svg class="about_x relative mb-12" xmlns="http://www.w3.org/2000/svg" width="110" height="115" viewBox="0 0 110 115" fill="none">
            <path d="M84.7821 0.765625L55.0008 31.4354L25.2473 0.794199L0.0293782 26.7645L29.7829 57.4057L0 88.0772L25.2179 114.047L55.0008 83.3759L84.7788 114.042L109.997 88.0721L80.2187 57.4057L110 26.7359L84.7821 0.765625Z" fill="#FFED56"/>
        </svg>
        </div>
         @include('partials.our-story')
         <div class="mx-auto px-4 lg:max-w-max-1549">
            @include('faq.faqs')
        </div>
        @include('partials.site-links')
        @include('partials.instagram-slider')
@endsection
</div>
