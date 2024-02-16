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
    @include('partials.page-header')

    @while(have_posts()) @php(the_post())
        <div class="w-full relative ">
            {{-- Check if the post has a featured image and display it --}}
            @if(has_post_thumbnail())
                    {!! wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'w-full object-cover h-[250px] sm-mob:h-[500px] max-w-max-sitewidth margin-auto']) !!}
            @endif
<div class="h-full absolute items-end lg:items-center top-0 left-0 right-0 w-full mx-auto max-w-[1296px] inline-flex px-4 lg:px-8 macbook:px-0">
                    <div class="bg-white w-full lg:w-[517px] h-auto p-5 mob-no-b-border max-lg:rounded-bl-none max-lg:rounded-br-none rounded-normal">
                        <h1 class="text-xl-font font-reg420 leading-[56px] mb-6">
                            {!! get_the_title() !!}
                        </h1>
<div class="max-mobile:hidden p-summary text-base mb-6">
                            {!! get_the_excerpt() !!}
                        </div>
                        @include('partials.entry-meta')
                    </div>
                </div>
            </div>

<div class="mx-auto max-w-[1296px] bloghead flex flex-col lg:flex-row py-12 px-4  lg:px-8 macbook:px-0">
            <div class="w-full lg:w-3/4">
                @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
            </div>
            <div class="w-full lg:w-sidebar">
                @include('blog.related')
            </div>
        </div>
        {{-- Include the Instagram partial  --}}
        @include('partials.instagram-slider')
    @endwhile
@endsection

