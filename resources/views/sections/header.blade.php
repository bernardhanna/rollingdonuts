<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:20:28
 */
?>
<header x-data="{ isSticky: false, lastScrollY: window.scrollY }">
<script>
    var isCartOrCheckoutPage = <?php echo (is_cart() || is_checkout()) ? 'true' : 'false'; ?>;
</script>
<div class="animate-fade-up z-50 bg-white top-0 left-0 right-0 transition-opacity duration-500" :class="{ 'opacity-0': isSticky, 'opacity-100': !isSticky }" x-show="!isSticky">
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
'fixed z-50 bg-white top-0 left-0 right-0': isSticky && !isCartOrCheckoutPage,
'hidden': !isSticky || isCartOrCheckoutPage,
'animate-fade-down transition-opacity duration-700 opacity-100': isSticky && !scrollingUp && !isCartOrCheckoutPage,
'animate-fade-up transition-opacity duration-700 opacity-100': isSticky && scrollingUp && !isCartOrCheckoutPage,
}">
    <div class="z-50 bg-white top-0 left-0 right-0 transition-opacity duration-700">
        @include('partials.navigation')
    </div>
</div>
</header>
