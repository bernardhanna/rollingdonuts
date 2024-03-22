<?php

/**
 * "Order received" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.3.0
 *
 * @var WC_Order|false $order
 */

defined('ABSPATH') || exit;

// Ensure we have the order object.
if ($order) {
    // Retrieve customer first name and email from the order.
    $first_name = $order->get_billing_first_name();
    $customer_email = $order->get_billing_email();
}
?>

<?php if ($order) : ?>
    <!-- Display the customer's first name in the thank you message -->
    <h1 class="text-white thankyou-title lg:text-xxl-font font-reg420 mb-6 text-sm-md-font "><?php echo esc_html("Thank you, {$first_name}, for your order!"); ?></h1>

    <p class="hidden lg:block text-white font-lighter text-sm-md-font woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
        <?php
        // Customize the order received message to include the customer's email.
        $custom_message = sprintf(
            esc_html__('Congratulations! Your order has been placed. Thank you for shopping with us', 'woocommerce'),
            $customer_email
        );
        echo $custom_message;
        ?>
    </p>
<?php else : ?>
    <p class="text-white font-lighter text-sm-md-font  woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
        <?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Congratulations! Your order has been placed. Thank you for shopping with us. ', 'woocommerce'), null); ?>
    </p>
<?php endif; ?>