<?php

/**
 * Single variation cart button
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

    <button type="submit" class="single_add_to_cart_button button alt mt-10 btn-width rounded-btn-72 border-3 border-color-yellow-primary bg-black-full text-yellow-primary whitespace-nowrap text-sm-md-font mobile:text-base-font small:text-xxs-font tablet-sm:text-sm-md-font font-reg420 w-full md:w-[322px] h-[56px] tablet-sm:w-[362px] tablet-sm:h-[72px] flex flex-row items-center justify-center hover:bg-yellow-primary hover:text-black-full disabled wc-variation-selection-needed"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>