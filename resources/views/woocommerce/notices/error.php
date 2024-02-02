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
<div x-data="{ show: true }" x-show="show" class="woocommerce-error m-auto fixed bottom-0 p-4 left-0 right-0 z-90 h-[100px] z-50" role="alert">
	<?php foreach ( $notices as $notice ) : ?>
        <?php
        // Get the image URL from Theme Options using ACF's get_field function
        $notice_bg_url = get_field('notice_bg', 'option');

        // Check if the image URL exists
        if ($notice_bg_url):
        ?>

        <img src="<?php echo esc_url($notice_bg_url); ?>" class="rounded-t-sm-12 border-t-2 border-x-2  border-t-yellow-primary border-l-yellow-primary border-r-yellow-primary relative bg-black-full h-full object-cover m-auto w-full woo-notice-shadow ">

        <?php endif; ?>
		<div class="absolute h-full font-laca text-sm-md-font font-light text-white flex items-center justify-center top-0 left-0 right-0" <?php echo wc_get_notice_data_attr( $notice ); ?>>
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
            <button @click="show = false" class="ml-4 bg-red-critical h-[46px] w-[46px] rounded-full border-2 border-black-full border-solid hover:opacity-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                    <path d="M0.547362 5.56787L6.01721 0.0980207L12.4494 6.53016L18.9321 0.0473731L24.402 5.51722L17.9192 12L24.402 18.4828L18.9321 23.9526L12.4494 17.4699L6.01721 23.902L0.547363 18.4321L6.9795 12L0.547362 5.56787Z" fill="black"/>
                </svg>
            </button>
		</div>
	<?php endforeach; ?>
</div>
