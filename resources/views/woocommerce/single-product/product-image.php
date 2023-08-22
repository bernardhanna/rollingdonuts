<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 17:13:49
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-22 16:31:38
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
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
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
    <!-- Main Slider -->
    <div x-data="zoomComponent()" x-init="init()" class="merch__single splide woocommerce-product-gallery__wrapper" id="main-slider">
        <div class="splide__track">
            <div class="splide__list">
                <?php
                if ( $post_thumbnail_id ) {
                    $image_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0];
                    echo '<div class="splide__slide"><img x-ref="image" src="' . esc_url( $image_src ) . '" alt="Product Image" @mousemove="zoom($event)" @mouseleave="resetZoom()" /></div>';
                }

                $image_ids = $product->get_gallery_image_ids();
                foreach ( $image_ids as $image_id ) {
                    $image_src = wp_get_attachment_image_src( $image_id, 'full' )[0];
                    echo '<div class="splide__slide"><img x-ref="image" src="' . esc_url( $image_src ) . '" alt="Product Image" @mousemove="zoom($event)" @mouseleave="resetZoom()" /></div>';
                }
                ?>
            </div>
        </div>
        <div x-ref="zoomPane" class="zoom-pane" x-show="showZoomPane" :style="zoomPaneStyle"></div>
    </div>
    <!-- Thumbnail Slider -->
    <div class="splide" id="thumbnail-slider">
        <div class="splide__track">
            <div class="splide__list">
                <?php
                if ( $post_thumbnail_id ) {
                    echo '<div class="splide__slide">' . wc_get_gallery_image_html( $post_thumbnail_id, true ) . '</div>';
                }

                foreach ( $image_ids as $image_id ) {
                    echo '<div class="splide__slide">' . wc_get_gallery_image_html( $image_id, true ) . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<style>
.zoom-pane {
    position: absolute;
    width: 200px;
    height: 200px;
    border: 1px solid #ccc;
    background-repeat: no-repeat;
    background-size: auto;
    pointer-events: none;
    z-index: 9999;
}
</style>
<script>
    // Zoom Component
function zoomComponent() {
  return {
    showZoomPane: false,
    zoomPaneStyle: '',
    init() {
      console.log("Init function called");
      this.$refs.zoomPane.style.backgroundImage = `url(${this.$refs.image.src})`;
    },
    zoom(event) {
      console.log("Zoom function called");
      this.showZoomPane = true;
      const rect = this.$refs.image.getBoundingClientRect();
      const offsetX = event.clientX - rect.left;
      const offsetY = event.clientY - rect.top;
      const posX = -((offsetX / rect.width) * this.$refs.image.naturalWidth - this.$refs.zoomPane.offsetWidth / 2);
      const posY = -((offsetY / rect.height) * this.$refs.image.naturalHeight - this.$refs.zoomPane.offsetHeight / 2);
      this.zoomPaneStyle = `left: ${event.clientX - this.$refs.zoomPane.offsetWidth / 2}px; top: ${event.clientY - this.$refs.zoomPane.offsetHeight / 2}px; background-position: ${posX}px ${posY}px;`;
    },
    resetZoom() {
      console.log("Reset zoom function called");
      this.showZoomPane = false;
    },
  };
}
</script>
