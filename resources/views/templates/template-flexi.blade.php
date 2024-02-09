<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-03 10:21:45
 */
?>
{{--
    Template Name: Flexi
--}}
@extends('layouts.app')

@section('content')
    @include('partials.space')
    @include('partials.page-header')
    @while(have_rows('flexible_content')) @php(the_row())
        @includeWhen(get_row_layout() === 'text_block', 'flexible.text')
        @includeWhen(get_row_layout() === 'image_block', 'flexible.image')
        @includeWhen(get_row_layout() === 'video_block', 'flexible.video')
        @includeWhen(get_row_layout() === 'imagewithtext_block', 'flexible.imagewithtext')
    @endwhile
    @include('partials.site-links')
    @include('partials.instagram-slider')
@endsection
