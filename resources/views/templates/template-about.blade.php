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
    @include('partials.page-header')
    <div>
        <div class="relative pt-20 pb-20 px-4 w-full max-w-max-1038 ml-auto mr-auto gutenburg">
              @include('partials.content-page')
         </div>
         @include('partials.our-story')
         <div class="mx-auto px-4 lg:max-w-max-1549">
            @include('faq.faqs')
        </div>
        @include('partials.site-links')
        @include('partials.instagram-slider')
    </div>
@endsection
