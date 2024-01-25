<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-12 16:33:15
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-12 17:40:58
 */

/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>
<div class="rd-notice woocommerce-error w-full fixed bottom-0 left-0 right-0 z-90" role="alert">
	<?php foreach ( $notices as $notice ) : ?>
        <?php
        // Get the image URL from Theme Options using ACF's get_field function
        $notice_bg_url = get_field('notice_bg', 'option');

        // Check if the image URL exists
        if ($notice_bg_url):
        ?>

        <img src="<?php echo esc_url($notice_bg_url); ?>" class="relative w-full h-full">

        <?php endif; ?>
		<div class="absolute h-full font-laca text-sm-md-font font-light text-white flex items-center justify-center top-0 left-0 right-0" <?php echo wc_get_notice_data_attr( $notice ); ?>>
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
		</div>
	<?php endforeach; ?>
</div>
