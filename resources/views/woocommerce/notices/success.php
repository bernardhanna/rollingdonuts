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

if (!defined('ABSPATH')) {
    exit;
}

if (!$notices) {
    return;
}

?>

<?php foreach ($notices as $notice) : ?>
    <div id="custom-woocommerce-notice" class="fixed bottom-0 left-0 right-0 z-50 flex w-full p-4 text-center bg-transparent woocommerce-noticeslgrapper margin-auto">
        <div class="w-full border-t-2 woocommerce-message woo-notice-shadow bg-black-full rounded-t-sm-12 border-x-2 border-t-yellow-primary border-l-yellow-primary border-r-yellow-primary " role="alert"><?php
                                                                                                                                                                                                            // Get the image URL from Theme Options using ACF's get_field function
                                                                                                                                                                                                            $notice_bg_url = get_field('notice_bg', 'option');

                                                                                                                                                                                                            // Check if the image URL exists
                                                                                                                                                                                                            if ($notice_bg_url) :
                                                                                                                                                                                                            ?><img src="<?php echo esc_url($notice_bg_url); ?>" class="rounded-t-sm-12 relative bg-black-full  object-cover m-auto woo-notice-shadow w-full  h-[100px]"><?php endif; ?><div class="absolute top-0 left-0 right-0 flex items-center justify-center h-full px-4 m-auto text-white">
                <div class="font-light text-center text-white w-1/8 font-laca text-sm-md-font"><?php echo wc_kses_notice($notice['notice']); ?></div><button class="ml-4 close-shadow flex items-center justify-center bg-red-critical h-[46px] w-[46px] rounded-full border-2 border-black-full border-solid hover:opacity-50 text-black-full text-base-font font-bolder">x
                </button>
            </div>
        </div>
    </div>
<?php endforeach; ?>
