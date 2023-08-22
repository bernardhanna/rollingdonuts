<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-09 13:17:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-21 16:04:15
 */
?>
<section class="relative w-full">
    @php
    //Define Categories
    $args = array(
        'taxonomy'   => "product_cat",
        'hide_empty' => false,
    );
    $categories = get_terms($args);
    // DESKTOP
    $image_id = get_field('woo_header_bg', 'option', false);
    $image_url = wp_get_attachment_url($image_id);
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    $image_srcset = wp_get_attachment_image_srcset($image_id);
    // MOBILE
    $image_id_mobile = get_field('woo_mobile_bg', 'option', false);
    $image_url_mobile = wp_get_attachment_url($image_id_mobile);
    $image_alt_mobile = get_post_meta($image_id_mobile, '_wp_attachment_image_alt', true);
    $image_srcset_mobile = wp_get_attachment_image_srcset($image_id_mobile);
    @endphp

    @if($image_url || $image_url_mobile )
    <div x-data="{ isMobile: window.innerWidth <= 1024 }" x-init="() => {
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth <= 1024;
        });
    }">
        <img x-show="!isMobile" class="w-full h-[241px]" src="{{ $image_url }}" alt="{{ $image_alt }}" srcset="{{ $image_srcset }}" sizes="(min-width: 1025px) 100vw">
        <img x-show="isMobile" class="w-full" src="{{ $image_url_mobile }}" alt="{{ $image_alt_mobile }}" srcset="{{ $image_srcset_mobile }}" sizes="(max-width: 1024px) 100vw">
    </div>
    @endif

    <div class="px-4 lg:p-0 mx-auto lg:max-w-max-1549 absolute h-full left-0 right-0 top-0 w-full">
        <div class="w-full">
            @php
                woocommerce_breadcrumb();
            @endphp
        </div>
        <div class="flex items-start justify-between pt-8">
            <h1 class="text-white lg:text-xl-font xl:text-xxxl-font font-reg420">
                @if(is_page_template('templates/template-box-products.blade.php'))
                Choose Your Own
                @else
                @php
                 the_title();
                @endphp
                @endif
            </h1>
            @if(is_page_template('templates/template-box-products.blade.php') || is_page_template('templates/template-merch-products.blade.php'))
            <div x-data="{ showFilter: false }">
                <button @click="showFilter = !showFilter"
                :class="{'bg-yellow-primary': showFilter, 'lg:bg-white': !showFilter}"
                class="active:bg-yellow-primary flex items-center justify-between lg:px-10 lg:py-4">
                <span class="lg:text-black lg:text-sm-md-font font-reg420">Sort by</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                        <path d="M12.9089 23.4414C12.5998 23.4414 12.3409 23.3364 12.1321 23.1264C11.9227 22.9171 11.8179 22.6576 11.8179 22.3477L11.8179 15.7852L5.49046 7.69141C5.21772 7.32682 5.177 6.94401 5.36827 6.54297C5.55883 6.14193 5.89047 5.94141 6.36321 5.94141L21.6364 5.94141C22.1092 5.94141 22.4412 6.14193 22.6324 6.54297C22.823 6.94401 22.7819 7.32682 22.5092 7.69141L16.1817 15.7852V22.3477C16.1817 22.6576 16.0773 22.9171 15.8686 23.1264C15.6591 23.3364 15.3999 23.4414 15.0908 23.4414H12.9089Z" fill="black" fill-opacity="0.2" stroke="black"/>
                    </svg>
                </button>
                <!-- Filter -->
                    <div x-show="showFilter" class="absolute w-full text-black-full flex justify-center items-center top-1/2 left-0 right-0">
                        <ul id="custom-filter" class="flex flex-wrap flex-row justify-around items-center">
                            <li><a class="rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary" href="#" data-filter="all">All</a></li>
                            @if ($ordered_categories && (is_array($ordered_categories) || is_object($ordered_categories)))
                                @foreach ($ordered_categories as $product_category)
                                    <li><a class="rounded-113xl border-solid border-3 border-black-full bg-white text-sm-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary" href="#" data-filter="{{ $product_category->term_id }}">{{ $product_category->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
            </div>
            @elseif(is_singular('product'))
            <div class="">
                @php
                global $product;
                $product = wc_get_product(get_the_ID());
                if ( is_a( $product, 'WC_Product' ) ) {
                    $price = $product->get_price();
                    $currency = get_woocommerce_currency_symbol();
            @endphp
                    <div class="product-price text-white text-lg-font font-medium">
                        <bdi>{!! $currency !!}{{ $price }}</bdi>
                    </div>
            @php
                } else {
                    echo 'Price not available';
                }
            @endphp
            </div>
            @else

             @endif
        </div>
    </div>
</section>
