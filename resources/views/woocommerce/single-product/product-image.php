<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 17:13:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 10:15:08
 */

defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
// Removed $post_thumbnail_id as it's no longer needed.
$image_ids = $product->get_gallery_image_ids(); // Only gallery images are used.
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . (!empty($image_ids) ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="w-full lg:w-49 <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>">
    <!-- Main Slider -->
    <?php if (!empty($image_ids)) : ?>
        <div class="merch__single splide woocommerce-product-gallery__wrapper" id="main-slider">
            <div class="splide__track">
                <div class="splide__list">
                    <?php
                    foreach ($image_ids as $image_id) {
                        $image_src = wp_get_attachment_image_src($image_id, 'full')[0];
                        $srcset = wp_get_attachment_image_srcset($image_id, 'full');
                        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        echo '<div class="splide__slide"><img class="main-slide-img object-cover h-[520px] w-full" src="' . esc_url($image_src) . '" srcset="' . esc_attr($srcset) . '" alt="' . esc_attr($alt_text) . '" /></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Thumbnail Slider -->
    <?php if (!empty($image_ids)) : ?>
        <div class="splide max-lg:hidden" id="thumbnail-slider">
            <div class="splide__track">
                <div class="splide__list">
                    <?php
                    $index = 0; // Initialize index for thumbnails.
                    foreach ($image_ids as $image_id) {
                        echo '<div class="splide__slide main-thumb"><a href="#" data-splide-index="' . $index++ . '">' . wc_get_gallery_image_html($image_id, true) . '</a></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>