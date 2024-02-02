<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-06 10:45:08
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-31 11:40:39
 */
?>
{{--
    Template Name: Contact
--}}
@extends('layouts.app')
@php
$shop_bg_url = get_field('shop_bg', 'option');
@endphp
@section('content')
    {{-- Include the Page Header partial  --}}
    @include('partials.page-header')
    <div class="bg-cover bg-no-repeat" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-4 lg:max-w-max-1336">
            {{-- Include the page content partial  --}}
            <section class="relative pt-12 md:pt-24 pb-0 md:pb-20">
              @include('partials.content-page')
            </section>
            {{-- Include the Faqs partial  --}}
            @include('faq.faqs')
            {{-- Include the Site Links partial  --}}
            @include('partials.site-links')
        </div>
    </div>
    {{-- Include the Instagram partial  --}}
    @include('partials.instagram-slider')
@endsection
