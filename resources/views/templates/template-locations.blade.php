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
    <div class="bg-cover bg-no-repeat" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-4 lg:max-w-max-1549">
            {{-- Include the page content partial  --}}
            <section class="relative -top-20">
              @include('partials.content-page')
            </section>
            {{-- Include the Locations list --}}
            @include('locations.location')
            {{-- Include the Site Links partial  --}}
            @include('partials.site-links')
        </div>
    </div>
@endsection



