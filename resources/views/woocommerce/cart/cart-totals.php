<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-24 11:59:13
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 12:32:18
 */

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
    <div class="border-b-2 border-black-full py-4 text-left">
        <h2 class="text-md-font text-black-full font-medium"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h2>
    </div>
    <div class="shop_table shop_table_responsive">

        <div class="cart-subtotal text-black-full text-base-font font-reg420 flex justify-between items-center border-b border-black-full border-solid">
            <div class="bg-grey-background py-5 w-1/2 pl-6"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
            <div data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                <?php wc_cart_totals_subtotal_html(); ?>
            </div>
        </div>

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> flex justify-between items-center w-full border-b border-black-full border-solid">
                <div class="bg-grey-background py-5 w-1/2 pl-6"><?php wc_cart_totals_coupon_label($coupon); ?><div>
                        <div data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></div>
                    </div>
                <?php endforeach; ?>

                <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>


                <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

                    <div class="shipping py-5 text-black-full text-base-font font-reg42 flex justify-between items-center border-b border-black-full border-solid">
                        <div class="bg-grey-background w-1/2 pl-6"><?php esc_html_e('Shipping', 'woocommerce'); ?><div>
                                <div data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></div>
                            </div>

                        <?php endif; ?>

                        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                            <div class="fee text-black-full text-base-font font-reg420 w-full flex justify-between items-center py-5">
                                <div class="bg-grey-background w-1/2 pl-6"><?php echo esc_html($fee->name); ?><div>
                                        <div data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?>
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
                                                <div><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        ?><div>
                                                        <div data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                                                    </div>
                                                <?php
                                            }
                                        } else {
                                                ?>
                                                <div class="tax-total text-black-full text-base-font font-reg420 flex justify-between items-center border-b border-black-full border-solid">
                                                    <div class="bg-grey-background w-1/2 py-5 pl-6"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                                                    ?><div>
                                                            <div data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
                                                        </div>
                                                <?php
                                            }
                                        }
                                                ?>

                                                <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

                                                <div class="order-total text-black-full text-base-font font-reg420 w-full flex justify-between items-center border-b-2 border-black-full border-solid">
                                                    <div class="pl-6 text-left bg-grey-background py-5 w-1/2"><?php esc_html_e('Total before delivery (calculated on the next page)', 'woocommerce'); ?></div>
                                                    <div data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
                                                </div>

                                                <?php do_action('woocommerce_cart_totals_after_order_total'); ?>

                                                    </div>

                                                    <div class="wc-proceed-to-checkout">
                                                        <?php do_action('woocommerce_proceed_to_checkout'); ?>
                                                    </div>

                                                    <?php do_action('woocommerce_after_cart_totals'); ?>

                                                </div>