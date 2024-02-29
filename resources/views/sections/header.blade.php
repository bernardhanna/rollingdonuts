<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:20:28
 */
?>
@php
$mobile_menu_bg = get_field('mobile_menu_bg', 'option');
@endphp
<header class="w-full" x-data="{ isSticky: false, lastScrollY: window.scrollY, showSearch: false }">
<script>
    var isCartOrCheckoutPage = <?php echo (is_cart() || is_checkout()) ? 'true' : 'false'; ?>;
</script>
<div class="z-50 bg-white top-0 left-0 right-0" :class="{ 'opacity-0': isSticky, 'opacity-100': !isSticky }" x-show="!isSticky">
        @if (!is_cart() && !is_checkout() || !is_user_logged_in())
@if(get_field('topbar_text', 'option'))
@include('partials.topbar')
@endif
        @endif
        @include('partials.navigation')
    </div>
<div x-data="{
        isSticky: false,
        lastScrollY: window.scrollY,
        scrollingUp: false,
    }" x-init="window.addEventListener('scroll', () => {
                if (isCartOrCheckoutPage) return; // Skip sticky behavior on cart or checkout pages

                const currentScrollY = window.scrollY;
                scrollingUp = currentScrollY < lastScrollY;

                if (currentScrollY > 220) {
                    isSticky = true;
                } else {
                    isSticky = false;
                }

lastScrollY = currentScrollY;
})"
:class="{
'fixed z-98 bg-white top-0 left-0 right-0': isSticky && !isCartOrCheckoutPage,
'hidden': !isSticky || isCartOrCheckoutPage,
'animate-fade-down transition-opacity duration-700 opacity-100': isSticky && !scrollingUp && !isCartOrCheckoutPage,
}">
    <div class="z-50 bg-white top-0 left-0 right-0 transition-opacity duration-700">
        @include('partials.navigation')
    </div>
</div>
<div class="search-bar-container md:relative absolute max-md:w-full max-md:h-screen max-md:pt-12 z-50" x-show="showSearch" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="transform opacity-0 -translate-y-12" x-transition:enter-end="transform opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-700" x-transition:leave-start="transform opacity-100 translate-y-0" x-transition:leave-end="transform opacity-0 -translate-y-12" style="--mobile-bg-image: url('{{ $mobile_menu_bg }}');">
    <div class="w-full max-w-max-1182 ml-auto mr-auto flex flex-row items-center justify-center px-4">
        <?php echo do_shortcode('[fibosearch]'); ?>
        <button @click="showSearch = false" class="relative ml-2 bg-red-critical border-2 border-black-full border-solid rounded-full flex items-centert justify-center h-[40px] w-[40px] hover:bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="100%" viewBox="0 0 12 12" fill="none">
                <path d="M0.659928 3.12523L3.10369 0.681466L5.97737 3.55515L8.87368 0.658838L11.3174 3.1026L8.42113 5.99891L11.3174 8.89522L8.87368 11.339L5.97737 8.44267L3.10369 11.3164L0.659929 8.87259L3.53361 5.99891L0.659928 3.12523Z" fill="black" />
            </svg>
        </button>
    </div>
</div>
</header>
