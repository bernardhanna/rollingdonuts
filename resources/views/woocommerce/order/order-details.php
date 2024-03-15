<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.5.0
 *
 * @var bool $show_downloads Controls whether the downloads table should be rendered.
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (is_wc_endpoint_url('view-order')) {
    echo '<div class="px-4 mx-auto w-full max-w-max-1000 wc-backward-container"><a href="' . wc_get_account_endpoint_url('orders') . '" class="woocommerce-button button wc-backward font-laca font-bold text-mob-md-font text-yellow-primary hover:underline flex flex-container items-center leading-none"><svg class="mr-2" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M27 14C27 6.8203 21.1797 1 14 1C6.8203 1 0.999998 6.8203 0.999999 14C0.999999 21.1797 6.8203 27 14 27C21.1797 27 27 21.1797 27 14Z" fill="#FFED56" stroke="black" stroke-width="2"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M15.0406 18.3071C15.3047 18.5711 15.7327 18.5711 15.9967 18.3071L16.1533 18.1506C16.4171 17.8868 16.4173 17.4591 16.1538 17.195L13.0184 14.0528L16.1538 10.9105C16.4173 10.6464 16.4171 10.2188 16.1533 9.95496L15.9967 9.79841C15.7327 9.53439 15.3047 9.53439 15.0406 9.79841L10.7863 14.0528L15.0406 18.3071Z" fill="black"/>
</svg>
' . esc_html__('Back to orders', 'woocommerce') . '</a></div>';
}


if (!$order) {
    return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();

if ($show_downloads) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads'  => $downloads,
            'show_title' => true,
        )
    );
}
?>

<section class="woocommerce-order-details rounded-one">
    <?php do_action('woocommerce_order_details_before_order_table', $order); ?>
    <div class="sm:table hidden sm:block w-full rounded-one">
        <div class="table-header-group">
            <div class="table-row bg-grey-disabled">
                <div class="table-cell p-8 text-left font-bold"><?php esc_html_e('Product', 'woocommerce'); ?></div>
                <div class="table-cell p-8 text-center font-bold"><?php esc_html_e('Total', 'woocommerce'); ?></div>
            </div>
        </div>
        <div class="table-row-group">
            <?php foreach ($order_items as $item_id => $item) : ?>
                <div class="table-row">
                    <div class="table-cell p-8 border-grey-disabled border-t-2"><?php echo esc_html($item->get_name()); ?></div>
                    <div class="table-cell p-8 text-center border-grey-disabled border-t-2"><?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="table-footer-group bg-grey-lighter">
            <?php foreach ($order->get_order_item_totals() as $key => $total) : ?>
                <div class="table-row">
                    <div class="table-cell p-8 font-bold border-grey-disabled border-t-2"><?php echo esc_html($total['label']); ?></div>
                    <div class="table-cell p-8 text-center border-grey-disabled border-t-2"><?php echo wp_kses_post($total['value']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="sm:hidden block">
        <?php foreach ($order_items as $item_id => $item) : ?>
            <div class="p-8 border-b">
                <div class="flex flex-col xs:flex-row justify-between mb-4"><span class="block sm:hidden font-bold mr-2">Product:</span><?php echo esc_html($item->get_name()); ?></div>
                <div class="flex flex-col xs:flex-row justify-between"><span class="block sm:hidden font-bold mr-2">Price:</span><?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?></div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($order->get_order_item_totals() as $key => $total) : ?>
            <div class="p-8 border-t">
                <div class="font-bold"><?php echo esc_html($total['label']); ?></div>
                <div><?php echo wp_kses_post($total['value']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php do_action('woocommerce_order_details_after_order_table', $order); ?>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var backButton = document.querySelector('.woocommerce-MyAccount-content .wc-backward-container');
        if (backButton) {
            var myAccountContent = document.querySelector('.woocommerce-MyAccount-content');
            if (myAccountContent) {
                myAccountContent.parentNode.insertBefore(backButton, myAccountContent);
            }
        }
        // Function to move the "Order Again" button
        function moveOrderAgainButton() {
            // Select the "Order Again" button
            var orderAgainButton = document.querySelector('.wc-reorder-button-container');
            // Select the My Account content section
            var myAccountContent = document.querySelector('.woocommerce-MyAccount-content');

            // Check if both elements exist
            if (orderAgainButton && myAccountContent) {
                // Clone the "Order Again" button
                var clonedButton = orderAgainButton.cloneNode(true);
                // Remove the original button to prevent duplicates
                orderAgainButton.remove();
                // Insert the cloned button after the My Account content section
                myAccountContent.parentNode.insertBefore(clonedButton, myAccountContent.nextSibling);
            }
        }

        // Execute the function to move the button
        moveOrderAgainButton();
    });
</script>
