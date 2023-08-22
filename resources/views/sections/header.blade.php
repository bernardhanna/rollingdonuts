<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-08 12:15:30
 */
?>
<header class="w-full relative">
    <div class="z-50 bg-white fixed top-0 left-0 right-0">
        @if(get_field('topbar_text', 'option'))
            @include('partials.topbar')
        @endif
        @include('partials.navigation')
    </div>
</header>
