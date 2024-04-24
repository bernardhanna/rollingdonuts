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
<style>
    .item_count_display {
    color: #555;
    font-weight: bold;
    padding: 5px 10px;
    display: inline-block;
    background-color: #f1f1f1;
    border-radius: 4px;
    margin-top: 10px;
}
    #headerimg h1 a {
        display: none !important;
    }

    #headerimg .description {
        display: none !important;
    }

    form.cartt {
        margin-bottom: 0px;
        padding: 0px;
        margin: auto;
        width: 100%;
    }

    .product_box_container {
        margin-left: 0px !important;
        margin-right: 0px !important;
    }

    .horizontal_box .gift_box_container {
        background-color: #ffffff !important;
    }

    .horizontal_box.product_addon_container .product_gift_box.active_bx_dtl {
        background-color: #000 !important;
    }

    .product_addon_container {
        background-color: transparent !important;
    }

    .horizontal_box .gift_box_container {
        background-color: transparent !important;
    }

    .product_addon_container .product_addon_box {
        background-color: transparent !important;
        padding: unset !important;
    }

    .simple_pd .pd_box_list .pd_add_block {
        padding: 0px;
    }

    .pd_box_list .pd_add_block {
        border: none;
        padding: 0px;
        box-sizing: border-box;
        border-radius: 6px;
        box-shadow: none;
        transition: .3s ease-in-out;
        border: none;
        background: transparent;
    }

    .product_box_container .product_addon_container {
        padding: 0px !important;
        box-sizing: border-box;
        background-color: #eaeded00 !important;
        border-radius: unset;
        display: flex !important;
        flex-direction: row-reverse !important;
        justify-content: space-between !important;
    }

    .horizontal_box .gt_box_list .gift_block.active_gift {
        border-style: solid;
        background-color: black !important;
    }

    .horizontal_box .gt_bx_rt {
        background: black;
        padding: 0px!important;
    }

    .simple_pd .pd_add_block .pd_dtl .pd_title {
        text-align: center;
        color: #000 !important;
        line-height: 1;
    }

    .horizontal_box .product_gift_box .gt_box_list {
        flex-wrap: wrap !important;
    }

    .horizontal_box.product_addon_container .product_gift_box.active_bx_dtl {
        background-color: #000 !important;
    }

    .horizontal_box .gt_bx_rt {
        margin-top: 0px;
        padding: 1rem;
        border-radius: 0px 6px 6px 6px;
        border-radius: 16.076px;
        border: 2.679px solid var(--black-full, #000) !important;
    }

    .gt_box_list .gift_block .dlt_icon svg {
        s width: 20px !important;
        height: 20px !important;
    }

    .gt_box_list .gift_block .dlt_icon svg g {
        stroke: black !important;
        fill: #f55959 !important;
    }

    .horizontal_box .gt_box_list .gift_block {
        width: 22.5%;
        min-width: 20%;
        height: auto;
    }

    .gift_box_top .reset_gt_box .clear_cta {
    color: white!important  ;
    font-size: 20px;
    font-style: normal;
    font-weight: 420;
    text-decoration: none!important;
}

    .horizontal_box .product_gift_box .gift_box_top {
    padding: .5rem !important;
    transition: .3s ease-in-out;
    justify-content: flex-end;
    background: #C70000;
    border-top-left-radius: 14px;
    border-top-right-radius: 14px;
}

    .gt_overlay {
        display: none;
    }

    .woocommerce-Price-amount .amount {
        color: #000 !important;
    }

    .woocommerce-Price-currencySymbol {
        color: #000 !important;
    }

    .pd_box_list .pd_add_block:hover {
        box-shadow: none !important;
    }

    .product_addon_box .pd_title {
        color: #000000 !important;
    }

    .extendssubtotalboxes,
    .gift_box_top .gt_item_lmt .text {
        color: #000000;
    }

    .horizontal_box .gift_box_container.sticky_gt {
        padding-top: 0px !important;
        margin-bottom: 0px !important;
        border-radius: 0px !important;
        box-shadow: none !important;
    }

    .horizontal_box .gift_box_container {
        display: flex;
        justify-content: space-between;
        margin: 0px 0px 0px;
        padding: 0px 0px;
        width: 100%;
        max-width: 480px;
    }

    .gift_box_container.sticky_gt {
        width: 100%;
        max-width: 480px;
    }

    .woocommerce-Price-amount.amount {
        color: #000000 !important;

    }

    .form.cartt {
        padding: 0px;
    }

    .extendons_add_to_cart {
        margin-top: 2%;
        display: flex;
        margin-left: 2%;
        margin-right: 2%;
        justify-content: flex-end;
    }
    .add_cta svg path {
         stroke: black !important;
        fill: black !important;
    }
    .qodef-woo-product-title.product_title.entry-title {
        display: none!important;
    }
</style>
@extends('layouts.app')

@php
    $shop_bg_url = get_field('shop_bg', 'option');
@endphp

@section('content')
    @include('woocommerce.custom.woocommerce-header')
    <div class="bg-cover bg-no-repeat max-lg:z-10 max-lg:-top-6 relative"
        style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-0 lg:px-4 w-full">
            @php
                do_action('get_header', 'shop');
                do_action('woocommerce_before_main_content');
                global $product;

            // Get the product type
            //$product_type = $product->get_type();

            // Dump the product type
            //var_dump($product_type);
            @endphp
    @if ( !$product->is_type( 'wooextmm' ) ||  $product->is_type( 'woosb' ) )
            @while (have_posts())
                @php
                    the_post();
                    global $product;
                    $product = wc_get_product(get_the_ID());
                @endphp

                @if ($product && $product->get_type() === 'woosb')
                    @include('woocommerce.content-single-product')
                @else
                    @include('woocommerce.content-single-product')
                @endif
            @endwhile

    @endif

        @php
        global $product;

        // Check if the product is not of type 'variable' and has the product type 'woosb'
       if ( $product->is_type( 'wooextmm' ) && ! $product->is_type( 'woosb' ) ) {
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
<script>
jQuery(document).ready(function($){

	if(ewcpm_php_vars_cb._mm_template_type=='grid') {
		jQuery(window).on('scroll', function(){
			if(jQuery(window).scrollTop() >= jQuery('.horizontal_box .gift_box_container').offset().top){
				jQuery('.gift_box_container').removeClass('sticky_gt');
			} else {
				jQuery('.gift_box_container').removeClass('sticky_gt');
	            //or use $('.menu').removeClass('addclass');
	        }
	    });
	}
});
jQuery(document).ready(function($) {
    $('.add_cta').on('click', function(e) {
        e.preventDefault();
        var productID = $(this).data('id');
        var qtySelector = '.exqtyval' + productID;
        var currentQty = parseInt($(qtySelector).text(), 10);

        if (isNaN(currentQty)) {
            currentQty = 0;
        }

        $(qtySelector).text(currentQty + 1);
    });

});

</script>
