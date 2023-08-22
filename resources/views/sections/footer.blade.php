<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-10 09:53:20
 */
?>
<footer class="footer w-full relative z-1">
    @include('partials.newsletter')
    @include('partials.footer-content')

    @if(function_exists('is_shop') && is_shop())
            <!-- option code -->
    @endif
</footer>

