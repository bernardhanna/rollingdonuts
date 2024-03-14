<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 12:26:00
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 14:46:35
 */

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_navigation'); ?>

<?php
// Determine if we're on the "Orders" page of the WooCommerce "My Account" area.
$is_orders_page = function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('orders');

// Apply 'p-0' if on the orders page, otherwise use the default padding classes.
$padding_class = $is_orders_page ? 'p-0 rounded-none' : 'px-4 py-8 mobile:p-10';
?>
<div class="mt-10"></div>
<div class="flex flex-col justify-center woocommerce-MyAccount-content mx-auto lg:max-w-max-750 lg:bg-white rounded-one <?php echo $padding_class; ?>">
    <?php
    /** p10
     * My Account content.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_account_content');
    ?>
</div>