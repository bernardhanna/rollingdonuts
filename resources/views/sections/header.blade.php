<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-01 17:18:01
 */
?>
<header class="w-full z-50 bg-white">
    @if(get_field('topbar_text', 'option'))
        @include('partials.topbar')
    @endif
    @include('partials.navigation')
</header>
