<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:20:28
 */
?>
<header class="w-full relative z-1000">
    <div class="z-50 bg-white fixed top-0 left-0 right-0 disable-fixed">
        @if (!is_cart() && !is_checkout() || !is_user_logged_in())
            @if(get_field('topbar_text', 'option'))
                @include('partials.topbar')
            @endif
        @endif
        @include('partials.navigation')
    </div>
</header>
