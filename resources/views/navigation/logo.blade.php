<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:07:41
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-18 17:05:26
 */
?>
<a class="cursor-pointer nav-center flex justify-center items-center z-10 w-1/3 laptop:w-1/6 laptop:relative laptop:bottom-4 hide-md" href="{{ home_url('/') }}">
    @php
$main_logo_id = attachment_url_to_postid(get_field('main_logo', 'option'));
        $main_alt_text = get_post_meta($main_logo_id, '_wp_attachment_image_alt', true);
$mobile_logo_id = attachment_url_to_postid(get_field('mobile_logo', 'option'));
        $mobile_alt_text = get_post_meta($mobile_logo_id, '_wp_attachment_image_alt', true);
$mobile_logo_open_id = attachment_url_to_postid(get_field('mobile_logo_open', 'option'));
        $mobile_logo_open_alt_text = get_post_meta($mobile_logo_open_id, '_wp_attachment_image_alt', true);
    @endphp
<img class="logo desktop-logo relative laptop:-left-4 -t-0-3" src="{{ get_field('main_logo', 'option') }}" alt="{{ $main_alt_text }}">
    <img x-cloak x-show="!open" class="logo mobile-logo" src="{{ get_field('mobile_logo', 'option') }}" alt="{{ $mobile_alt_text }}">
    <img x-cloak x-show="open" class="logo mobile-logo z-20" src="{{ get_field('mobile_logo_open', 'option') }}" alt="{{ $mobile_logo_open_alt_text }}">
</a>
