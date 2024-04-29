@unless (is_cart() || is_checkout())
<div class="relative top-0 hidden w-full py-0 mx-auto top-nav md:max-w-max-1549 xl:max-w-max-95 lg:mt-4 lg:mb-0 laptop:my-4 lg:flex md:justify-between lg:justify-end z-1000">
    <div class="md:flex md:items-center md:justify-between md:px-4 md:w-full">
        <div class="md:pl-4"></div>
        <div class="z-50 flex flex-row justify-end w-full space-x-5 justify-space-between align-center">
            <a class="z-50 flex-row items-center hidden reg-font lg:flex" href="tel:{{ $telephone }}">
                <span class="relative w-8 h-8 iconify r-7" data-icon="icon-park-twotone:phone-telephone"></span>
                <div class="flex nav-line laptop:hidden"></div>
                <span class="relative hidden laptop:flex text-reg-font font-reg420 right-4 -t-0-1">{{ $telephone }}</span>
            </a>
            <div class="hidden nav-line md:block lg:hidden"></div>
            <a class="relative z-50 flex flex-row align-center" href="{{ wc_get_page_permalink('myaccount') }}">
                <span class="relative w-8 h-8 iconify place-nav-icon" data-icon="uil:user"></span>
            </a>
            <div class="hidden nav-line lg:flex"></div>
            <a @click="showSearch = !showSearch" class="z-50 flex flex-row cursor-pointer text-reg-font align-center">
                <span class="relative w-8 h-8 iconify place-nav-icon" data-icon="ion:search"></span>
            </a>
            <div class="hidden nav-line lg:flex"></div>
        </div>
    </div>
    <div id="cart-container">
        <!-- Existing code for displaying cart contents -->
        @if(WC()->cart->get_cart_contents_count() > 0)
            <a class="z-50 flex-row items-center hidden reg-font lg:flex align-center" href="{{ wc_get_cart_url() }}">
                <span class="iconify" data-icon="grommet-icons:basket" data-width="32" data-height="32"></span>
                <span class="cart-count cart-contents-count text-tiny font-reg420 bg-red-critical w-[14px] h-[14px] flex items-center justify-center rounded-full border-2 border-black-border-solid p-2 basket-detail">{{ WC()->cart->get_cart_contents_count() }}</span>
                @if(WC()->cart->get_cart_contents_count() > 0)
                    <span id="cart-total-price" class="ml-2 cart-total cart-contents-total text-reg-font font-reg420">{!! wc_price(WC()->cart->get_total('edit')) !!}</span>
                @endif
            </a>
        @else
            <span class="z-50 flex-row items-center hidden cursor-default reg-font lg:flex align-center">
                <span class="iconify" data-icon="grommet-icons:basket" data-width="32" data-height="32"></span>
                <span id="cart-contents-count" class="text-tiny font-reg420 bg-red-critical w-[14px] h-[14px] flex items-center justify-center rounded-full border-2 border-black-border-solid p-2 basket-detail">{{ WC()->cart->get_cart_contents_count() }}</span>
            </span>
        @endif

        <!-- Ensure that the cart contents element is included -->
        <span class="cart-contents"></span>
    </div>
</div>
@endunless
