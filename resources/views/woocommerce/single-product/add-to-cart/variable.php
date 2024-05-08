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
<style>
    .colour-attribute li {
        height: 48px !important;
        width: 48px !important;
    }

    .merch-size-attribute li {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px !important;
        border-radius: 72px !important;
        border: 1px solid var(--yellow-disabled, #D8D7CE) !important;
        color: #000 !important;
        font-size: 18px !important;
        font-style: normal;
        font-weight: 410 !important;
        width: 56px !important;
        height: 40px !important;
    }

    .merch-size-attribute li:hover {
        background-color: #FFED56 !important;
    }

    .merch-size-attribute li.selected {
        background-color: #FFED56 !important;
    }

    .fit-size-attribute li {
        color: #000 !important;
        font-size: 20px !important;
        font-style: normal;
        font-weight: 410 !important;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 72px !important;
        border: 1px solid var(--yellow-disabled, #D8D7CE) !important;
        background: var(--white, #FFF) !important;
        height: 56px !important;
        width: 100%;
        min-width: 249px;
    }

    .fit-size-attribute li:hover {
        background-color: #FFED56 !important;
    }

    .fit-size-attribute li.selected {
        background-color: #FFED56 !important;
    }

    .woo-selected-variation-item-name {
        display: none;
    }

    .woo-variation-swatches .variable-items-wrapper {
        padding-left: 1rem
    }

    @media (max-width: 380px) {
        .woo-variation-swatches .variable-items-wrapper {
            padding-left: 0px;
        }
    }
</style>


<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok.
                                                                                                                                                                                                                                                                                        ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
        <div class="w-full variations" role="presentation">
            <div>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <div class="flex items-center justify-start py-4">
                        <div class="flex flex-row label text-sm-md-font font-reg420">
                            <label class="hidden small:flex" for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                                <?php echo wc_attribute_label($attribute_name) . ':';
                                ?>
                            </label>
                        </div>
                        <div class="flex value">
                            <?php
                            wc_dropdown_variation_attribute_options(
                                array(
                                    'options'   => $options,
                                    'attribute' => $attribute_name,
                                    'product'   => $product,
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <?php echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="text-black-full btn text-mob-lg-font lg:text-sm-md-font font-reg420 py-3 bg-white rounded-lg-x w-full lg:w-256 rd-border hover:text-black-full hover:bg-yellow-primary mb-4 reset_variations h-[50px]" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : ''; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class=" single_variation_wrap">
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
    document.querySelectorAll('[data-attribute_name="attribute_pa_colour"]').forEach(function(el) {
        el.classList.add('colour-attribute');
    });
    document.querySelectorAll('[data-attribute_name="attribute_pa_merch-size"]').forEach(function(el) {
        el.classList.add('merch-size-attribute');
    });
    document.querySelectorAll('[data-attribute_name="attribute_pa_fit"]').forEach(function(el) {
        el.classList.add('fit-size-attribute');
    });
</script>
<?php
do_action('woocommerce_after_add_to_cart_form');
