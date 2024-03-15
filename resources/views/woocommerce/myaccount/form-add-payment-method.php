<?php

/**
 * Add payment method form form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-add-payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
if ($available_gateways) : ?>
    <form id="add_payment_method" method="post">
        <div id="payment" class="woocommerce-Payment">
            <ul class="woocommerce-PaymentMethods payment_methods methods">
                <?php
                // Chosen Method.
                if (count($available_gateways)) {
                    current($available_gateways)->set_current();
                }

                foreach ($available_gateways as $gateway) {
                ?>
                    <li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr($gateway->id); ?> payment_method_<?php echo esc_attr($gateway->id); ?>">
                        <div class="mb-6 flex flex-row items-center">
                            <input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio mr-4" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> />
                            <label for="payment_method_<?php echo esc_attr($gateway->id); ?>"><?php echo wp_kses_post($gateway->get_title()); ?> <?php echo wp_kses_post($gateway->get_icon()); ?></label>
                        </div>
                        <?php
                        if ($gateway->has_fields() || $gateway->get_description()) {
                            echo '<div class="woocommerce-PaymentBox woocommerce-PaymentBox--' . esc_attr($gateway->id) . ' payment_box payment_method_' . esc_attr($gateway->id) . '" style="display: none;">';
                            $gateway->payment_fields();
                            echo '</div>';
                        }
                        ?>
                    </li>
                <?php
                }
                ?>
            </ul>

            <?php do_action('woocommerce_add_payment_method_form_bottom'); ?>

            <div class="form-row">
                <?php wp_nonce_field('woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce'); ?>
                <button type="submit" class="woocommerce-Button woocommerce-Button--alt button text-center text-yellow-primary hover:text-black-full text-mob-lg-font lg:text-mob-md-font font-medium py-3 bg-black-full hover:bg-primary-yellow rounded-lg-x w-full lg:w-1/2 hover:bg-yellow-primary mb-4 border-solid border-2 border-yellow-primary hover:border-black-full alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" id="place_order" value="<?php esc_attr_e('Add payment method', 'woocommerce'); ?>"><?php esc_html_e('Add payment method', 'woocommerce'); ?></button>
                <input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />
            </div>
        </div>
    </form>
<?php else : ?>
    <?php wc_print_notice(esc_html__('New payment methods can only be added during checkout. Please contact us if you require assistance.', 'woocommerce'), 'notice'); ?>
<?php endif; ?>