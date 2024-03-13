<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:08:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-17 17:06:56
 */
?>
<div class="flex justify-between lg:hidden max-w-max-128 w-full pl-2 pr-2 ml-0 mr-0 mobile:ml-4 mobile:mr-4">
<a class="text-reg-font flex align-center flex-row" @click="showSearch = !showSearch">
        <span :class="{ 'hidden': open }" class="iconify h-8 w-8" data-icon="ion:search"></span>
    </a>
    <a class="flex align-center flex-row" href="{{ wc_get_page_permalink('myaccount') }}">
<span :class="{ 'text-white z-100': open }" class="text-black-full iconify h-8 w-8 " data-icon="uil:user"></span>
    </a>
</div>
