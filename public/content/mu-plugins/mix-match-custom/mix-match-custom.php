<?php
/**
 * Plugin Name: Mix & Match Custom Functionality
 * Plugin URI: http://example.com/mix-match-custom
 * Description: Custom functionality for Mix & Match products.
 * Version: 1.0.0
 * Author: Bernard Hanna
 * Author URI: https://www.matrixinternet.ie/
 * Text Domain: mix-match-custom
 */

defined('ABSPATH') || exit;

function enqueue_custom_mu_plugin_script()
{
    wp_enqueue_script('jquery');
    $script_url = WP_CONTENT_URL . '/mu-plugins/mix-match-custom/assets/js/main.js';
    wp_enqueue_script('mix-match-custom-js', $script_url, array('jquery'), '1.0.0', false);

    $settings = get_option('extendons_custombox_general_settings', []);
    $post_id = get_the_ID();
    $parentproduct = wc_get_product($post_id);

    $localization = array(
        'boxQty' => get_post_meta($post_id, '_mm_box_quantity', true),
        'add_new_box_quantity' => get_post_meta($post_id, '_mm_add_new_boxes', true),
        'pricingType' => get_post_meta($post_id, '_mm_pricing_type', true),
        'parentProductprice' => $parentproduct ? $parentproduct->get_price() : 0,
        'currencysymbol' => get_woocommerce_currency_symbol(),
        'mmPrefilled_enable' => get_post_meta($post_id, '_mm_enable_prefiled', true),
        'prefileldArray' => array(), // Assumes you populate this array elsewhere
        'prefileldArraylength' => 0, // Update this based on prefileldArray's actual length
        'partialyAllow' => get_post_meta($post_id, '_mm_partialy_filled_layout', true),
        'minboxqty' => get_post_meta($post_id, '_mm_boxmin_qty_allow', true),
        'boxsuccessmessage' => isset($settings['_mm_boxsuccessmsg']) ? $settings['_mm_boxsuccessmsg'] : 'Box Is Full',
        'localizeproductarray' => isset($settings['localizeproductarray']) ? $settings['localizeproductarray'] : array(),
        'mmProdLimitEnable' => get_post_meta($post_id, '_mm_enable_limit_per_prod', true),
        'mmProdLimitQuantity' => get_post_meta($post_id, '_mm_limit_per_prod_quanity', true),
        '_mm_template_type' => isset($settings['_mm_template_type']) ? $settings['_mm_template_type'] : 'default',
        'Subtotal' => __('Subtotal', 'extendons-woocommerce-product-boxes'),
        'ajax_url' => admin_url('admin-ajax.php')
    );

    wp_localize_script('mix-match-custom-js', 'ewcpm_php_vars_cb', $localization);
    error_log('Scripts enqueued and localized');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_mu_plugin_script');

function ensure_array($item)
{
    return is_array($item) ? $item : [];
}


function debug_log($message, $data)
{
    if (WP_DEBUG === true) {
        error_log($message . ": " . print_r($data, true));
    }
}

add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id) {
    debug_log('Cart item data before modification', $cart_item_data);

    if (isset($cart_item_data['mm_product_items'])) {
        $cart_item_data['mm_product_items'] = ensure_array($cart_item_data['mm_product_items']);
    }

    return $cart_item_data;
}, 10, 2);


// This function should be adjusted if you are passing data directly to array_count_values()
function safe_array_count_values($array)
{
    if (!is_array($array)) {
        debug_log('Expected array, got something else', $array);
        return [];
    }
    return array_count_values($array);
}
