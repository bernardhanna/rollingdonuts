<?php
$extendons_custombox_general_settings = get_option('extendons_custombox_general_settings');
$ph_src = $extendons_custombox_general_settings['_mm_image_placeholder'] ?? '';

if ('' == $ph_src) {
    $ph_src = plugin_dir_url(__FILE__) . '/images/img-empty.png';
}

$color_val = $extendons_custombox_general_settings['_mm_color_primarycolor'] ?? '#995E8E';

$circled_x = '<?xml version="1.0" encoding="utf-8"?>
			<svg width="21px" height="21px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
			<g fill="none" fill-rule="evenodd" stroke="' . $color_val . '" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
			<circle cx="8.5" cy="8.5" r="8"/>
			<g transform="matrix(0 1 -1 0 17 0)">
			<path d="m5.5 11.5 6-6"/>
			<path d="m5.5 5.5 6 6"/>
			</g>
			</g>
			</svg>';
$circled_plus = '<?xml version="1.0" encoding="utf-8"?>
				<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
				<svg width="18px" height="18px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
				<path fill="' . $color_val . '" d="M353 480h320a32 32 0 1 1 0 64H352a32 32 0 0 1 0-64z"/>
				<path fill="' . $color_val . '" d="M480 672V352a32 32 0 1 1 64 0v320a32 32 0 0 1-64 0z"/>
				<path fill="' . $color_val . '" d="M512 896a384 384 0 1 0 0-768 384 384 0 0 0 0 768zm0 64a448 448 0 1 1 0-896 448 448 0 0 1 0 896z"/>
				</svg>';

?>

<?php
if ('yes' != $add_new_box_quantity) {

?>
    <style type="text/css">
        .product_addon_container.horizontal_box .product_addon_box {
            max-height: 900px;
            overflow: scroll;
        }

        .gt_box {
            border-radius: 100%;
        }

        .gt_box_list .gift_block .img_block img .simple_pd .pd_add_block .image_block img {
            border-radius: 100% !important;
        }

        .gt_box_tab .box_tb_list:hover {
            background-color: <?php echo filter_var($color_val); ?>;
            border-color: <?php echo filter_var($color_val); ?>;
            color: #fff !important
        }

        .horizontal_box .gt_box_tab .box_tb.active_tab .box_tb_list .gt_qt {
            color: black;
            border-color: transparent !important;
        }

        .pd_add_block .pd_addon_btns .add_btn :hover {
            background-color: <?php echo filter_var($color_val); ?>;
            color: black !important
        }

        .horizontal_box .gift_box_container {
            height: calc(100%) !important;
            padding-bottom: 5%;
        }

        .horizontal_box .gift_box_container .gt_bx_lt .add_box .add_box_hor_simple {
            background-color: transparent;
        }

        .horizontal_box .gift_box_container .add_box .add_box_cta {
            background: #fff !important;
        }

        .horizontal_box .gift_box_container .gt_bx_lt .add_box .add_box_hor_simple:hover {
            background-color: <?php echo filter_var($color_val); ?> !important;
            color: #fff !important
        }

        .pd_add_block .pd_addon_btns.pd_addon_active .addon_qty {
            width: 50%
        }

        .pd_addon_btns .add_btn .add_cta {
            color: #000000 !important;
            border: 1px solid #000000 !important;
            align-items: center;
        }

        .qodef-woo-product-title.product_title.entry-title {
            display: none !important;
        }

        .product_addon_container.horizontal_box .product_addon_box {
            width: 100% !important;
        }

        .product_box_container {
            padding-left: 5%;
            padding-right: 5%;
        }

        .product_addon_container.horizontal_box .product_addon_box {
            padding-top: 30px;
            height: 100%;
            overflow: auto;
            padding-bottom: 5% !important;
        }

        .extendonsboxfillederrormsg.woocommerce-message {
            background-color: #f55959 !important;
            color: black !important;
        }

        .product_addon_box.simple_pd .pd_box_list {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            grid-gap: 20px;
            align-items: flex-start;
            background: transparent;
            margin-right: 5%;
        }

        form.cartt {
            margin-bottom: 0px !important;
            padding: 0px !important;
        }

        .extendons_add_to_cart .quantity {
            display: none !important;
        }

        .extendons_add_to_cart {
            margin-right: 7%;
        }

        .pd_add_block .pd_addon_btns.pd_addon_active .add_btn {
            display: block;
        }

        .value.extendonsqtytext {
            display: none !important;
        }

        .horizontal_box .gt_bx_rt {
            width: 100% !important;
        }

        .horizontal_box .sticky_gt .gt_box_list .gift_block {
            width: 80px;
            min-width: 80px;
            padding: 8px;
            width: 22.5%;
            min-width: 20%;
            height: auto;
            margin: 0px 10px 10px 0px;
        }

        .gt_box_qty .label {
            color: white;
        }

        .gt_box_qty .gt_qty .value {
            background: white;
            border: 1px solid #000000;
            border-radius: 0px;
        }

        .gt_box_qty .gt_qty .qty_control {
            background-color: #FFED56;
        }

        .gt_box_qty .label {
            display: block !important;
        }
    </style>
<?php

}
?>
<div class="product_box_container">
    <div class="product_addon_container horizontal_box full_opt">
        <!-- Gift Box -->
        <div class="gift_box_container flex flex-col">
            <?php
            // Display WooCommerce product summary right here
            do_action('woocommerce_mxmatch_product_summary');
            ?>
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
            <div class="gt_bx_rt" color_val=<?php echo filter_var($color_val); ?>>
                <div id="gift_box_0" data-box-count='0' class="product_gift_box active_bx_dtl">
                    <div class="gift_box_top">
                        <div class="gt_box_qty">
                            <span class="label"><?php echo esc_html__('Box 1 Quantity', 'extendons-woocommerce-product-boxes'); ?></span>
                            <div class="gt_qty">
                                <a href="#" class="qty_control minus extenonsboxminus"></a>
                                <input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty0">
                                <a href="#" class="qty_control plus extenonsboxplus"></a>
                            </div>
                        </div>
                        <div class="gt_item_lmt">
                            <?php

                            $boxQty = intval($boxQty) - intval($prefileldArraylength);
                            $totalboxQty = isset($boxQty) ? filter_var($boxQty) : '0';
                            $totalboxQty = intval($totalboxQty) + intval($prefileldArraylength);

                            ?>
                            <span class="text"><span class="added_item"><span class="extendonsfilledboxcount"><?php echo filter_var($prefileldArraylength); ?></span>/<?php echo filter_var($totalboxQty); ?> </span><?php echo esc_html__(' Added', 'extendons-woocommerce-product-boxes'); ?></span>
                        </div>

                        <div class="reset_gt_box">
                            <a href="#" class=" clear_cta">Clear box <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                    <g clip-path="url(#clip0_2964_11220)">
                                        <path d="M1.47559 5.77344V13.8114H9.51356" stroke="black" stroke-width="2.67932" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.83814 20.5088C5.70677 22.9742 7.35313 25.0907 9.52918 26.5391C11.7052 27.9875 14.2931 28.6895 16.9028 28.5393C19.5125 28.3891 22.0027 27.3949 23.9982 25.7063C25.9937 24.0178 27.3863 21.7265 27.9664 19.1776C28.5464 16.6288 28.2824 13.9604 27.214 11.5747C26.1457 9.18894 24.3309 7.21502 22.0432 5.95034C19.7555 4.68566 17.1187 4.19873 14.5302 4.56292C11.9416 4.92711 9.54158 6.12269 7.69162 7.96952L1.47559 13.8105" stroke="black" stroke-width="2.67932" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2964_11220">
                                            <rect width="32.1519" height="32.1519" fill="white" transform="translate(0.135742 0.414062)" />
                                        </clipPath>
                                    </defs>
                                </svg></a>
                        </div>
                    </div>
                    <ul class="gt_box_list" ph_src="<?php echo esc_url($ph_src); ?>">
                        <?php

                        if ('yes' == $mmPrefilled_enable) {

                            if (!empty($prefileldArray)) {

                                $qunit_arr = array();
                                $boxQty = intval($boxQty) - intval($prefileldArraylength);
                                foreach ($prefileldArray as $key => $prefileldval) {

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
                                    <li class="gift_block active_gift extendonsfilleditem <?php echo filter_var($prefilledclass); ?>">
                                        <?php
                                        if ($product) {
                                            $image_id = $product->get_image_id();
                                            $image_url = wp_get_attachment_url($image_id);

                                            if (!$image_url) {
                                                $image_url = wc_placeholder_img_src(); // Fallback to placeholder if no image is available.
                                            }

                                            echo '<div class="img_block">';
                                            echo '<img data-id="' . esc_attr($product->get_id()) . '" class="extendonsremovefilledboxes" src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '">';
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="dlt_icon">
                                            <?php
                                            $circled_x_id = '';
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
                                        <div class="gt_overlay">
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
                                <li class="gift_block active_gift extendons_active_boxes">
                                    <div class="img_block">
                                        <img src="<?php echo esc_url($ph_src); ?>" alt="">
                                    </div>
                                </li>
                        <?php
                            }
                        }

                        ?>
                    </ul>
                </div>
            </div>
            <div class="extsubtotaladdtocart">
                <?php
                echo '<span class="extendssubtotalboxes"> Box Price: ' . filter_var($product_price) . '</span>';

                ?>

            </div>
        </div>

        <!-- Product Addon List -->
        <div class="product_addon_box simple_pd">
            <?php
            if (!empty($selectedItems)) {
                $countproductselected = count($selectedItems);
            } else {
                $countproductselected = '0';
            }
            ?>

            <div class="pd_box_list">

                <?php
                //print_r($selectedItems);
                if (!empty($selectedItems)) {

                    $args = array();

                    if ('yes' == $sort_enable) {
                        $args['orderby'] = 'title';
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

                            <div class="pd_add_block">
                                <div class="pd_add_block_inner">
                                    <?php     // Assuming $product is your product object
                                    if ($product) {
                                        $image_id = $product->get_image_id();
                                        $image_url = wp_get_attachment_url($image_id);

                                        if (!$image_url) {
                                            $image_url = wc_placeholder_img_src();
                                        }

                                        // Display the image within your existing HTML structure
                                        echo '<div class="pod_right_block">';
                                        echo '<div class="image_block">';
                                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '" />';
                                        echo '</div>';
                                        echo '</div>';
                                    } ?>

                                    <div class="pd_dtl">
                                        <h2 class="pd_title"><?php echo filter_var($product->get_name()); ?></h2>
                                        <span class="pd_price"><span class="price">
                                                <?php echo filter_var($product->get_price_html()); ?>
                                            </span></span>
                                        <div class="pd_addon_btns">

                                            <?php

                                            if (!$product->is_in_stock()) {
                                                echo '<center><p class="stock out-of-stock">' . esc_html__($outofstocktextval, 'woocommerce') . '</p></center>';
                                            } else {

                                            ?>
                                                <div class="add_btn bg-yellow-primary hover:bg-white">
                                                    <a href="#" class="add_cta" data-id="<?php echo filter_var($product->get_id()); ?>">
                                                        <?php echo filter_var($circled_plus); ?> &nbsp;<?php echo esc_html__('Add', 'extendons-woocommerce-product-boxes'); ?></a>
                                                </div>
                                                <div class="addon_qty">
                                                    <a href="#" data-id="<?php echo filter_var($product->get_id()); ?>" class="qty_control minus extendonsfilledboxesremove"></a>
                                                    <span class="value extendonsqtytext hidden exqtyval<?php echo filter_var($product->get_id()); ?> " id="<?php echo filter_var($product->get_id()); ?>">
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
        setTimeout(function() {
            if ($('.extendons_add_to_cart').length && $('.gift_box_container').length) {
                var addToCart = $('.extendons_add_to_cart').detach();
                $('.gift_box_container').append(addToCart);
            }
        }, 200); // Adjust the timeout as needed
    });
</script>
