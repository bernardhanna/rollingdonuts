<?php

/**
 * Thankyou page
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
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
custom_thankyou_order_details($order->get_id());
$order = wc_get_order($order->get_id());

$is_local_pickup_plus = false;
$location_id = '';

// Loop through shipping items to check for Local Pickup Plus and fetch location ID
foreach ($order->get_items('shipping') as $item) {
    if ($item->get_method_id() === 'local_pickup_plus') { // Ensure this matches your method ID
        $is_local_pickup_plus = true;
        $location_id = $item->get_meta('_pickup_location_id');
        break; // Stop the loop once the first local pickup plus item is found
    }
}
?>
<div class="woocommerce-order px-4 lg:max-w-max-1568 m-auto">
    <?php
    // Fetch the text-white font-lighter text-sm-md-font woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-receivedtext-white font-lighter text-sm-md-font woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received'ty_image' field from the ACF options page
    $ty_image = get_field('ty_image', 'option');
    ?>
    <!-- Unsplash Image to the left -->
    <div class="h-full flex-col lg:flex-row flex lg:justify-between items-center">
        <?php if ($ty_image) : ?>
            <div class=" w-full lg:w-1/2 flex justify-center items-center">
                <img class="h-[346px] lg:h-auto w-full object-contain" src="<?php echo esc_url($ty_image); ?>" alt="Order Success">
            </div>
        <?php endif; ?>
        <div class="w-full lg:1/2">
            <?php if ($order) :

                do_action('woocommerce_before_thankyou', $order->get_id());
            ?>

                <?php if ($order->has_status('failed')) : ?>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                        <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                        <?php if (is_user_logged_in()) : ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                        <?php endif; ?>
                    </p>

                <?php else : ?>

                    <?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

                    <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                        <li class="flex justify-center items-center order-numb border-t border-b border-white py-4 woocommerce-order-overview__order order text-white text-sm-md-font lg:text-md-font my-4">
                            <?php esc_html_e('Order number:', 'woocommerce'); ?>
                            <strong class="font-reg420"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        ?></strong>
                        </li>

                        <li class="woocommerce-order-overview__date date text-white text-sm-md-font lg:text-md-fon">
                            <?php esc_html_e('Order Date:', 'woocommerce'); ?>
                            <?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>
                        </li>

                        <?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
                            <li class="woocommerce-order-overview__email email text-sm-md-font lg:text-mob-md-font text-white">
                                <?php esc_html_e('Email:', 'woocommerce'); ?>
                                <?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                ?>
                            </li>
                        <?php endif; ?>
                        <li class=" woocommerce-order-overview__total total text-white text-mob-md-font">
                            <?php esc_html_e('Total:', 'woocommerce'); ?>
                            <?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>
                        </li>
                        <?php

                        $shipping_items = $order->get_items('shipping');
                        $is_local_pickup_plus = false;
                        foreach ($shipping_items as $item_id => $shipping_item) {
                            if (strpos($shipping_item->get_method_title(), 'Collection') !== false) {
                                $is_local_pickup_plus = true;
                                break;
                            }
                        }

                        if ($is_local_pickup_plus && $location_id) :
                            // Fetch location details
                            $location_post = get_post($location_id);
                            $location_name = $location_post ? $location_post->post_title : '';
                            $location_address_meta = get_post_meta($location_id, '_pickup_location_address', true);
                        ?>
                            <li class="text-white text-sm-font lg:text-mob-md-font mt-4">
                                <?php
                                $location_id = ''; // Initialize outside the loop for wider scope
                                $pickup_date = $order->get_meta('jckwds_date');
                                $timeslot = $order->get_meta('jckwds_timeslot');
                                $location_details = get_location_details_by_id($location_id);
                                echo '<p><strong>Collection Date:</strong> ' . esc_html($pickup_date) . '</p>';
                                echo '<p><strong>Collection Timeslot:</strong> ' . esc_html($timeslot) . '</p>';
                                //echo collection location
                                echo '<p><strong>Collection Location:</strong> ' . esc_html($location_name) . '</p>';
                                ?>
                            </li>
                        <?php else : ?>
                            <li class="text-white text-sm-font lg:text-mob-md-font mt-4">
                                <?php echo esc_html($order->get_formatted_billing_full_name()); ?>
                            </li>
                            <?php if ($order->get_billing_address_1()) : ?>
                                <li class="text-white text-sm-font lg:text-mob-md-font">
                                    <?php echo esc_html($order->get_billing_address_1()); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($order->get_billing_address_2()) : ?>
                                <li class="text-white text-sm-font lg:text-mob-md-font">
                                    <?php echo esc_html($order->get_billing_address_2()); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($order->get_billing_city()) : ?>
                                <li class="text-white text-sm-font lg:text-mob-md-font">
                                    <?php echo esc_html($order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode()); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($order->get_billing_country()) : ?>
                                <li class="text-white text-sm-font lg:text-mob-md-font">
                                    <?php echo esc_html(WC()->countries->countries[$order->get_billing_country()]); ?>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>

                    <div class="mt-4">
                        <a href="/donut-box/" class="w-full border-2 text-white border-white border-solid woocommerce-button button wc-forward text-sm-font font-white font-reg420 h-[58px] text-center flex justify-center items-center rounded-btn-72 hover:bg-white hover:text-black-full transition-all">
                            <?php esc_html_e('Keep Shopping', 'woocommerce'); ?>
                        </a>
                    </div>


                <?php endif; ?> <?php else : ?> <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?> <?php endif; ?>
        </div>
    </div>
</div>