<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:28:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:13:41
 */
?>
@php
$telephone = get_field('office_telephone', 'option');
$currentUserId = get_current_user_id();
$isUserLoggedIn = !empty($currentUserId);
@endphp
<div x-data="{ open: false }" class="relative">
    <section class="navbar">
        <div class="mx-auto max-w-sitewidth relative pb-2">
            @if (!is_cart() && !is_checkout())
                @include('navigation.topnav')
            @endif
        @php
            use Log1x\Navi\Navi;

            if ($navi = (new Navi())->build('primary_navigation')) {
                $navigation = $navi->toArray();
            }

            // Set the number of items for the left navigation
            $left_items = 3;
            $navigation_left = array_slice($navigation, 0, $left_items);
            $navigation_right = array_slice($navigation, $left_items);
        @endphp
        <nav class="flex justify-between items-center w-full pt-6 lg:pt-0" role="navigation" id="menu">
            <div class="w-1/3 lg:w-5/6">
                @if (!is_cart() && !is_checkout())
                    @include('navigation.hamburger')
                    @include('navigation.leftnav')
                @endif
            </div>
            @include('navigation.logo')
            <div class="w-1/3 lg:w-5/6 flex justify-end lg:justify-start">
                 @if (!is_cart() && !is_checkout())
                    @include('navigation.mobile-right')
                    @include('navigation.rightnav')
                @endif
            </div>
        </nav>
        @if (!is_cart() && !is_checkout())
          @include('navigation.hamburger-open')
        @endif
        </div>
    </section>
</div>
