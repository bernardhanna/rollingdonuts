<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:08:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-17 17:06:56
 */
?>
<div class="flex justify-between laptop:hidden max-w-max-128 w-full ml-4 mr-4">
    <a class="text-reg-font flex align-center flex-row" href="{{ wc_get_page_permalink('myaccount') }}">
        <span :class="{ 'hidden': open }" class="iconify h-8 w-8" data-icon="ion:search"></span>
    </a>
    <a class="flex align-center flex-row" href="{{ get_permalink(get_page_by_title('Search Page')) }}">
        <span :class="{ 'text-white z-20': open }" class="text-black-full iconify h-8 w-8 " data-icon="uil:user"></span>
    </a>
</div>
