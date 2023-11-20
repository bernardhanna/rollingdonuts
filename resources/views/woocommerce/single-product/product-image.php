<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 17:13:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 10:15:08
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$image_ids         = $product->get_gallery_image_ids();  // Moved this line up
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="lg:w-47 <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
    <!-- Main Slider -->
    <?php if ( $post_thumbnail_id || ! empty( $image_ids ) ): ?>
    <div class="merch__single splide woocommerce-product-gallery__wrapper" id="main-slider">
        <div class="splide__track">
            <div class="splide__list">
                <?php
                if ( $post_thumbnail_id ) {
                    $image_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0];
                    $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
                    echo '<div class="w-full'. (empty($image_ids) ? '' : 'splide__slide') .'"><img class="main-slide-img object-cover lg:h-[520px] w-full" src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $alt_text ) . '" /></div>';
                }

                foreach ( $image_ids as $image_id ) {
                    $image_src = wp_get_attachment_image_src( $image_id, 'full' )[0];
                    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                    echo '<div class="splide__slide"><img class="main-slide-img object-cover lg:h-[520px] w-full" src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $alt_text ) . '" /></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- Thumbnail Slider -->
    <?php if ( ! empty( $image_ids ) ): ?>
    <div class="splide" id="thumbnail-slider">
        <div class="splide__track">
            <div class="splide__list">
                <?php
                if ( $post_thumbnail_id ) {
                    echo '<div class="splide__slide main-thumb">' . wc_get_gallery_image_html( $post_thumbnail_id, true ) . '</div>';
                }

                foreach ( $image_ids as $image_id ) {
                    echo '<div class="splide__slide main-thumb">' . wc_get_gallery_image_html( $image_id, true ) . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
