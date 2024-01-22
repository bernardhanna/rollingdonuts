<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-10 12:12:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-12 10:42:04
 */

/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<ul x-data="{ justifyStyle: 'between' }"
    x-init="justifyStyle = window.innerWidth > 1084 && $el.querySelectorAll('li').length < 3 ? 'start' : 'between'"
    :class="`justify-${justifyStyle} flex flex-wrap  flex-row gap-4 lg:gap-6 desktop:px-0 lg:px-4 px-2`">
