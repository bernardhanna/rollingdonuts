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

// Get the image URL from Theme Options using ACF's get_field function
$notice_bg_url = get_field('notice_bg', 'option');
?>
<div x-data="{ show: true }" x-init="setTimeout(() => { show = false }, 5000)" x-show="show" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-1" x-transition:leave-end="opacity-0 transform translate-y-4" class="woocommerce-error m-auto fixed bottom-0 p-4 left-0 right-0 z-90 h-[100px] z-50" role="alert" style="display: none;">
    <?php if ($notice_bg_url) : ?>
        <img src="<?php echo esc_url($notice_bg_url); ?>" class="rounded-t-sm-12 border-t-2 border-x-2  border-t-yellow-primary border-l-yellow-primary border-r-yellow-primary relative bg-black-full h-full object-cover m-auto w-full woo-notice-shadow ">
    <?php endif; ?>
    <div class="absolute h-full font-laca text-sm-md-font font-light text-white flex items-center justify-center top-0 left-0 right-0">
        <ul class="flex flex-wrap flex-row items-center justify-center">
            <?php foreach ($notices as $notice) : ?>
                <li class="pr-2" <?php echo wc_get_notice_data_attr($notice); ?>>
                    <?php echo wc_kses_notice($notice['notice']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <button @click="show = false" class="ml-4 bg-red-critical h-[46px] w-[46px] rounded-full border-2 border-black-full border-solid hover:opacity-50 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                <path d="M0.547362 5.56787L6.01721 0.0980207L12.4494 6.53016L18.9321 0.0473731L24.402 5.51722L17.9192 12L24.402 18.4828L18.9321 23.9526L12.4494 17.4699L6.01721 23.902L0.547363 18.4321L6.9795 12L0.547362 5.56787Z" fill="black" />
            </svg>
        </button>
    </div>
</div>