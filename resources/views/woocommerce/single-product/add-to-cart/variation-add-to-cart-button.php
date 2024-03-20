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



    <button type="submit" class="single_add_to_cart_button h-[58px] text-sm-md-font font-reg420 text-yellow-primary hover:text-black-full bg-black-full hover:bg-yellow-primary rounded-lg-x border-2 border-yellow-primary w-full max-w-max-368 button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
    <input type="hidden" name="attribute_pa_colour" value="" id="hidden_input_colour">
    <input type="hidden" name="attribute_pa_size" value="" id="hidden_input_size">
    <input type="hidden" name="attribute_pa_fit" value="" id="hidden_input_fit">

</div>