<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-09 12:48:57
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-09 12:49:18
 */

/**
 * Single Product Title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-title.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

the_title('<h2 class="text-lg-font desktop:text-xxxl-font macbook:text-xxl-font laptop:text-xl-font font-bold entry-titles py-8">', '</h2>');
