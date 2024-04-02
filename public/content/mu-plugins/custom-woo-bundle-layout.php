<?php
/*
Plugin Name: Custom WooCommerce Bundle Layout
Description: Uses Splide slider for displaying WooCommerce Smart Bundle products.
*/
add_action('woocommerce_before_add_to_cart_button', function () {
    global $product;
    if ('woosb' === $product->get_type()) {
        // Display custom box price text
        echo '<div class="text-sm-fmd-font lg:text-md-font box-price flex justify-center items-center border-t-2 border-black border-b-2 py-4 my-8 px-4"><span class="font-bold mr-2">Box Price: </span> ' . $product->get_price_html() . '</div>';
    }
});


add_filter(
    'woocommerce_get_section_data',
    function ($data, $section) {
        if ('woosb' === $section->get_type()) {
            $data['class'] = isset($data['class']) ? $data['class'] . ' custom-woosb-button-class' : 'custom-woosb-button-class';
        }
        return $data;
    },
    10,
    2
);
