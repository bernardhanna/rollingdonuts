<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 13:48:12
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-12 10:38:52
 */
?>
@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp
  <div class="mt-0 space-top-sub"></div>
    @include('woocommerce.custom.woocommerce-header')
    @php
    $shop_bg_url = get_field('shop_bg', 'option');
    @endphp

    <div class="bg-cover bg-no-repeat py-24" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto lg:max-w-max-1549">
            @if (woocommerce_product_loop())
                @php
                remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
                do_action('woocommerce_before_shop_loop');
                woocommerce_product_loop_start();
                @endphp

                @if (wc_get_loop_prop('total'))
                    @while (have_posts())
                        @php
                        the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                        @endphp
                    @endwhile
                @endif

                @php
                woocommerce_product_loop_end();
                do_action('woocommerce_after_shop_loop');
                @endphp
            @else
                @php
                do_action('woocommerce_no_products_found')
                @endphp
            @endif
        </div> <!-- End of my-custom-products-wrapper -->
    </div>

  @php
    do_action('woocommerce_after_main_content');

    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
