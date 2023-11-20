<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-02 09:21:19
 */
?>
@extends('layouts.app')
@section('content')
@include('partials.space')
@include('partials.page-header')
    <div class="mx-auto max-w-max-1571">
        @include('blog.featured')
        @if (! have_posts())
            <x-alert type="warning">
                {!! __('Sorry, no results were found.', 'rollingdonuts') !!}
            </x-alert>

            {!! get_search_form(false) !!}
        @endif
        @php
        $counter = 1;  // initialize counter
        @endphp

        @php
        $categories = get_categories(array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'hide_empty' => true, // set to false if you want to show categories without posts
        ));
        @endphp
    <div>
        <ul class="categories-filter flex flex-wrap flex-row justify-center items-cente gap-4 my-20" id="post-filter">
            <li class="h-[56px] flex items-center justify-center rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary">
                <a href="{{ get_permalink(get_option('page_for_posts')) }}">All</a>
            </li>
            @foreach ($categories as $category)
                <li class="h-[56px] flex items-center justify-center rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary">
                    <a href="{{ get_permalink(get_option('page_for_posts')) }}?category={{ $category->term_id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mx-auto max-w-max-1300 posts-container">

            @while(have_posts()) @php(the_post())
                @includeFirst(['partials.content-' . get_post_type(), 'partials.content'], ['counter' => $counter])
                @php($counter++)
            @endwhile
        </div>
        {!! custom_pagination() !!}
    </div>
</div>
@endsection
