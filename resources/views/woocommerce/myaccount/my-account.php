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

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_navigation' ); ?>

    <div class="woocommerce-MyAccount-content mx-auto lg:max-w-max-750 bg-white rounded-md-40 mt-10 p-10">
        <?php
            /** p10
             * My Account content.
             *
             * @since 2.6.0
             */
            do_action( 'woocommerce_account_content' );
        ?>
    </div>
