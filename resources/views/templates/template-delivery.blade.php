<?php
?>
{{--
    Template Name: Delivery
--}}
@extends('layouts.app')
@php
$shop_bg_url = get_field('shop_bg', 'option');
@endphp
@section('content')
    {{-- Include the Page Header partial  --}}
    @include('partials.page-header')
    <div class="bg-cover bg-no-repeat" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-4 lg:max-w-max-1549">
            {{-- Include the page content partial  --}}
            <section class="relative pt-20 pb-20">
              @include('partials.content-page')
            </section>
            {{-- Include the Info partial  --}}
              @include('partials.information')
            {{-- Include the Faqs partial  --}}
            @include('faq.faqs')
        </div>
        @include('partials.site-links')
        @include('partials.instagram-slider')
    </div>
@endsection
