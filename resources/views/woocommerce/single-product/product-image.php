<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 17:13:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 10:15:08
 */

defined('ABSPATH') || exit;

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$image_ids = $product->get_gallery_image_ids();
$post_thumbnail_id = $product->get_image_id();
$product_type_terms = get_the_terms($product->get_id(), 'rd_product_type');
$product_type = !empty($product_type_terms) ? $product_type_terms[0]->slug : '';
$exclude_featured_for_box = $product_type === 'box' && !empty($image_ids);

$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . (!$exclude_featured_for_box && $post_thumbnail_id ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="w-full lg:w-49 <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>">
    <?php if (!$exclude_featured_for_box && $post_thumbnail_id) : ?>
        <img class="main-slide-img object-cover w-full h-[520px]" src="<?= wp_get_attachment_url($post_thumbnail_id); ?>" alt="<?= get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true); ?>">
    <?php endif; ?>

    <?php if (!empty($image_ids)) : ?>
        <div class="merch__single splide woocommerce-product-gallery__wrapper" id="main-slider">
            <div class="splide__track">
                <div class="splide__list">
                    <?php foreach ($image_ids as $image_id) : ?>
                        <?php $image_src = wp_get_attachment_image_src($image_id, 'full')[0]; ?>
                        <div class="splide__slide">
                            <img class="main-slide-img object-cover h-[520px] w-full" src="<?= esc_url($image_src); ?>" alt="<?= get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="splide max-lg:hidden" id="thumbnail-slider">
            <div class="splide__track">
                <div class="splide__list">
                    <?php
                    $index = 0;
                    if ($post_thumbnail_id && !$exclude_featured_for_box) {
                        echo '<div class="splide__slide main-thumb"><a href="#" data-splide-index="' . $index++ . '">' . wc_get_gallery_image_html($post_thumbnail_id, true) . '</a></div>';
                    }
                    foreach ($image_ids as $image_id) {
                        echo '<div class="splide__slide main-thumb"><a href="#" data-splide-index="' . $index++ . '">' . wc_get_gallery_image_html($image_id, true) . '</a></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>