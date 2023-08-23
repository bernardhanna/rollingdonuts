<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-23 15:32:40
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 16:30:28
 */

/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
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

<?php foreach ( $notices as $notice ) : ?>
    <div id="custom-woocommerce-notice" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, 7000)" class="woocommerce-notices-wrapper fixed bottom-0 left-0 right-0 z-50 bg-transparent text-center p-4">
        <div class="woocommerce-message bg-black-full text-white flex justify-center items-center" role="alert">
            <div class="w-1/8 text-center">
                <?php echo wc_kses_notice( $notice['notice'] ); ?>
            </div>
            <button id="close-notice" @click="show = false" class="w-1/4 bg-red-critical"><span class="iconify" data-icon="zondicons:close-solid"></span></button>
        </div>
    </div>
<?php endforeach; ?>
