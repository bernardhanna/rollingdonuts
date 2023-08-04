<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:28:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-18 11:03:44
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
        @include('navigation.topnav')
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
                @include('navigation.hamburger')
                @include('navigation.leftnav')
            </div>
            @include('navigation.logo')
            <div class="w-1/3 lg:w-5/6 flex justify-end lg:justify-start" >
                @include('navigation.mobile-right')
                @include('navigation.rightnav')
            </div>
        </nav>
        @include('navigation.hamburger-open')
        </div>
    </section>
</div>
