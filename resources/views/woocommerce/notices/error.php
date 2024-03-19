<?php

/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
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
// Check if it's the WooCommerce checkout page
$is_checkout_page = function_exists('is_checkout') && is_checkout();

// Define the positioning class based on the page
$position_class = $is_checkout_page ? 'relative' : 'absolute';
// Get the image URL from Theme Options using ACF's get_field function
$notice_bg_url = get_field('notice_bg', 'option');
?>
<div class="woocommerce-error m-auto fixed bottom-0 p-4 left-0 right-0 z-90 h-[100px] max-h-max z-50" role="alert" style="display: none;">
    <?php if ($notice_bg_url) : ?>
        <img src="<?php echo esc_url($notice_bg_url); ?>" class="rounded-t-sm-12 border-t-2 border-x-2  border-t-yellow-primary border-l-yellow-primary border-r-yellow-primary relative bg-black-full h-full object-cover m-auto w-full woo-notice-shadow hide-on-checkout">
    <?php endif; ?>
    <?php echo "<div class='$position_class w-full h-full font-laca text-sm-md-font font-light text-white flex items-center justify-center top-0 left-0 right-0'>"; ?>
    <ul class="flex flex-wrap flex-row items-center justify-start w-5/6">
        <?php foreach ($notices as $notice) : ?>
            <li class="pr-2" <?php echo wc_get_notice_data_attr($notice); ?>>
                <?php echo wc_kses_notice($notice['notice']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <button class="ml-4 bg-red-critical h-[46px] w-[46px] rounded-full border-2 border-black-full border-solid hover:opacity-50 flex items-center justify-center font-bolder text-black-full text-base-font close-button">
        x
    </button>
</div>
</div>
