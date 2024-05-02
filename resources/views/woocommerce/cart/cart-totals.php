<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="px-4 md:px-0 cart_totals w-full lg:max-w-max-503 <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

    <?php do_action('woocommerce_before_cart_totals'); ?>
    <div class="py-4 text-left border-b-2 border-black-full">
        <h2 class="font-medium text-md-font text-black-full"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h2>
    </div>
    <div class="shop_table shop_table_responsive bg-grey-background">

        <div class="flex items-center justify-between bg-white border-b border-solid cart-subtotal text-black-full text-base-font font-reg420 border-black-full">
            <div class="w-1/2 py-5 pl-6 bg-grey-background"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
            <div data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                <?php wc_cart_totals_subtotal_html(); ?>
            </div>
        </div>

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> text-black-full text-base-font font-reg420 flex justify-between items-center border-b border-black-full border-solid">
                <div class="w-1/2 py-5 pl-6 bg-grey-background"><?php wc_cart_totals_coupon_label($coupon); ?></div>
                <div class="flex flex-col justify-end mobile:flex-row" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>">
                    <?php wc_cart_totals_coupon_html($coupon); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="flex items-center justify-between w-full py-5 fee text-black-full text-base-font font-reg420">
                <div class="w-1/2 pl-6 bg-grey-background"><?php echo esc_html($fee->name); ?></div>
                <div>
                    <div data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php
        if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';

            if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
                /* translators: %s location. */
                $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
            }

            if ('itemized' === get_option('woocommerce_tax_total_display')) {
                foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        ?>
                    <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> text-black-full text-base-font font-reg420 flex justify-between items-center">
                        <div><?php echo esc_html($tax->label) . $estimated_text; ?></div>
                        <div data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="flex items-center justify-between border-b border-solid tax-total text-black-full text-base-font font-reg420 border-black-full">
                    <div class="w-1/2 py-5 pl-6 bg-grey-background"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></div>
                    <div data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
                </div>
        <?php
            }
        }
        ?>

        <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

        <div class="flex items-center justify-between w-full border-b-2 border-solid order-total text-black-full text-base-font font-reg420 border-black-full">
            <div class="w-1/2 py-5 pl-6 text-left bg-grey-background"><?php esc_html_e('Total', 'woocommerce'); ?></div>
            <div data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>

        <?php do_action('woocommerce_cart_totals_after_order_total'); ?>

    </div>

    <div class="wc-proceed-to-checkout">
        <?php do_action('woocommerce_proceed_to_checkout'); ?>
    </div>

    <?php do_action('woocommerce_after_cart_totals'); ?>

</div>
