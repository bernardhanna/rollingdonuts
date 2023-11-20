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
<div class="mt-32 lg:mt-72"></div>
    @include('woocommerce.custom.woocommerce-header')
    <div class="bg-cover bg-no-repeat" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-4 lg:max-w-max-1549">
                @php
                    do_action('get_header', 'shop');
                    do_action('woocommerce_before_main_content');
                @endphp

                @while(have_posts())
                    @php
                    the_post();
                    wc_get_template_part('content', 'single-product');
                    @endphp
                @endwhile

                @php
                    do_action('woocommerce_after_main_content');
                    do_action('get_sidebar', 'shop');
                    do_action('get_footer', 'shop');
                @endphp
        </div>
    </div>
@endsection
