<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:02:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 09:57:59
 */
?>
@unless(is_cart() || is_checkout())
<div class="top-nav w-full md:max-w-max-1549 laptop:max-w-max-95 py-4 hidden laptop:flex md:justify-between laptop:justify-end relative top-0 laptop:mb-[-4]">
    <div class="md:flex md:items-center md:justify-between md:px-4 md:w-full">
    <div class="md:pl-4">
        @php
        $main_logo_id = attachment_url_to_postid(get_field('main_logo', 'option'));
        $main_alt_text = get_post_meta($main_logo_id, '_wp_attachment_image_alt', true);
    @endphp
        <a class="display-md" href="{{ home_url('/') }}">
        <img class="logo desktop-logo" src="{{ get_field('main_logo', 'option') }}" alt="{{ $main_alt_text }}"></a>
    </div>

    <div class="flex flex-row justify-space-between align-center justify-end w-full space-x-5 z-50">
        <a class="z-50 reg-font items-center flex-row hidden laptop:flex" href="tel:{{ $telephone }}">
            <span class="iconify h-8 w-8 r-7 relative" data-icon="icon-park-twotone:phone-telephone"></span>
            <span class="flex text-reg-font font-reg420 relative right-4 -t-0-1">{{ $telephone }}</span>
        </a>
        <div class="nav-line hidden md:block laptop:hidden"></div>
        <a class="z-50 flex align-center flex-row relative" href="{{ wc_get_page_permalink('myaccount') }}">
            <span class="iconify h-8 w-8 place-nav-icon relative" data-icon="uil:user"></span>
        </a>
        <div class="nav-line hidden laptop:flex"></div>
        <a class="z-50 text-reg-font flex align-center flex-row" href="{{ get_permalink(get_page_by_title('Search Page')) }}">
            <span class="iconify h-8 w-8 relative place-nav-icon" data-icon="ion:search"></span>
        </a>
        <div class="nav-line  hidden laptop:flex"></div>
        <a class="z-50 reg-font hidden laptop:flex align-center flex-row items-center " href="{{ wc_get_cart_url() }}">
            <span class="iconify" data-icon="grommet-icons:basket" data-width="32" data-height="32"></span>
            <span class="text-tiny font-reg420 bg-red-critical w-[14px] h-[14px] flex items-center justify-center rounded-full border-2 border-black- border-solid p-2 basket-detail">{{ WC()->cart->get_cart_contents_count() }}</span>
            <span class="ml-2 text-reg-font font-reg420">{!! wc_price(WC()->cart->get_total('edit')) !!}</span>
        </a>
    </div>
    </div>
</div>
@endunless
