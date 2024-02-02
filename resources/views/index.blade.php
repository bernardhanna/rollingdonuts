<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-02 09:21:19
 */
?>
@php
$shop_bg_url = get_field('shop_bg', 'option');
@endphp
@extends('layouts.app')
@section('content')
@include('partials.page-header')
    <div class="bg-cover bg-no-repeat"  class="mx-auto max-w-max-1596 px-4 desktop:px-0">
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
    <div class="px-4">
        <ul class="categories-filter flex flex-nowrap overflow-x-auto flex-row justify-start sm:justify-center items-center lg:justify-center gap-4 my-20" id="post-filter">
            <li class="h-[56px] flex items-center justify-center rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary">
                <a href="{{ get_permalink(get_option('page_for_posts')) }}">All</a>
            </li>
            @foreach ($categories as $category)
                <li class="h-[56px] flex items-center justify-center rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary">
                    <a href="{{ get_permalink(get_option('page_for_posts')) }}?category={{ $category->term_id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>

        <div x-data="{ columnCount: 3 }" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-max-1300 ml-auto mr-auto bg-white">

            <!-- WordPress standard loop -->
            @if (have_posts())
            <?php $counter = 1; ?>
            @while (have_posts())
                @php
                    the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_link = get_permalink();
                    $categories = get_the_category();
                    $category_names = array_map(function ($category) {
                        return $category->name;
                    }, $categories);
                    $categories_string = implode(', ', $category_names);
                    $post_date = get_the_date('j, F Y');
                    $post_content = get_post_field('post_content', $post_id);
                    $stripped_content = strip_tags($post_content);
                    $word_count = str_word_count($stripped_content);
                    $reading_time = ceil($word_count / 250);

                    $heights = [
                        1 => 'notebook:h-[707px]',
                        2 => 'notebook:h-[659px]',
                        3 => 'notebook:h-[707px]',
                        4 => 'notebook:h-[625px]',
                        5 => 'notebook:h-[753px]',
                        6 => 'notebook:h-[625px]',
                        7 => 'notebook:h-[753px]',
                        8 => 'notebook:h-[629px]',
                        9 => 'notebook:h-[753px]',
                    ];
                    $item_height = $heights[$counter] ?? 'notebook:h-[437px]';

                    $image_heights = [
                    1 => 'notebook:h-[519px]',
                    2 => 'notebook:h-[437px]',
                    3 => 'notebook:h-[425px]',
                    4 => 'notebook:h-[437px]',
                    5 => 'notebook:h-[565px]',
                    6 => 'notebook:h-[437px]',
                    7 => 'notebook:h-[565px]',
                    8 => 'notebook:h-[437px]',
                    9 => 'notebook:h-[565px]',
                ];
                  $image_height = $image_heights[$counter] ?? 'notebook:h-auto'; // Default to auto height if not specified

                  $item_center_class = in_array($counter, [4, 6, 8]) ? 'notebook:self-center' : ''; // Center items on 3rd, 6th and 8th item

                // Define margin-top values
                    $margin_tops = [
                        4 => 'notebook:mt-[-4rem]',
                        5 => 'notebook:mt-[-2rem]',
                        6 => 'notebook:mt-[-4rem]',
                        7 => 'notebook:mt-[-4rem]',
                        8 => 'notebook:mt-[-1.5rem]',
                        9 => 'notebook:mt-[-4rem]',
                    ];
                    $margin_top = $margin_tops[$counter] ?? '';
                @endphp

                    <a href="{{ $post_link }}" @php(post_class("border-2 boxshadow-three border-solid border-black-full rounded-sm-10 p-4 {$item_height} {$item_center_class} {$margin_top}"))>
                        <img class="rounded-normal w-full {{ $image_height }} object-cover" src="{{ get_the_post_thumbnail_url($post_id, 'full') }}" alt="{{ $post_title }}" />
                        <h4 class="post-title text-black-full text-sm-md-font font-reg420 leading-[1.625rem] pt-4 pb-3 relative">{{ $post_title }}</h4>
                        <span class="reading-time text-reg-font text-black-full underline font-medium flex items-center">{{ $reading_time }} min read</span>
                        <div class="flex flex-row flex-wrap justify-between items-center py-2">
                            <span class="post-date text-reg-font light-grey font-regular">{{ $post_date }}</span>
                        </div>
                    </a>
                    <?php $counter++; ?>
                    @endwhile
                @endif
            </div>
        {!! custom_pagination() !!}
    </div>
    {{-- Include the Instagram partial  --}}
    @include('partials.instagram-slider')
</div>
@endsection

