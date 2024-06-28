<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:28:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:13:41
 */
?>
@php
    if (function_exists('get_field')) {
        $telephone = get_field('office_telephone', 'option');
        $currentUserId = get_current_user_id();
        $isUserLoggedIn = !empty($currentUserId);
    }
    $main_logo_id = attachment_url_to_postid(get_field('main_logo', 'option'));
    $main_alt_text = get_post_meta($main_logo_id, '_wp_attachment_image_alt', true);
    $mobile_logo_id = attachment_url_to_postid(get_field('mobile_logo', 'option'));
    $mobile_alt_text = get_post_meta($mobile_logo_id, '_wp_attachment_image_alt', true);
    $mobile_logo_open_id = attachment_url_to_postid(get_field('mobile_logo_open', 'option'));
    $mobile_logo_open_alt_text = get_post_meta($mobile_logo_open_id, '_wp_attachment_image_alt', true);
@endphp
<div x-data="{ open: false }" class="relative">
    <section class="h-auto navbar max-lg:py-4 xl:h-nav max-lg:flex max-lg:items-center">
        <div class="relative w-full px-4 mx-auto max-w-sitewidth">
            @if (!is_cart() && !is_checkout())
                @include('navigation.topnav')
            @endif

            @php
                use Log1x\Navi\Navi;

                if ($navi = (new Navi())->build('primary_navigation')) {
                    $navigation = $navi->toArray();
                }

                // Set the number of items for the left navigation
                $left_items = 4;
                $navigation_left = array_slice($navigation, 0, $left_items);
                $navigation_right = array_slice($navigation, $left_items);
            @endphp
            <nav class="flex justify-between items-center w-full relative z-100 {{ (is_cart() || is_checkout() && !is_wc_endpoint_url('order-received')) ? 'top-8' : 'top-0 lg:-mt-2 xxl:-mt-8 desktop:-mt-10' }} lg:pt-0"
                role="navigation" id="menu">
                <div class="max-lg:w-1/3 laptop:w-5/6">
                    @if (!is_cart() && !is_checkout())
                        @include('navigation.hamburger')
                        @include('navigation.leftnav')
                    @endif
                </div>

                <a class="flex items-center justify-center w-1/3 cursor-pointer nav-center z-100 lg:w-1/6 lg:relative lg:bottom-4 hide-md" href="{{ home_url('/') }}">
                    <img class="relative logo desktop-logo xxl:-left-4 -t-0-3" src="{{ get_field('main_logo', 'option') }}" alt="{{ $main_alt_text }}">
                    <img x-cloak x-show="!open" class="logo mobile-logo" src="{{ get_field('mobile_logo', 'option') }}" alt="{{ $mobile_alt_text }}">
                    <img x-cloak x-show="open" class="logo mobile-logo z-100" src="{{ get_field('mobile_logo_open', 'option') }}" alt="{{ $mobile_logo_open_alt_text }}">
                </a>


                <div class="flex justify-end w-1/3 lg:w-full laptop:w-5/6 lg:justify-start">
                    @if (!is_cart() && !is_checkout())
                        @include('navigation.mobile-right')
                        @include('navigation.rightnav')
                        @include('navigation.combinednav')
                    @endif
                </div>
            </nav>
            @if (!is_cart() && !is_checkout())
                @include('navigation.hamburger-open')
            @endif
        </div>
    </section>
</div>
