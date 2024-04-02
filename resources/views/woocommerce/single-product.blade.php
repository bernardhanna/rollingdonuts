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
    <div class="bg-cover bg-no-repeat max-lg:z-10 max-lg:-top-6 relative" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-0 lg:px-4 w-full">
            @php
                do_action('get_header', 'shop');
                do_action('woocommerce_before_main_content');
            @endphp

            @while(have_posts())
                @php
                    the_post();
                    global $product;
                    $product = wc_get_product( get_the_ID() );
                @endphp

                @if($product && $product->get_type() === 'woosb')
                    @include('woocommerce.content-single-product')
                @else
                    @include('woocommerce.content-single-product')
                @endif
            @endwhile

            @php
                do_action('woocommerce_after_main_content');
                do_action('get_sidebar', 'shop');
                do_action('get_footer', 'shop');
            @endphp
        </div>
    </div>
@endsection
