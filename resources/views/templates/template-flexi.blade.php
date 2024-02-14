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
@php
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
@endphp

<div style="background-image: url('{{ $featured_image_url }}'); background-size: cover; background-position: center center; height: 100%%; width: 100%;">
    @include('partials.page-header')
    @while(have_rows('flexible_content')) @php(the_row())
        @includeWhen(get_row_layout() === 'padding_block', 'flexible.padding')
        @includeWhen(get_row_layout() === 'text_block', 'flexible.text')
        @includeWhen(get_row_layout() === 'editor_block', 'flexible.editor')
        @includeWhen(get_row_layout() === 'image_block', 'flexible.image')
        @includeWhen(get_row_layout() === 'video_block', 'flexible.video')
        @includeWhen(get_row_layout() === 'button_block', 'flexible.button')
        @includeWhen(get_row_layout() === 'list_block', 'flexible.list')
        @includeWhen(get_row_layout() === 'imagewithtext_block', 'flexible.imagewithtext')
        @includeWhen(get_row_layout() === 'allergens_block', 'flexible.allergens')
        @includeWhen(get_row_layout() === 'faq_block', 'flexible.faq')
    @endwhile
    @include('partials.site-links')
    @include('partials.instagram-slider')
</div>
@endsection
