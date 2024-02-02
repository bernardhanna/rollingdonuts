<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 16:58:01
 */
?>
@include('navigation.mobile-basket')
<footer class="footer w-full relative bottom-0 left-0 right-0 z-1 overflow-hidden">
    @include('partials.newsletter')
    @include('partials.footer-content')

    @if(function_exists('is_shop') && is_shop())
            <!-- option code -->
    @endif
</footer>

