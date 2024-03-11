<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-24 10:36:25
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 11:56:17
 */

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<style>
    .woocommerce table.shop_table {
        border: 0px;
        margin: auto;
        text-align: left;
        width: 100%;
        border-collapse: separate;
        border-radius: 5px;
    }

    .woocommerce a.remove {
        color: black !important;
    }

    #add_payment_method table.cart img,
    .woocommerce-cart table.cart img,
    .woocommerce-checkout table.cart img {
        width: 32px;
        box-shadow: none;
        display: flex;
        width: 5.25rem;
        height: 4rem;
        align-items: flex-start;
        flex-shrink: 0;
        border-radius: 0.5rem;
    }

    .coupon button {
        border-radius: 4.5rem !important;
        border: 3px solid #FFED56 !important;
        background: #000 !important;
        color: #FFED56 !important;
        font-family: Edmondsans !important;
        font-size: 1.25rem !important;
        font-style: normal !important;
        font-weight: 420 !important;
        line-height: 1.5rem !important;
    }

    .coupon button:hover {
        background: #FFED56 !important;
        color: #000 !important;
    }

    .update-cart button {
        width: 100% !important;
        max-width: 17.25rem !important;
        padding: 1rem 2.5rem !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 1rem !important;
        border-radius: 4.5rem !important;
        background: #FFED56 !important;
        display: flex !important;
    }

    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
    .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button {
        text-align: center;
        margin-bottom: 1em;
        font-size: 1.25em !important;
        padding: 1em !important;
        background: black !important;
        border-radius: 4.5rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 1.25rem !important;
        font-style: normal !important;
        font-weight: 410 !important;
        line-height: 1.5rem;
    }

    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover {
        background: #FFED56 !important;
        color: black !important;
    }
</style>
<div class="px-4 md:px-0 pb-6 w-full max-w-max-1300 mx-auto">
    <h2 class="text-left text-xl-font font-reg420 text-black-full"><?php _e('Cart', 'rolling-donut'); ?></h2>
</div>
<form class="px-4 md:px-0 woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>

    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full max-w-max-1300 mx-auto" cellspacing="0">
        <thead class="border-t border-black-full border-solid border-b max-tablet-sm:hidden">
            <tr>
                <th class="product-remove text-left py-4"><span class="screen-reader-text"><?php esc_html_e('Remove item', 'woocommerce'); ?></span></th>
                <th class="product-thumbnai text-left py-4"><span class="screen-reader-text"><?php esc_html_e('Thumbnail image', 'woocommerce'); ?></span></th>
                <th class="product-name text-left py-4"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                <th class="product-price text-left py-4"><?php esc_html_e('Price', 'woocommerce'); ?></th>
                <th class="product-quantity text-center py-4"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
                <th class="product-subtotal text-left py-4"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php do_action('woocommerce_before_cart_contents'); ?>

            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                /**
                 * Filter the product name.
                 *
                 * @since 2.1.0
                 * @param string $product_name Name of the product in the cart.
                 * @param array $cart_item The product in the cart.
                 * @param string $cart_item_key Key for the product in the cart.
                 */
                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
                    <tr class="border-b border-solid border-grey-border woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                        <td class="product-remove py-4">
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                    /* translators: %s is the product name */
                                    esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                    esc_attr($product_id),
                                    esc_attr($_product->get_sku())
                                ),
                                $cart_item_key
                            );
                            ?>
                        </td>

                        <td class="product-thumbnail py-4">
                            <?php
                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('h-[64px] w-[84px] rounded-normal object-cover'), $cart_item, $cart_item_key);

                            if (!$product_permalink) {
                                echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                                printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                            }
                            ?>
                        </td>

                        <td class="product-name py-4 font-laca text-sm-font font-light" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                            <?php
                            if (!$product_permalink) {
                                echo wp_kses_post($product_name . '&nbsp;');
                            } else {
                                /**
                                 * This filter is documented above.
                                 *
                                 * @since 2.1.0
                                 */
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="uppercase" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                            }

                            do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                            // Meta data.
                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                            // Backorder notification.
                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                            }
                            ?>
                        </td>

                        <td class="product-price py-4 font-laca text-sm-font font-light" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                            <?php
                            echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                            ?>
                        </td>

                        <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                            <?php
                            if ($_product->is_sold_individually()) {
                                $min_quantity = 1;
                                $max_quantity = 1;
                            } else {
                                $min_quantity = 0;
                                $max_quantity = $_product->get_max_purchase_quantity();
                            }

                            $product_quantity = woocommerce_quantity_input(
                                array(
                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                    'input_value'  => $cart_item['quantity'],
                                    'max_value'    => $max_quantity,
                                    'min_value'    => $min_quantity,
                                    'product_name' => $product_name,
                                ),
                                $_product,
                                false
                            );

                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                            ?>
                        </td>

                        <td class="product-subtotal py-4 font-laca text-sm-font font-bolder" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                            <?php
                            echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                            ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>

    <?php do_action('woocommerce_cart_contents'); ?>

    <div class="w-full max-w-max-1300 mx-auto my-8">
        <div class="actions w-full flex flex-col-reverse md:flex-row justify-end md:justify-between border-t border-black-full border-solid border-b py-4">
            <div class="w-full md:2/3 lg:w-1/2 md:max-w-max-584">
                <?php if (wc_coupons_enabled()) { ?>
                    <div class="coupon w-full flex max-mobile:flex-col justify-between">
                        <input type="text" name="coupon_code" class="rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full mobile:max-w-max-358" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="max-mobile:mt-4 button text-yellow-primary bg-black-full border-3 border-solid border-yellow-primary rounded-btn-72 text-base-font font-reg420 hover:border-black-full h-[56px] hover:bg-yellow-primary hover:text-black-full w-full mobile:min-w-min-208 mobile:w-[208px] flex items-center justify-center <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
                        <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="w-full md:w-1/3 lg:1/2 flex justify-end max-md:pb-8 update-cart">
                <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> text-black bg-yellow-primary border-3 border-solid border-yellow-primary rounded-btn-72 text-base-font font-reg420 hover:border-black-full hover:bg-black-full hover:text-yellow-primary min-w-min-208 w-full md:w-[208px] flex items-center justify-center h-[56px]" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
            </div>
            <?php do_action('woocommerce_cart_actions'); ?>

            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
        </div>
    </div>

    <?php do_action('woocommerce_after_cart_contents'); ?>

    <?php do_action('woocommerce_after_cart_table'); ?>
</form>

<?php do_action('woocommerce_before_cart_collaterals'); ?>
<div class="w-full max-w-max-1300 mx-auto">
    <div class="cart-collaterals flex justify-end">
        <?php
        /**
         * Cart collaterals hook.
         *
         * @hooked woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        do_action('woocommerce_cart_collaterals');
        ?>
    </div>
</div>
<?php do_action('woocommerce_after_cart'); ?>
<div class="pb-48"></div>