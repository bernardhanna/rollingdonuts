<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:02:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 09:57:59
 */
?>
@unless (is_cart() || is_checkout())
    <div
        class="top-nav w-full md:max-w-max-1549 xl:max-w-max-95 py-0 mx-auto lg:mt-4 lg:mb-0 laptop:my-4 hidden lg:flex md:justify-between lg:justify-end relative top-0 z-100">
        <div class="md:flex md:items-center md:justify-between md:px-4 md:w-full">
            <div class="md:pl-4">

            </div>

            <div class="flex flex-row justify-space-between align-center justify-end w-full space-x-5 z-50">
                <a class="z-50 reg-font items-center flex-row hidden lg:flex" href="tel:{{ $telephone }}">
                    <span class="iconify h-8 w-8 r-7 relative" data-icon="icon-park-twotone:phone-telephone"></span>
                    <div class="nav-line flex laptop:hidden"></div>
                    <span
                        class="hidden laptop:flex text-reg-font font-reg420 relative right-4 -t-0-1">{{ $telephone }}</span>
                </a>
                <div class="nav-line hidden md:block lg:hidden"></div>
                <a class="z-50 flex align-center flex-row relative" href="{{ wc_get_page_permalink('myaccount') }}">
                    <span class="iconify h-8 w-8 place-nav-icon relative" data-icon="uil:user"></span>
                </a>
                <div class="nav-line hidden lg:flex"></div>
                <a @click="showSearch = !showSearch" class="z-50 text-reg-font flex align-center flex-row cursor-pointer">
                    <span class="iconify h-8 w-8 relative place-nav-icon" data-icon="ion:search"></span>
                </a>
                <div class="nav-line  hidden lg:flex"></div>
                <a class="z-50 reg-font hidden lg:flex align-center flex-row items-center " href="{{ wc_get_cart_url() }}">
                    <span class="iconify" data-icon="grommet-icons:basket" data-width="32" data-height="32"></span>
                    <span
                        class="text-tiny font-reg420 bg-red-critical w-[14px] h-[14px] flex items-center justify-center rounded-full border-2 border-black- border-solid p-2 basket-detail">{{ WC()->cart->get_cart_contents_count() }}</span>
                    <span class="ml-2 text-reg-font font-reg420">{!! wc_price(WC()->cart->get_total('edit')) !!}</span>
                </a>
            </div>
        </div>
    </div>
@endunless
