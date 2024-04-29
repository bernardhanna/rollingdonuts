<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 14:31:43
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-09 14:37:45
 */
?>
{{--
The Template for displaying all single products

This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see         https://docs.woocommerce.com/document/template-structure/
@package     WooCommerce\Templates
@version     1.6.4
--}}

@extends('layouts.app')

@php
    $shop_bg_url = get_field('shop_bg', 'option');
@endphp

@section('content')
    @include('woocommerce.custom.woocommerce-header')
    <div class="relative bg-no-repeat bg-cover max-lg:z-10 max-lg:-top-6"
        style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="w-full px-0 mx-auto lg:px-4">
            @php
                do_action('get_header', 'shop');
                do_action('woocommerce_before_main_content');
                global $product;

            @endphp
            @if (!$product->is_type('wooextmm') || $product->is_type('woosb'))
                @while (have_posts())
                    @php
                        the_post();
                        global $product;
                        $product = wc_get_product(get_the_ID());
                    @endphp

                    @if ($product && $product->get_type() === 'woosb')
                        @include('woocommerce.content-single-product')
                    @elseif ($product && $product->get_type() === 'donut_box_builder')
                        @include('woocommerce.content-donut-box')
                    @else
                        @include('woocommerce.content-single-product')
                    @endif
                @endwhile
            @endif

            @php
                global $product;

                // Check if the product is not of type 'variable' and has the product type 'woosb'
                if ($product->is_type('wooextmm') && !$product->is_type('woosb')) {
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @since 1.0.0
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action('mixmatch_after_single_product_summary');
                }
            @endphp


            @php
                do_action('woocommerce_after_main_content');
                do_action('get_sidebar', 'shop');
                do_action('get_footer', 'shop');
            @endphp
        </div>
    </div>
@endsection
