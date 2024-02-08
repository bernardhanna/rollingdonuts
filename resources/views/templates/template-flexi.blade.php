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
        @if(get_row_layout() === 'flexi_blocks')
            {{-- Include the blade template to render the flexible content --}}
            @include('flexible.video')
        @endif
      @endwhile
    @include('partials.site-links')
    @include('partials.instagram-slider')
@endsection
