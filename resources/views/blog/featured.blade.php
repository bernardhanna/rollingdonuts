<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-11-01 15:42:00
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 16:34:43
 */
?>
@php
// Fetch the featured posts from ACF repeater
$featured_posts = get_field('featured_posts', get_option('page_for_posts'));
@endphp
@if ($featured_posts)
<div class="flex flex-flow flex-row justify-between items-center my-12 lg:px-4 bg-white">
    <div class="w-full pb-4">
        <ul class="flex flex-flow flex-nowrap overflow-x-auto flex-row justify-between items-center w-full bg-white lg:gap-0">
            @foreach ($featured_posts as $featured_post)
                @php
                // Fetch post details using the post ID
                $post_id = $featured_post['post'];
                $post_title = get_the_title($post_id);
                $post_link = get_permalink($post_id);
                // Get the post thumbnail ID and then fetch the srcset for the image
                $post_thumbnail_id = get_post_thumbnail_id($post_id);
                $post_image_srcset = wp_get_attachment_image_srcset($post_thumbnail_id, [267, 300]);
                $post_image_url = get_the_post_thumbnail_url($post_id, [267, 300]);
                // Fetch categories for the post
                $categories = get_the_category($post_id);
                $category_names = [];
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $category_names[] = $category->name;
                    }
                }
                $categories_string = implode(', ', $category_names);
                // Fetch post date in the desired format
                $post_date = get_the_date('j, F Y', $post_id);
                // Calculate reading time
                $post_content = get_post_field('post_content', $post_id);
                $stripped_content = strip_tags($post_content);
                $word_count = str_word_count($stripped_content);
                $reading_time = ceil($word_count / 250);
                @endphp
                <li class="featured-post insta-flow:border-2 border-solid border-black-full rounded-sm-10 p-4 mobile:boxshadow-three min-w-[280px]">
                    <a href="{{ $post_link }}" class="w-full h-full">
                        <img class="rounded-sm-10 w-full h-[300px] object-cover" src="{{ $post_image_url }}" srcset="{{ $post_image_srcset }}" sizes="(max-width: 267px) 100vw, 267px" alt="{{ $post_title }}" />
                        <div class="flex flex-row flex-wrap justify-between items-center pt-4">
                            @if($categories_string)
                                <span class="post-categories text-sm-font text-black-secondary font-regular font-laca">{{ $categories_string }}</span>
                            @endif
                            <span class="post-date text-sm-font text-black-secondary font-regular font-laca">{{ $post_date }}</span>
                        </div>
                        <h4 class="post-title text-black-full text-mob-md-font font-reg420 leading-[1.625rem] relativ py-2">{{ $post_title }}</h4>
                        <span class="text-sm-font font-laca text-black-full font-light">{{ $reading_time }} min read</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@else

@endif
