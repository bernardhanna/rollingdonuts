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

    <div class="py-24 bg-no-repeat bg-cover" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto lg:max-w-max-1549">
            @if (woocommerce_product_loop())
                @php
                    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

                    // Custom query modification
                    add_action('pre_get_posts', function($query) {
                        if ($query->is_main_query() && is_shop()) {
                            $tax_query = $query->get('tax_query');
                            if (!is_array($tax_query)) {
                                $tax_query = [];
                            }
                            $tax_query[] = [
                                'relation' => 'AND',
                                [
                                    'taxonomy' => 'rd_product_type',
                                    'field'    => 'slug',
                                    'terms'    => 'donut',
                                    'operator' => 'IN',
                                ],
                                [
                                    'taxonomy' => 'product_tag',
                                    'field'    => 'slug',
                                    'terms'    => 'vegan',
                                    'operator' => 'NOT IN',
                                ],
                            ];
                            $query->set('tax_query', $tax_query);
                        }
                    });

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

            {{-- Custom loop for Vegan products --}}
            @php
                $vegan_products = new WP_Query(array(
                    'post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_tag',
                            'field'    => 'slug',
                            'terms'    => 'vegan',
                        ),
                    ),
                ));
            @endphp
             @if ($vegan_products->have_posts())
                <h4 class="w-full py-12 product-category-title font-edmondsans text-xl-font font-reg420">Vegan</h4>
                <ul class="flex flex-row flex-wrap justify-start gap-4 px-2 products lg:gap-6 desktop:px-0 lg:px-4">
                    @while ($vegan_products->have_posts())
                        @php
                            $vegan_products->the_post();
                            wc_get_template_part('content', 'product');
                        @endphp
                    @endwhile
                </ul>
                @php wp_reset_postdata(); @endphp
            @else
                {{-- No vegan products found --}}
            @endif
        </div>
        @include('partials.site-links')
        @include('partials.instagram-slider')
    </div>
  @php
    do_action('woocommerce_after_main_content');

    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
