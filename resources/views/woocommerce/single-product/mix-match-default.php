<?php
/**
 * Mix & Match Single grid Template
 */
if (!defined('ABSPATH')) {
    exit;
}

global $product;
$idds = $product->get_id();
$parentPrice = wc_get_product($product->get_id());
$parentProductPrice = $parentPrice->get_price();
$prefilleds = get_post_meta($idds, '_mm_enable_prefiled', true);
$arrayData = json_decode($mmdata);
if (!empty($arrayData->box_pricing) && 'perwoutbase' == $arrayData->box_pricing) {
    $parentPrices = '0';
} else {
    $parentPrices = $parentProductPrice;
}

$gravity_form_id = get_post_meta($product->get_id(), '_gravity_form_id', true);
?>
<style type="text/css">
    .price {
        display: none;
    }
</style>

<form class="cart pc_add_to_cart_form" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="add_new_box" id="add_new_boxes" value="<?php echo esc_attr($arrayData->add_new_box); ?>">
    <div class="mix_match_product_container bootstrap-iso">
        <div class="mix_match_container_wrap">
            <div class="row">
                <input type="hidden" name="idds" id="sids" value="<?php echo esc_attr($idds); ?>">
                <input type="hidden" name="prefilleds" id="prefilleds" value="<?php echo esc_attr($prefilleds); ?>">

                <!-- Parent product information -->
                <div class="col-md-12 mm_topHeading">
                    <hr>
                    <p class="parentPrice">
                        <?php echo wp_kses(__(wc_price($parentPrices), 'extendons-mix-match-bundles'), ''); ?>
                    </p>
                    <div class="alert alert-danger" id="mm_error">
                        <p><?php echo esc_html__('Maximum Stack Is full please remove some to add this one!', 'extendons-mix-match-bundle'); ?></p>
                    </div>
                </div>

                <?php if ('yes' == $arrayData->add_new_box): ?>
                    <input type="hidden" name="boxcount" id="boxcount" value="">
                    <input type="hidden" name="boxQty" id="boxQty" value="<?php echo esc_attr($arrayData->boxqty); ?>">
                    <div class="mm_filled_col col-md-6 <?php echo esc_attr($mmboxlayout); ?>">
                        <div id="addcollapse">
                            <button type="button" class="btn btn-basic" name="demo" id="collapsebox" data-toggle="collapse" data-target="#demo">Box 1</button>
                            <div class="collapse" id="demo">



                            <div class="row">
                                    <input type="hidden" name="boxcol" id="boxcol" value="<?php echo esc_attr($mmboxcol); ?>">
                                    <?php for ($i = 0; $i < $mmboxqty; $i++): ?>
                                        <div id="mm_item<?php echo filter_var($i); ?>" class="<?php echo filter_var($mmboxcol); ?> box-tobe-filled <?php echo !empty($prefilled[$i]['product_id']) ? 'mm_yes' : ''; ?> <?php echo !empty($prefilled[$i]['pre_mandetory']) ? 'mendatory' : ''; ?>" data-pid="<?php echo !empty($prefilled[$i]['product_id']) ? filter_var($prefilled[$i]['product_id']) : ''; ?>">
                                            <?php echo '<span>' . (!empty($prefilled[$i]['product_id']) ? filter_var($temp) : '') . '</span>'; ?>
                                            <div class="mm_remove_product_icon"></div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Alert danger -->
                        <div class="p-4 alert alert-success bg-green-success" id="mm_stack_full">
                            <p><?php echo esc_html__('Box is full', 'extendons-mix-match-bundle'); ?></p>
                        </div>

                        <!-- Display Gravity Form if selected -->
                        <?php if ($gravity_form_id): ?>
                            <div class="gform_wrapper">
                                <?php echo do_shortcode('[gravityform id="' . esc_attr($gravity_form_id) . '" title="false" description="false" ajax="true"]'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mm_quantity_addtocart">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <form method="POST">
                                        <div id="add_new_box"><button class="btn btn-outline-dark" type="button" id="AddBoxCustom">Add Box Quantity</button></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><?php echo esc_html__('Product Quantity', 'extendons-mix-match-bundle'); ?></h4>
                                    </div>
                                    <div class="col-md-6 mm_float_center">
                                        <?php
                                        if (!$product->is_sold_individually()) {
                                            woocommerce_quantity_input(
                                                array(
                                                    'min_value' => apply_filters('woocommerce_quantity_input_min', 1, $product),
                                                    'max_value' => apply_filters('woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product),
                                                )
                                            );
                                        }
                                        ?>
                                        <input type="hidden" id="mmproduct_data" value='<?php echo esc_attr($mmdata); ?>' minqty="<?php echo esc_attr($mmboxqty); ?>">
                                        <div id='lol'></div>
                                        <input id="mm_product_items" type="hidden" name="mm_product_items" value="">
                                        <input id="mmperItemPrice" type="hidden" name="mmperItemPrice" value="">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mm_totalPrice">
                                    <div class="col-md-6">
                                        <h4><?php echo esc_html__('Total Price', 'extendons-mix-match-bundle'); ?></h4>
                                    </div>
                                    <div class="col-md-6 mm_float_center">
                                        <p class="parentPrice">
                                            <?php echo wp_kses(__(wc_price($parentPrices), 'extendons-mix-match-bundles'), ''); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php do_action('min_match_box_product_after_price_sub', $product->get_id()); ?>
                                <button disabled="disabled" type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Bundle to be filled section -->
                    <div class="mm_filled_col col-md-6 <?php echo esc_attr($mmboxlayout); ?>">
                        <div class="row">
                            <input type="hidden" name="boxcol" id="boxcol" value="<?php echo esc_attr($mmboxcol); ?>">
                            <?php for ($i = 0; $i < $mmboxqty; $i++): ?>
                                <div id="mm_item<?php echo filter_var($i); ?>" class="<?php echo filter_var($mmboxcol); ?> box-tobe-filled <?php echo !empty($prefilled[$i]['product_id']) ? 'mm_yes' : ''; ?> <?php echo !empty($prefilled[$i]['pre_mandetory']) ? 'mendatory' : ''; ?>" data-pid="<?php echo !empty($prefilled[$i]['product_id']) ? filter_var($prefilled[$i]['product_id']) : ''; ?>">
                                    <?php
                                    if ('yes' == $prefilleds) {
                                        $temp = '<img src="' . esc_url(get_the_post_thumbnail_url($prefilled[$i]['product_id'])) . '">';
                                    }
                                    ?>
                                    <?php echo '<span>' . (!empty($prefilled[$i]['product_id']) ? filter_var($temp) : '') . '</span>'; ?>
                                    <div class="mm_remove_product_icon"></div>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <!-- Alert danger -->
                        <div class="p-4 alert alert-success bg-green-success" id="mm_stack_full">
                            <p><?php echo esc_html__('Box is full', 'extendons-mix-match-bundle'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Items displayed section -->
                <div class="mm_add_product_col col-md-6">
                    <div class="row">
                        <div class=" col-md-12">
                            <?php foreach ($mixmatch_items as $key => $value): ?>
                                $_product = wc_get_product($value);
                                <div class="<?php echo esc_attr($mmprocolay); ?> box_pro_item">
                                    <figure class="product_mm" data-mm_id="<?php echo esc_attr($value); ?>">
                                        <img id="mm_product_image<?php echo esc_attr($value); ?>" src="<?php echo esc_url(get_the_post_thumbnail_url($value)); ?>">
                                        <div class="thumb-up-mm" id="thumb-up-<?php echo esc_attr($value); ?>">
                                            <p><?php esc_html_e('Item Added', 'extendons-mix-match-bundle'); ?></p>
                                            <img src="<?php echo esc_url(MIXMATCH_BUNDLES_URL . '/assets/images/added-image.png'); ?>">
                                        </div>
                                        <div class="mm_adding-pro-icon"></div>
                                        <div class="mm_quantity buttons_added">
                                            <input type="button" value="-" class="minus"><input id="product-quantity<?php echo esc_attr($value); ?>" type="number" step="1" min="1" max="" name="mm_quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                                        </div>
                                        <div class="mm-item-info">
                                            <p class="mm_pro_title"><?php echo esc_attr(get_the_title($value)); ?></p>
                                            <span class="mm_item_price">
                                                <?php echo wp_kses(__(wc_price($_product->get_price()), 'extendons-mix-match-bundles'), ''); ?>
                                            </span>
                                        </div>
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php do_action('mixmatch_optoins_compatible_before_add_to_cart_button'); ?>

            <?php if (isset($giftmasg) && 'yes' == $giftmasg): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mm-gift-masg">
                            <label class="gift-masg-label" for="mm-gmasg">
                                <?php echo esc_html__($masglabel, 'extendons-mix-match-bundle'); ?>
                            </label>
                            <textarea name="mm_gift_massage" id="mm-gmasg" rows="10" cols="10" placeholder="Enter a gift message here"></textarea>
                            <input type="hidden" name="mm_gift_massage_lbl" value="<?php echo esc_attr($masglabel); ?>">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>
