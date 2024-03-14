<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 12:14:14
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 14:47:05
 */

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="<?php echo is_user_logged_in() ? 'pb-12' : 'bg-white'; ?>">
    <?php do_action('woocommerce_before_account_navigation'); ?>
    <div class="mx-auto lg:max-w-max-1549 pt-10">
        <nav class="woocommerce-MyAccount-navigation">
            <ul class="w-full flex justify-start lg:justify-center flex-nowrap overflow-x-auto flex-row ">
                <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                    <li class="active:text-yellow-primary border-solid border-grey-subdued border-b-2 active:border-yellow-primary px-4 pt-4 <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                        <a class="text-white hover:text-yellow-primary text-sm-md-font opacity-40 hover:opacity-100 whitespace-nowrap" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <?php do_action('woocommerce_after_account_navigation'); ?>

    </div>