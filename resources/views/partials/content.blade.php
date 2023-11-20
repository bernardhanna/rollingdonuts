<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 17:40:21
 */
?>
@php
$post_id = get_the_ID();
$post_title = get_the_title();
$post_link = get_permalink();
$categories = get_the_category();
$category_names = [];
if (!empty($categories)) {
    foreach ($categories as $category) {
        $category_names[] = $category->name;
    }
}
$categories_string = implode(', ', $category_names);
$post_date = get_the_date('j, F Y');
$post_content = get_post_field('post_content', $post_id);
$stripped_content = strip_tags($post_content);
$word_count = str_word_count($stripped_content);
$reading_time = ceil($word_count / 250);
@endphp
@php
    switch ($counter) {
        case 1:
            $image_height = 'h-[519px]';
            break;
        case 2:
        case 4:
        case 6:
        case 8:
            $image_height = 'h-[437px]';
            break;
        case 3:
            $image_height = 'h-[425px]';
            break;
        case 5:
        case 7:
            $image_height = 'h-[565px]';
            break;
        case 9:
            $image_height = 'h-[581px]';
            break;
        default:
            $image_height = 'h-[437px]';  // Default value
            break;
    }

$post_thumbnail_id = get_post_thumbnail_id($post_id);
$post_image_srcset = wp_get_attachment_image_srcset($post_thumbnail_id, [381, intval(substr($image_height, 4, -4))]); // dynamically get height
$post_image_url = get_the_post_thumbnail_url($post_id, [381, intval(substr($image_height, 4, -4))]);
@endphp

<a href="{{ $post_link }}" @php(post_class("border-2 boxshadow-three border-solid border-black-full rounded-sm-10 p-4"))>
    <img class="rounded-sm-10 w-full {{ $image_height }} object-cover" src="{{ $post_image_url }}" srcset="{{ $post_image_srcset }}" sizes="(max-width: 381px) 100vw, 381px" alt="{{ $post_title }}" />
    <div class="flex flex-row flex-wrap justify-between items-center py-4">
        @if($categories_string)
            <span class="post-categories text-sm-font text-black-full font-regular">{{ $categories_string }}</span>
        @endif
        <span class="post-date text-sm-font text-black-full font-regular">{{ $post_date }}</span>
    </div>
    <h2 class="post-title text-black-full text-base-font font-reg420 pb-6">{{ $post_title }}</h2>
    <span class="reading-time text-sm-font text-black-full font-regular">{{ $reading_time }} min read</span>
</a>
