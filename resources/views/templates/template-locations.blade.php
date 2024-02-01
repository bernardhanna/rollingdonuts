<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-06 10:45:08
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-12-11 10:33:54
 */
?>
{{--
    Template Name: Locations
--}}
@extends('layouts.app')
@php
$shop_bg_url = get_field('shop_bg', 'option');
@endphp
@section('content')
    @include('partials.space')
    @include('partials.page-header')
    @include('components.map')
    <div x-data="{ windowWidth: window.innerWidth }"
    x-init="$watch('windowWidth', width => windowWidth = width);
            window.addEventListener('resize', () => windowWidth = window.innerWidth)"
    class="w-full bg-cover bg-no-repeat"
    :style="windowWidth > 575 && '{{ $shop_bg_url }}' ? 'background-image: url({{ $shop_bg_url }})' : ''">
        <div class="mx-auto px-4 max-w-max-1571">
            {{-- Include the page content partial  --}}
            <section class="relative -top-20 location-content">
              @include('partials.content-page')
            </section>
            {{-- Include the Locations list --}}
            @include('locations.location')
            {{-- Include the Site Links partial  --}}
            @include('partials.site-links')
            {{-- Include the Instagram partial  --}}
            @include('partials.instagram-slider')
        </div>
    </div>
@endsection



