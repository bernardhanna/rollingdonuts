<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:02:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 09:57:59
 */
?>
<div class="top-nav w-full md:max-w-max-1549 lg:max-w-max-95 py-4 hidden lg:flex md:justify-between lg:justify-end relative top-0 lg:mb-[-4]">
    <div class="md:flex md:items-center md:justify-between md:px-4 md:w-full">
    <div class="md:pl-4">
        @php
        $main_logo_id = attachment_url_to_postid(get_field('main_logo', 'option'));
        $main_alt_text = get_post_meta($main_logo_id, '_wp_attachment_image_alt', true);
    @endphp
        <a class="display-md" href="{{ home_url('/') }}">
        <img class="logo desktop-logo" src="{{ get_field('main_logo', 'option') }}" alt="{{ $main_alt_text }}"></a>
    </div>

    <div class="flex flex-row justify-space-between align-center justify-end w-full space-x-5">
        <a class="reg-font items-center flex-row hidden lg:flex" href="tel:{{ $telephone }}">
            <span class="iconify h-8 w-8 mr-5" data-icon="icon-park-twotone:phone-telephone"></span>
            <span class="flex text-reg-font font-reg420">{{ $telephone }}</span>
        </a>
        <div class="nav-line hidden md:block lg:hidden"></div>
        <a class="flex align-center flex-row" href="{{ wc_get_page_permalink('myaccount') }}">
            <span class="iconify h-8 w-8" data-icon="uil:user"></span>
        </a>
        <div class="nav-line hidden lg:flex"></div>
        <a class="text-reg-font flex align-center flex-row" href="{{ get_permalink(get_page_by_title('Search Page')) }}">
            <span class="iconify h-8 w-8" data-icon="ion:search"></span>
        </a>
        <div class="nav-line  hidden lg:flex"></div>
        <a class="reg-font hidden lg:flex align-center flex-row items-center " href="{{ wc_get_cart_url() }}">
            <span class="iconify" data-icon="grommet-icons:basket" data-width="32" data-height="32"></span>
            <span class="ml-2 text-reg-font font-reg420">{!! wc_price(WC()->cart->get_total('edit')) !!}</span>
        </a>
    </div>
    </div>
</div>
