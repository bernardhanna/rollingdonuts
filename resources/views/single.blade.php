<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 15:23:28
 */
?>
@extends('layouts.app')
@section('content')
@include('partials.space')
@include('partials.page-header')
<div class="mx-auto max-w-max-1571 flex flex-col lg:flex-row py-12">
    <div class="w-full lg:w-3/4">
        @while(have_posts()) @php(the_post())
            @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
        @endwhile
    </div>
    <div class="w-full lg:w-1/4">
        @include('blog.related')
    </div>
</div>
@endsection
