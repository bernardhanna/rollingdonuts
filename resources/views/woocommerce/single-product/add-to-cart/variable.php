<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok.
                                                                                                                                                                                                                                                                                        ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
        <table class="variations" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <tr>
                        <th class="label"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); // WPCS: XSS ok.
                                                                                                                ?></label></th>
                        <td class="value">
                            <?php
                            wc_dropdown_variation_attribute_options(
                                array(
                                    'options'   => $options,
                                    'attribute' => $attribute_name,
                                    'product'   => $product,
                                )
                            );
                            echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class="single_variation_wrap">
            <input type="hidden" name="attribute_pa_colour" value="" id="hidden_input_colour">
            <input type="hidden" name="attribute_pa_size" value="" id="hidden_input_size">
            <input type="hidden" name="attribute_pa_fit" value="" id="hidden_input_fit">
            <?php
            /**
             * Hook: woocommerce_before_single_variation.
             */
            do_action('woocommerce_before_single_variation');

            /**
             * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
             *
             * @since 2.4.0
             * @hooked woocommerce_single_variation - 10 Empty div for variation data.
             * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
             */
            do_action('woocommerce_single_variation');

            /**
             * Hook: woocommerce_after_single_variation.
             */
            do_action('woocommerce_after_single_variation');
            ?>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>
<script>
    document.addEventListener('click', function(event) {
        if (event.target.matches('.color-swatch')) {
            var color = event.target.dataset.color; // Assuming your buttons have data-color attributes
            document.getElementById('hidden_input_colour').value = color;
        }
        // Similar handling for size and fit selections
    });

    document.addEventListener('click', function(event) {
        // Check if the clicked element is meant for selecting a variation
        if (event.target.matches('[data-attribute]')) {
            const attribute = event.target.getAttribute('data-attribute');
            const value = event.target.getAttribute('data-value');

            // Update the corresponding hidden input based on the data-attribute value
            document.querySelector(`input[name="attribute_${attribute}"]`).value = value;
        }
    });
</script>
<?php
do_action('woocommerce_after_add_to_cart_form');
