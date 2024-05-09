<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-10 12:26:57
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 12:35:29
 */

/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if (!defined('ABSPATH')) {
    exit;
}

$total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format  = isset($format) ? $format : '';

if ($total <= 1) {
    return;
}
?>
<nav aria-label="Page navigation woo-pag">
    <?php
    $paginate_links =  paginate_links(
        apply_filters(
            'woocommerce_pagination_args',
            array(
                'base'         => $base,
                'format'       => $format,
                'add_args'     => false,
                'current'      => max(1, $current),
                'total'        => $total,
                'prev_text'    => '<span class="pagination-prev"><i class="mr-2 fa-solid fa-chevron-left text-xxs-font text-grey-subdued"></i> Prev</span>',
                'next_text'    => '<span class="pagination-next">Next <i class="ml-2 fa-solid fa-chevron-right text-xxs-font text-grey-subdued"></i></span>',
                'type'         => 'array',
                'end_size'     => 3,
                'mid_size'     => 3,
            )
        )
    );


    if (is_array($paginate_links)) {
    ?>
        <ul class="flex flex-row items-center justify-center w-full py-20 pagination tablet-sm:py-10">
            <?php
            foreach ($paginate_links as $paginate_link) {
            ?>

                <li class="page-item">
                    <?php
                    $paginate_link = str_replace('page-numbers', 'page-link', $paginate_link);
                    echo wp_kses_post($paginate_link)
                    ?>
                </li>

            <?php
            }
            ?>
        </ul>
    <?php
    }
    ?>
</nav>