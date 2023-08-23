<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 16:38:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 14:53:39
 */
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="related product overflow-hidden w-full">

    <?php
        $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

        if ( $heading ) :
            ?>
            <h4>
                <?php
                global $product;
                $product_id = $product->get_id();

                $terms = wp_get_post_terms( $product_id, 'rd_product_type' );

                if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                    $product_type = $terms[0]->name;  // Assuming 'rd_product_type' is not multi-select

                    if ( strcasecmp( $product_type, 'merch' ) === 0 ) {
                        esc_html_e( 'Other designs you might like', 'woocommerce' );
                    } else {
                        esc_html_e( 'Other donuts you might like', 'woocommerce' );
                    }
                } else {
                    // Default text if no terms are found or if an error occurs
                    esc_html_e( 'You might also like', 'woocommerce' );
                }
                ?>
            </h4>
        <?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
	<?php
endif;

wp_reset_postdata();
