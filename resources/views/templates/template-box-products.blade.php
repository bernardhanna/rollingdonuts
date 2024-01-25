<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-18 11:56:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 14:38:28
 */
?>
{{--
Template Name: Box Orders
--}}

@extends('layouts.app')

@section('content')
<div class="woocommerce" data-product-type="Box">
    @php
        do_action('get_header', 'shop');
        do_action('woocommerce_before_main_content');
        $shop_bg_url = get_field('shop_bg', 'option');
        $ordered_categories = get_field('ordered_categories'); // Fetch the ordered categories using ACF
    @endphp
    @include('woocommerce.custom.woocommerce-header')

    <div class="bg-cover bg-no-repeat" style="{{ $shop_bg_url ? 'background-image: url(' . $shop_bg_url . ');' : '' }}">
        <div class="mx-auto px-4 pt-7 pb-20 lg:max-w-max-100">
            <ul class="filter products columns-3 flex flex-row flex-wrap justify-between">
            @if ($ordered_categories && (is_array($ordered_categories) || is_object($ordered_categories)))
                @foreach ($ordered_categories as $product_category)
                    @php
                        // Fetch products within the current category
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'tax_query' => [
                                'relation' => 'AND',
                                [
                                    'taxonomy' => 'rd_product_type',
                                    'field' => 'name',
                                    'terms' => 'Box',
                                ],
                                [
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $product_category->term_id,
                                ],
                            ],
                        ];
                        $box_products = new WP_Query($args);
                    @endphp
                    @if ($box_products->have_posts())
                        <h4 class="product-category-title font-edmondsans text-xl-font font-reg420 w-full">{{ $product_category->name }}</h4>
                        @php
                            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                            remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
                            do_action('woocommerce_before_shop_loop');
                            woocommerce_product_loop_start();
                        @endphp

                        @while ($box_products->have_posts())
                            @php
                                $box_products->the_post();
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            @endphp
                        @endwhile

                        @php
                            woocommerce_product_loop_end();
                            wp_reset_postdata();
                        @endphp
                    @endif
                @endforeach
            @else
                echo "No ordered categories found.";
            @endif
            </ul>
    </div>

    @php
        do_action('woocommerce_after_main_content');
        do_action('get_sidebar', 'shop');
        do_action('get_footer', 'shop');
    @endphp
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterLinks = document.querySelectorAll('#custom-filter a');
    const productsContainer = document.querySelector('.filter.products.columns-3');

    const originalContent = productsContainer.innerHTML;

    filterLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const categoryId = this.dataset.filter;

            if (categoryId === 'all') {
                productsContainer.innerHTML = originalContent;
                return;
            }

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'filter_products',
                    category: categoryId,
                    productType: 'Box' // Change this to 'Merch' for the Merch template
                }),
            })
            .then(response => response.text())
            .then(data => {
                productsContainer.innerHTML = data;
            });
        });
    });
});
    </script>

