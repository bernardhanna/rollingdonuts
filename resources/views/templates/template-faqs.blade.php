<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-06 10:45:08
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-31 11:40:39
 */
?>
{{--
    Template Name: Faqs
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
            {{-- Include the Faqs partial  --}}
            @include('faq.faqs')
        </div>
        @include('partials.site-links')
        @include('partials.instagram-slider')
    </div>
@endsection
