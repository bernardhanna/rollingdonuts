<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-09 16:22:44
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-09 16:58:07
 */

/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if (!empty($breadcrumb)) {
    echo '<nav class="breadcrumb-nav disable pt-4 relative z-50">';
    foreach ($breadcrumb as $key => $crumb) {
        // Apply the 'breadcrumb-ellipsis' class conditionally
        $breadcrumb_class = mb_strlen($crumb[0]) > 8 ? 'breadcrumb-ellipsis' : '';

        echo '<span class="breadcrumb-item ' . (end($breadcrumb) === $crumb ? 'text-yellow-primary font-bolder' : 'text-white') . ' ' . $breadcrumb_class . '">'; // Example Tailwind classes + conditionally added class
        if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
            echo '<a class="text-white font-laca text-sm-font" href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
        } else {
            echo esc_html($crumb[0]);
        }
        echo '</span>';
        if (sizeof($breadcrumb) !== $key + 1) {
            echo '<span class="mx-2 text-white font-laca text-sm-font">' . $delimiter .  '</span>'; // Separator with Tailwind margin class
        }
    }
    echo '</nav>';
}
