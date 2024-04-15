<?php

/**
 * The template for displaying product content in the content-shop-the-look.php template
 *
 * @author James Kemp
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

global $product, $woosuite_woo_mix_and_match_products;

$wrapper_classes = array('woosuite-mix-and-match');
$stl_products    = array_filter($product->get_products(), array(
    $woosuite_woo_mix_and_match_products,
    'is_allowed_in_look'
));
if (empty($stl_products)) {
    return;
}

$options = get_post_meta($product->get_id(), $woosuite_woo_mix_and_match_products->product_options_name, true);
$options['max_qty'] = $options['max_qty'] ?: count($stl_products);
$enabled_popup = Woosuite_MAM_Core_Helpers::is_popup_mode_enabled($product);
?>

<div id="woosuite-mix-and-match-wrapper" class="woosuite-mix-and-match-wrapper <?php echo $enabled_popup ? 'enabled-popup' : ''; ?>">
    <?php if ($enabled_popup) { ?>
        <span class="woosuite-mix-match-close close"></span>
    <?php } ?>
    <h2><?php echo $product->get_name(); ?></h2>

    <?php
    if ($description = $product->get_description()) {
        echo '<p class="description">' . $description . '</p>';
    }
    ?>

    <div style="margin-bottom:100px;">

        <div class="woosuite-mix-and-match-progress-wrap">
            <div class="woosuite-mix-and-match-filled-progress">
                <div class="woosuite-mix-and-match-box-count">
                    <span class="woosuite-mix-and-match-filled-count"><b>0</b></span>
                    <span class="woosuite-mix-and-match-slash">/</span>
                    <span class="woosuite-mix-and-match-total-count"><?php echo $options['max_qty']; ?></span>
                </div>
                <div class="woosuite-mix-and-match-progress-bar">
                    <div class="woosuite-mix-and-match-filled-part">

                    </div>
                </div>
            </div>
            <div class="woosuite-mix-and-match-calculated-price-wrap">
                <span class="woosuite-mix-and-match-calculated-label">
                    <?php echo __('Greeeand Total', 'woosuite-mix-and-match'); ?>
                </span>
                <span class="woosuite-mix-and-match-calculated-price">
                    <?php echo wc_price(0); ?>
                </span>
            </div>
        </div>

        <div class="woosuite-mix-and-match-available woosuite-mix-and-match-column" style="margin-right:20px;">
            <?php foreach ($stl_products as $stl_product) { ?>

                <div class="woosuite-mix-and-match-item" data-product-id="<?php echo $stl_product->get_id(); ?>" data-product-type="<?php echo $stl_product->get_type(); ?>" data-price="<?php echo $stl_product->get_price(); ?>">
                    <span class="dashicons dashicons-insert"></span>

                    <?php
                    do_action('woosuite_mam_content_product_image', $stl_product, $product);
                    do_action('woosuite_mam_content_product_title', $stl_product, $product);

                    if ($options['price_display'] == 'per_item') {
                        do_action('woosuite_mam_content_product_price', $stl_product, $product);
                    }

                    if ('variable' === $stl_product->get_type()) {
                        do_action('woosuite_mam_content_variable_product_popup', $stl_product, $product);
                    }

                    ?>

                </div>

            <?php } ?>
        </div>

        <div class="woosuite-mix-and-match-selected woosuite-mix-and-match-column">

            <?php
            for ($i = 0; $i < $options['max_qty']; $i++) {
            ?>
                <div class="woosuite-mix-and-match-item"></div>
            <?php
            }
            ?>

        </div>

    </div>

    <div>

        <div class="woosuite-mix-and-match-column" style="margin-right:20px;">
            <?php if ($options['enable_custom_message']) : ?>
                <div class="woosuite-mix-and-match-box">
                    <p><?php echo __('Gift Message', 'woosuite-mix-and-match'); ?></p>
                    <textarea class="custom-message" placeholder="<?php echo __('Add a gift message here', 'woosuite-mix-and-match'); ?>"></textarea>
                </div>
            <?php endif; ?>
        </div>

        <div class="woosuite-mix-and-match-column">
            <div class="woosuite-mix-and-match-box woosuite-mix-and-match-add-to-cart">
                <form class="cart" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_ids">
                    <input type="hidden" name="custom_message">

                    <table>
                        <tr>
                            <td><?php echo __('Box quantity', 'woosuite-mix-and-match'); ?></td>
                            <td>

                                <span class="stepper">
                                    <button class="decrease">–</button>
                                    <input type="number" name="quantity" id="stepper" min="1" max="100" value="1" step="1" readonly>
                                    <button class="increase">+</button>
                                </span>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Box Total', 'woosuite-mix-and-match'); ?></td>
                            <td class="woosuite-mix-and-match-box-total">
                                <?php
                                echo sprintf('<del class="original-price" style="display:none">%s</del> <ins class="applied-price">%s</ins>', wc_price(0), wc_price(0));
                                ?>
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td><?php echo __('Box Charges', 'woosuite-mix-and-match'); ?></td>
                            <td class="woosuite-mix-and-match-box-charges">
                                <?php echo wc_price(0); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Grand Total', 'woosuite-mix-and-match'); ?></td>
                            <td class="woosuite-mix-and-match-grand-total">
                                <?php echo wc_price(0); ?>
                            </td>
                        </tr>
                    </table>

                    <div style="width:100%;margin-top:50px;text-align:center;">
                        <button type="submit" name="add-to-cart" value="<?php echo $product->get_id(); ?>" class="woo-mix-match-add-to-cart-button button alt"><?php echo __('Add to cart', 'woocommerce'); ?></button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>