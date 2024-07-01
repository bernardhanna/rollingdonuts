<?php
defined( 'ABSPATH' ) || exit;

global $product;

$extendons_custombox_general_settings = get_option('extendons_custombox_general_settings');
$ph_src = $extendons_custombox_general_settings['_mm_image_placeholder'] ?? '';

if ('' == $ph_src) {
    $ph_src = plugin_dir_url(__FILE__) . '/images/img-empty.png';
}

$color_val = $extendons_custombox_general_settings['_mm_color_primarycolor'] ?? '#995E8E';

// Initialize $widthClass with a default value
$widthClass = 'w-auto xxl:w-1/4';

// Get the Gravity Form ID
$gravity_form_data = get_post_meta($product->get_id(), '_gravity_form_data', true);
$gravity_form_id = isset($gravity_form_data['id']) ? $gravity_form_data['id'] : 0;

?>

<?php
if ('yes' != $add_new_box_quantity) {

?>


<?php

}
?>
<style type="text/css">
    .woocommerce-Price-amount.amount bdi {
        font-weight: bold !important;
    }

    .box-product .removebg {
        background-image: none !important;
    }

    @media (min-width: 1085px) {
        .product_addon_box.simple_pd {
            border-right: 3px solid black;
        }
    }

    .box-product .relative.z-50.w-full.mb-0 {
        margin-bottom: 0px !important;
    }

    .single_add_to_cart_button.button.alt {
        white-space: nowrap;
    }

    .extendons_active_boxes,
    .prefilleditem {
        pointer-events: none;
        /* Disables clicking */
        cursor: not-allowed;
        /* Changes the cursor to indicate that the action is not allowed */
    }


    label {
        display: none;
    }

    form.cartt {
        margin-bottom: 0px;
        padding: 0px;
    }

    .mm_gift_massage {
        width: 100%;
        padding: 2rem;
        border-radius: 6px;
        margin-top: 2rem;
    }

    .product_addon_box .pd_title,
    .simple_pd .pd_add_block .pd_dtl .pd_price,
    .horizontal_box .reset_gt_box.resp .clear_cta {
        color: white !important;
    }

    .product_addon_box .pd_title {
                color: black !important;
            font-size: 16px;
        justify-content: center;
    }

    .horizontal_box .reset_gt_box.resp .clear_cta:hover {
        color: black !important;
    }

    .qodef-woo-product-title.product_title.entry-title {
        display: none !important;
    }

    .pd_addon_btns .add_btn .add_cta {
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black !important;
        border: 2px solid black !important;
    }

    .pd_addon_btns .add_btn .add_cta:hover {
        background-color: black !important;
        color: #ffed56 !important;
        border: 2px solid #ffed56 !important;
    }

    .active_gift .img_block img {
        border-radius: 100%;
        border: 2px solid #ffed56;
        max-height: 100px;
        max-width: 100px;
        min-height: 100px;
        min-width: 100px;
    }

    .prefilleditem .dlt_icon {
        display: none !important;
    }

    .dlt_icon svg g {
        stroke: black !important;
        fill: #f55959 !important;
    }

    .clear_cta {
        display: flex;
        width: 100%;
        max-width: 202.289px;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
        justify-content: center;
        align-items: center;
        gap: 21.435px;
        flex-shrink: 0;
        border: 1.34px solid #000;
        background: var(--red-critical, #C70000);
        height: 50px;
        border-radius: 8px;
        color: white !important;
        font-weight: 420;
    }

    .clear_cta:hover {
        background-color: white;
        color: black !important;
    }

    .gt_overlay {
        display: none !important;
    }

    .extendssubtotalboxes,
    .gift_box_top .gt_item_lmt .text {
        color: #000000;
    }

    .woocommerce-Price-amount.amount {
        font-weight: 400;
    }

    .bordertopbottom {
        border: 1px solid black;
        border-left: none;
        border-right: none;
    }

    .extendonsboxfillederrormsg.woocommerce-message {
        width: 100%;
        padding-bottom: 4rem;
        margin: auto;
    }

    .extendonsboxfillederrormsg.woocommerce-message p {
        background-color: #f55959;
        font-weight: 420;
        padding: 2rem;
    }

    .dlt_icon {
        position: relative;
        bottom: 100%;
        right: 2.5rem;
        top: 0px;
        width: 0px;
        height: 10px;
    }

    .extendons_add_to_cart {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .extendons_add_to_cart .quantity {
        margin-bottom: 1rem;
    }

    @media (max-width: 993px) {
        .single_add_to_cart_button.button.alt {
            font-size: 16px;
            white-space: nowrap;
        }
    }

    .extendons_active_boxes.active_gift .img_block img {
        border: none !important;
    }

    .font-normal {
        font-weight: 400;
    }
</style>
<div class="w-full px-4 py-12 mx-auto lg:py-0 product_box_container">
    <div class="flex flex-col-reverse w-full horizontal_box full_opt lg:flex-row-reverse lg:justify-between">
        <!-- display woo commerce summary -->
        <div class="w-full lg:w-2/5 gift_box_container lg:pl-8">
            <div class="hidden lg:block">
                <?php do_action('woocommerce_single_product_summary'); ?>
            </div>
            <?php if ('yes' == $add_new_box_quantity) { ?>
                <div class="gt_bx_lt">
                    <ul class="gt_box_tab">
                        <li data-tab="0" class="box_tb active_tab"><span class="box_tb_list"> <?php echo esc_html__('Box 1', 'extendons-woocommerce-product-boxes'); ?> <span class="gt_qt"><span><?php echo esc_html__('Qty:', 'extendons-woocommerce-product-boxes'); ?></span> <span class="extendonsfilledboxcount"><?php echo filter_var($prefileldArraylength); ?></span> </span></span></li>
                        </span>
                        </li>
                    </ul>

                    <?php
                    if ('yes' == $add_new_box_quantity) {

                    ?>
                        <div class="add_box " ph_src="<?php echo esc_url($ph_src); ?>" path="<?php $ph_src; ?>">
                            <a href="#!" class="add_box_cta extendonsaddnewbox add_box_hor_simple">
                                <?php echo filter_var($circled_plus); ?>&nbsp; <?php echo esc_html__(' Add Box', 'extendons-woocommerce-product-boxes'); ?>
                            </a>

                        </div>
                    <?php
                    }

                    ?>

                </div>
            <?php } ?>
            <div class="pt-12 gt_bx_rt" color_val=<?php echo filter_var($color_val); ?>>
                <div id="gift_box_0" data-box-count='0' class="text-white product_gift_box active_bx_dtl ">
                    <div class="gift_box_top">
                        <div class="hidden gt_box_qty">
                            <span class="label"><?php echo esc_html__('Box 1 Quantity', 'extendons-woocommerce-product-boxes'); ?></span>
                            <div class="gt_qty">
                                <a href="#" class="qty_control minus extenonsboxminus"></a>
                                <input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty0">
                                <a href="#" class="qty_control plus extenonsboxplus"></a>
                            </div>
                        </div>
                        <div class="add_box">
                            <!-- <a href="#!" class="add_box_cta"> <img src="images/remove.png" alt=""> <img src="images/remove_white.png" alt="">Remove Box 1</a> -->
                        </div>

                        <!-- <div class="reset_gt_box">
								<a href="#" class="clear_cta"><img src="images/remove.png" alt=""> Clear All Items</a>
							</div> -->
                    </div>
                    <div class="flex justify-center">
                        <ul class="flex flex-row flex-wrap items-center justify-around w-full p-4 mobile:p-8 mobile:justify-center bg-black-full rounded-normal gt_box_list" ph_src="<?php echo esc_url($ph_src); ?>">
                            <?php

                            if ('yes' == $mmPrefilled_enable) {

                                if (!empty($prefileldArray)) {

                                    $qunit_arr = array();
                                    $boxQty = intval($boxQty) - intval($prefileldArraylength);
                                    $totalboxQty = isset($boxQty) ? filter_var($boxQty) : '0';
                                    $totalboxQty = intval($totalboxQty) + intval($prefileldArraylength);
                                    $totalItems = $totalboxQty;
                                    // Determine the width class based on the number of items
                                    if ($totalItems == 2) {
                                        $widthClass = 'w-1/2';
                                    } elseif ($totalItems % 3 == 0) {
                                        $widthClass = 'w-auto mobile:w-1/3';
                                    } elseif ($totalItems % 4 == 0) {
                                        $widthClass = 'w-auto xxl:w-1/4';
                                    } else {
                                        $widthClass = 'w-auto xxl:w-1/4';
                                    }
                                    foreach ($prefileldArray as $key => $prefileldval) {

                                        // Default empty or initial SVG code for circled_x_id
                                        $circled_x_id = ''; // Ensure this variable has a value even if the if-condition fails.

                                        if (isset($prefileldval['pre_mandetory']) && 'on' != $prefileldval['pre_mandetory']) {
                                            $circled_x_id = '<?xml version="1.0" encoding="utf-8"?>
                                    <svg data-id="' . $product->get_id() . '" class= "extendonsremovefilledboxes ' . $product->get_id() . '" width="24px" height="24px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                    <g fill="none" fill-rule="evenodd" stroke="' . $color_val . '" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
                                    <circle cx="8.5" cy="8.5" r="8"/>
                                    <g transform="matrix(0 1 -1 0 17 0)">
                                    <path d="m5.5 11.5 6-6"/>
                                    <path d="m5.5 5.5 6 6"/>
                                    </g>
                                    </g>
                                    </svg>';
                                        }

                                        // Usage of circled_x_id later in your code
                                        if (!empty($circled_x_id)) {
                                            echo filter_var($circled_x_id);
                                        }

                                        if (isset($prefileldval['pre_mandetory']) && 'on' == $prefileldval['pre_mandetory']) {
                                            $prefilledclass = 'prefilleditem';
                                        } else {
                                            $prefilledclass = '';
                                        }
                                        $product = wc_get_product($prefileldval['product_id']);
                                        $pr_id_here = $prefileldval['product_id'];
                                        $_manage_stock = get_post_meta($product->get_id(), '_manage_stock', true);
                                        if ('yes' == $_manage_stock) {

                                            if (array_key_exists($pr_id_here, $qunit_arr)) {
                                                $qunit_arr[$pr_id_here] = (int) $qunit_arr[$pr_id_here] + 1;
                                            } else {
                                                $qunit_arr[$pr_id_here] = 1;
                                            }
                                            if ($product->get_stock_quantity() < $qunit_arr[$pr_id_here]) {
                                                continue;
                                            }
                                        }

                                        if (!$product->is_in_stock()) {
                                            continue;
                                        }
                                        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');
                                        if (!empty($image_url)) {
                                            $image_url = $image_url[0];
                                        } else {
                                            $size = 'woocommerce_thumbnail';
                                            $src = WC()->plugin_url() . '/assets/images/placeholder.png';
                                            $placeholder_image = get_option('woocommerce_placeholder_image', 0);
                                            if (!empty($placeholder_image)) {
                                                if (is_numeric($placeholder_image)) {
                                                    $image = wp_get_attachment_image_src($placeholder_image, $size);

                                                    if (!empty($image[0])) {
                                                        $src = $image[0];
                                                    }
                                                } else {
                                                    $src = $placeholder_image;
                                                }
                                            }
                                            $image_url = $src;
                                        }

                            ?>
                                        <li class="p-4 border-list <?php echo $widthClass; ?> gift_block active_gift relative justify-center items-center flex extendonsfilleditem <?php echo filter_var($prefilledclass); ?>">
                                            <div class="flex items-center justify-center w-full h-full img_block">
                                                <?php
                                                // Assuming $product is an instance of WC_Product
                                                $image_id = $product->get_image_id(); // Getting the ID of the featured image

                                                if ($image_id) {
                                                    // If there's an image ID, get the URL of the image in a specific size
                                                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                                                } else {
                                                    // If no image ID, use a placeholder
                                                    $image_url = wc_placeholder_img_src();
                                                }

                                                // Output the image tag
                                                echo '<img data-id="' . esc_attr($product->get_id()) . '" class="object-contain w-full h-full rounded-full extendonsremovefilledboxes" src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '">';
                                                ?>
                                            </div>
                                            <div class="absolute top-0 right-0 dlt_icon">
                                                <?php
                                                if ((isset($prefileldval['pre_mandetory']) && 'on' != $prefileldval['pre_mandetory']) || !isset($prefileldval['pre_mandetory'])) {
                                                    $circled_x_id = '<?xml version="1.0" encoding="utf-8"?>
                                                            <svg data-id="' . $product->get_id() . '" class= "extendonsremovefilledboxes ' . $product->get_id() . '" width="24px" height="24px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd" stroke="' . $color_val . '" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
                                                            <circle cx="8.5" cy="8.5" r="8"/>
                                                            <g transform="matrix(0 1 -1 0 17 0)">
                                                            <path d="m5.5 11.5 6-6"/>
                                                            <path d="m5.5 5.5 6 6"/>
                                                            </g>
                                                            </g>
                                                            </svg>';
                                                }
                                                ?>
                                                <?php echo filter_var($circled_x_id); ?>
                                            </div>
                                            <div class="hidden gt_overlay">
                                                <div class="overlay_inner">
                                                    <div class="price"><?php echo filter_var(wc_price($product->get_price())); ?></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php

                                    }
                                }
                            }

                            if ('' != $boxQty) {

                                for ($i = 0; $i < $boxQty; $i++) {

                                    ?>
                                    <li class="gift_block justify-center items-center flex p-4 active_gift extendons_active_boxes <?php echo $widthClass; ?>">
                                        <div class="flex items-center justify-center w-full h-full img_block">
                                            <img class="object-cover w-full h-full rounded-full" src="<?php echo esc_url($ph_src); ?>" alt="">
                                        </div>
                                    </li>
                            <?php
                                }
                            }

                            ?>
                        </ul>
                    </div>
                    <div class="flex flex-col items-center justify-center py-6 row:flex-row mobile:justify-between">
                        <div class="gt_item_lmt">
                            <?php
                            $totalboxQty = isset($boxQty) ? filter_var($boxQty) : '0';
                            $totalboxQty = intval($totalboxQty) + intval($prefileldArraylength);
                            $totalItems = $totalboxQty;
                            // Determine the width class based on the number of items
                            if ($totalItems == 2) {
                                $widthClass = 'w-1/2';
                            } elseif ($totalItems % 3 == 0) {
                                $widthClass = 'w-auto mobile:w-1/3';
                            } elseif ($totalItems % 4 == 0) {
                                $widthClass = 'w-auto xxl:w-1/4';
                            } else {
                                $widthClass = 'w-auto xxl:w-1/4';
                            }
                            ?>
                            <span class="hidden text text-black-full font-reg420"><span class="added_item"><span class="extendonsfilledboxcount"><?php echo filter_var($prefileldArraylength); ?></span>/<?php echo filter_var($totalboxQty); ?> </span><?php echo esc_html('Added', 'extendons-woocommerce-product-boxes'); ?></span>
                            <span class="text text-black-full font-reg420">
                                Box size: <span class="font-normal text text-black-full"><?php echo filter_var($totalboxQty); ?> donuts
                                </span></span>
                        </div>
                        <div class="reset_gt_box resp">
                            <a href="#" id="clearAllItemsBtn" class="flex items-center justify-center rounded-sm clear_cta text-black-full bg-red-critical">
                                <?php echo esc_html__('Clear items', 'extendons-woocommerce-product-boxes'); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                    <g clip-path="url(#clip0_3017_6817)">
                                        <path d="M1.47607 5.77344V13.8114H9.51405" stroke="black" stroke-width="2.67932" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.83863 20.5088C5.70726 22.9742 7.35362 25.0907 9.52966 26.5391C11.7057 27.9875 14.2935 28.6895 16.9032 28.5393C19.513 28.3891 22.0032 27.3949 23.9987 25.7063C25.9941 24.0178 27.3868 21.7265 27.9669 19.1776C28.5469 16.6288 28.2828 13.9604 27.2145 11.5747C26.1462 9.18894 24.3314 7.21502 22.0437 5.95034C19.756 4.68566 17.1192 4.19873 14.5307 4.56292C11.9421 4.92711 9.54206 6.12269 7.69211 7.96952L1.47607 13.8105" stroke="black" stroke-width="2.67932" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3017_6817">
                                            <rect width="32.1519" height="32.1519" fill="white" transform="translate(0.13623 0.414062)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <?php if ($gravity_form_id) : ?>
                <div class="gform_wrapper">
                    <?php echo do_shortcode('[gravityform id="' . esc_attr($gravity_form_id) . '" title="false" description="false" ajax="true"]'); ?>
                </div>
            <?php else : ?>
                <p><?php echo esc_html__('Gravity Form ID not found or not set.', 'extendons-woocommerce-product-boxes'); ?></p>
            <?php endif; ?>
            <div class="py-8 text-center border-solid extenonheadingparent bordertopbottom border-t-black-primary border-b-black-primary">
                <?php echo '<span class="extendssubtotalboxes text-black-full font-reg420 text-sm-md-font"> Box total: ' . filter_var($product_price) . '</span>'; ?>
            </div>
            <div id="moveMSG"></div>
            <div id="moveCTA"></div>
        </div>

        <!-- Product Addon List -->
        <div class="w-full lg:w-3/5 product_addon_box simple_pd">
            <div class="block lg:hidden">
                <?php do_action('woocommerce_single_product_summary'); ?>
            </div>
            <?php
            if (!empty($selectedItems)) {
                $countproductselected = count($selectedItems);
            } else {
                $countproductselected = '0';
            }
            ?>
            <div class="flex flex-row flex-wrap justify-start pt-12 pd_box_list lg:pr-12">

                <?php
                //print_r($selectedItems);
                if (!empty($selectedItems)) {

                    $args = array();

                    if ('yes' == $sort_enable) {
                        $args['orderby'] = 'modified';
                        $args['order'] = 'DESC';
                    }

                    $args['include'] = $selectedItems;
                    $args['status']  = array('publish');
                    $args['type']   = array('variation', 'simple', 'variable');
                    $args['return'] = 'ids';
                    $args['limit'] = '-1';
                    //print_r($args);
                    $products = wc_get_products($args);
                    foreach ($products as $key => $product_id) {
                        $qtyvalue = 0;
                        $product = wc_get_product($product_id);


                        if ('publish' == $product->get_status()) {


                            $arrayprefilledproductid = array();
                            if ('yes' == $mmPrefilled_enable) {
                                if (!empty($prefileldArray)) {
                                    foreach ($prefileldArray as $key => $value) {
                                        if ($product_id == $value['product_id']) {

                                            $arrayprefilledproductid[$key] = $value['product_id'];
                                            $arrayprefilledproductid['Qty'] = $value['pre_qty'];
                                        }
                                    }
                                }
                            }
                            $arrayprefilledproductid = array_unique($arrayprefilledproductid);
                            if (!empty($arrayprefilledproductid)) {
                                $qtyvalue = $arrayprefilledproductid['Qty'];
                            } else {
                                $qtyvalue = 0;
                            }


                            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');
                            if (!empty($image_url)) {
                                $image_url = $image_url[0];
                            } else {
                                $size = 'woocommerce_thumbnail';
                                $src = WC()->plugin_url() . '/assets/images/placeholder.png';
                                $placeholder_image = get_option('woocommerce_placeholder_image', 0);
                                if (!empty($placeholder_image)) {
                                    if (is_numeric($placeholder_image)) {
                                        $image = wp_get_attachment_image_src($placeholder_image, $size);
                                        if (!empty($image[0])) {
                                            $src = $image[0];
                                        }
                                    } else {
                                        $src = $placeholder_image;
                                    }
                                }
                                $image_url = $src;
                            }

                ?>

                            <div class="w-full mb-8 small:w-1/2 mobile:w-1/3 pd_add_block">
                                <div class="flex flex-col justify-center text-center pd_add_block_inner">
                                    <div class="text-center pod_right_block">
                                        <div class="flex justify-center text-center image_block">
                                            <?php
                                            // Assuming $product is an instance of WC_Product
                                            $image_id = $product->get_image_id(); // Getting the ID of the featured image

                                            if ($image_id) {
                                                // If there's an image ID, get the URL of the image in a specific size
                                                $image_url = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail'); // You can change 'woocommerce_thumbnail' to any other size like 'full', 'medium', etc.
                                            } else {
                                                // If no image ID, use a placeholder
                                                $image_url = wc_placeholder_img_src();
                                            }

                                            // Output the image tag
                                            echo '<img class="rounded-full h-[150px] w-[150px] object-cover" src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '" />';
                                            ?>
                                        </div>

                                    </div>

                                    <div class="flex flex-col justify-center text-center pd_dtl">
                                        <h2 style="color: black;" class="py-4 leading-none pd_title text-black-full font-reg420 text-mob-md-font"><?php echo filter_var($product->get_name()); ?></h2>
                                        <span class="hidden pd_price"><span class="price">
                                                <?php echo filter_var($product->get_price_html()); ?>
                                            </span></span>
                                        <div class="pd_addon_btns">

                                            <?php

                                            if (!$product->is_in_stock()) {
                                                echo '<center><p class="stock out-of-stock text-red-critical font-reg420">' . esc_html__($outofstocktextval, 'woocommerce') . '</p></center>';
                                            } else {

                                            ?>
                                                <?php
                                                // Define $circled_plus with a default SVG or a fallback value
                                                $circled_plus = '<?xml version="1.0" encoding="utf-8"?>
                                                <svg width="18px" height="18px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="#000" d="M512 0C229.2 0 0 229.2 0 512s229.2 512 512 512 512-229.2 512-512S794.8 0 512 0zm0 960C264.6 960 64 759.4 64 512S264.6 64 512 64s448 200.6 448 448-200.6 448-448 448zm192-448H544V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v192H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h160v192c0 17.7 14.3 32 32 32s32-14.3 32-32V544h192c17.7 0 32-14.3 32-32s-14.3-32-32-32z"/>
                                                </svg>';
                                                ?>

                                                <div class="add_btn">
                                                    <a href="#" class="flex add_cta bg-yellow-primary w-full max-w-[120px] mx-auto" data-id="<?php echo filter_var($product->get_id()); ?>">
                                                        <?php echo esc_html__('Add to Box', 'extendons-woocommerce-product-boxes'); ?></a>
                                                </div>
                                                <div class="hidden addon_qty">
                                                    <a href="#" data-id="<?php echo filter_var($product->get_id()); ?>" class="qty_control minus extendonsfilledboxesremove"></a>
                                                    <span class="value extendonsqtytext exqtyval<?php echo filter_var($product->get_id()); ?> " id="<?php echo filter_var($product->get_id()); ?>">
                                                        <?php echo filter_var($qtyvalue); ?>
                                                    </span>
                                                    <a href="#" class="qty_control plus add_cta" data-id="<?php echo filter_var($product->get_id()); ?>"></a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }



                ?>

            </div>

        </div>

    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        // Using plain JavaScript to remove the disabled attribute
        var button = document.querySelector('.single_add_to_cart_button');
        if (button) {
            button.removeAttribute('disabled');
        }

        var textarea = $('#mm-gmasg');
        var moveMSG = $('#moveMSG');
        if (textarea.length && moveMSG.length) {
            textarea.detach().appendTo(moveMSG);
        }

        var addToCartBtn = $('.extendons_add_to_cart');
        var moveCTA = $('#moveCTA');
        if (addToCartBtn.length && moveCTA.length) {
            addToCartBtn.detach().appendTo(moveCTA);
        }
    });
    jQuery(document).ready(function($) {
        function checkPrefilledItems() {
            var allPrefilled = true; // Assume all are prefilled initially
            $('.gt_box_list li').each(function() { // Assuming '.gt_box_list' is your UL container for items
                if (!$(this).hasClass('prefilleditem')) {
                    allPrefilled = false; // If any item is not prefilled, set to false
                }
            });

            if (allPrefilled) {
                $('#clearAllItemsBtn').hide(); // Hide clear button if all are prefilled
            } else {
                $('#clearAllItemsBtn').show(); // Otherwise, show it
            }
        }

        // Call the function on document ready to check initially
        checkPrefilledItems();

        // Optionally, if items can be dynamically changed, call this function whenever an item is added/removed
        // You can bind this to a more specific event if items are dynamically modified
        $('.extendonsaddnewbox, .extendonsremovefilledboxes').click(function() {
            checkPrefilledItems();
        });
    });

    function ext_minicart_fly_to_cart(button, box) {
        // This new definition does nothing
    }
</script>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('max-w-max-1584 mx-auto flex flex-col lg:flex-row lg:justify-between px-4 lg:px-0 ', $product); ?>>
    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>
<?php do_action('woocommerce_after_single_product'); ?>
