<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 12:26:00
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 14:46:35
 */

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_navigation'); ?>
<?php
// Check if we're on the "Payment Methods" or "Orders" page.
$is_payment_methods_page = function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('payment-methods');
$is_orders_page = function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('orders');

// Specifically check for the "View Order" page.
$is_view_order_page = function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('view-order');

// Default classes.
$background_class = 'bg-white'; // Default background class for all pages.
$padding_class = 'px-4 py-8 mobile:p-10'; // Default padding for most pages.

// Modify classes based on conditions.
if ($is_orders_page || $is_payment_methods_page) {
    // Adjust for "Orders" and "Payment Methods" pages.
    $background_class = 'sm:bg-transparent lg:bg-white';
    $padding_class = 'p-0 rounded-none';
} elseif ($is_view_order_page) {
    // Ensure default padding is applied on "View Order" page, adjust as needed.
    $padding_class = 'p-0'; // This ensures default padding is retained for "View Order" page.
}
?>
<div class="mt-10"></div>

<div class="woocommerce-MyAccount-content mx-auto max-w-max-1038 flex flex-col <?php echo esc_attr($padding_class); ?> <?php echo esc_attr($background_class); ?> rounded-one mt-10">
    <?php
    /** p10
     * My Account content.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_account_content');
    ?>
</div>
<div id="movBtn" class="btns"></div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find the "Add payment method" button.
        var addPaymentMethodButton = document.querySelector(".add-payment-button-container");

        // Find the target location where you want to move the button.
        var targetLocation = document.getElementById("movBtn");

        // Check if both elements exist.
        if (addPaymentMethodButton && targetLocation) {
            // Move the button to the new location.
            targetLocation.appendChild(addPaymentMethodButton);
        }
    });
</script>