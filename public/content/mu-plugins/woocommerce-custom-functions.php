<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 15:42:22
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 16:01:56
 */

/*
Plugin Name: WooCommerce Custom Functions
Description: Custom functions for WooCommerce.
Version: 1.0
Author: Bernard Hanna
*/

// Add your custom WooCommerce functions here
function rd_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'rd_add_woocommerce_support' );
// SET path
add_filter('woocommerce_locate_template', function ($template, $template_name, $template_path) {
    $blade_template = locate_template("resources/views/woocommerce/{$template_name}");
    return (!$blade_template) ? $template : $blade_template;
}, 10, 3);

// Change Bread Crumb Delimiter
function custom_woo_breadcrumbs_delimiter( $defaults ) {
    $defaults['delimiter'] = ' &gt; '; // Changes the default " / " delimiter to " > "
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'custom_woo_breadcrumbs_delimiter' );

// Set products per row
function custom_loop_columns() {
    return 3; // 3 products per row
}
add_filter('loop_shop_columns', 'custom_loop_columns', 999);

// STYLE THE ADD TO CART
add_filter( 'woocommerce_loop_add_to_cart_args', 'customize_add_to_cart_button', 10, 2 );

function customize_add_to_cart_button( $args, $product ) {
    $args['class'] = 'bg-white text-mob-xs-font font-edmondsans font-reg420 py-4 px-10 flex items-center justify-center rounded-btn-72 border-1-fix';  // Here you can add your custom classes
    return $args;
}

// Change text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text' );

// Change text on archives/product listings
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text' );

function custom_add_to_cart_text() {
    return __( 'Select and customise', 'woocommerce' );
}


// WOOCOMMERCE CUSTOM STYLES:
function custom_woocommerce_image_sizes( $size ) {
    // Custom height for single product image on mobile
    if ( 'woocommerce_single' === $size['name'] ) {
        $size['height'] = 125;
    }

    // Custom height for product thumbnails on mobile
    if ( 'woocommerce_thumbnail' === $size['name'] ) {
        $size['height'] = 125;
    }

    // Custom height for product gallery thumbnails on mobile
    if ( 'woocommerce_gallery_thumbnail' === $size['name'] ) {
        $size['height'] = 125;
    }

    return $size;
}
add_filter( 'woocommerce_get_image_size', 'custom_woocommerce_image_sizes' );

function custom_large_device_image_sizes( $size ) {
    // Custom height for single product image on large devices
    if ( wp_is_mobile() === false && 'woocommerce_single' === $size['name'] ) {
        $size['height'] = 386;
    }

    // Custom height for product thumbnails on large devices
    if ( wp_is_mobile() === false && 'woocommerce_thumbnail' === $size['name'] ) {
        $size['height'] = 386;
    }

    // Custom height for product gallery thumbnails on large devices
    if ( wp_is_mobile() === false && 'woocommerce_gallery_thumbnail' === $size['name'] ) {
        $size['height'] = 386;
    }

    return $size;
}
add_filter( 'woocommerce_get_image_size', 'custom_large_device_image_sizes' );

//Product Types Mods
function get_rd_product_type($product_id) {
    $terms = get_the_terms($product_id, 'rd_product_type');
    if ($terms && !is_wp_error($terms)) {
        return $terms[0]->name;  // Fetch the term name
    }
    return 'No RD Product Type';
}
// Add Product Types to Products on backend
add_filter('manage_edit-product_columns', function($columns) {
    $columns['rd_product_type'] = __('RD Product Type', 'rolling-donut');
    return $columns;
});

add_action('manage_product_posts_custom_column', function($column) {
    global $post;
    if ($column == 'rd_product_type') {
        $terms = get_the_terms($post->ID, 'rd_product_type');
        if (!empty($terms)) {
            $output = [];
            foreach ($terms as $term) {
                $output[] = $term->name;
            }
            echo implode(', ', $output);
        } else {
            echo '—';
        }
    }
});
// Make the columns filterable
add_action('restrict_manage_posts', function() {
    global $typenow;
    if ($typenow == 'product') {
        $taxonomy = 'rd_product_type';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories([
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
        ]);
    }
});

add_filter('parse_query', function($query) {
    global $pagenow;
    $taxonomy = 'rd_product_type';
    $q_vars = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == 'product' && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy])) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        if ($term) {  // Check if $term is not false
            $q_vars[$taxonomy] = $term->slug;
        }
    }
});

// Orders Page AJAX filter
function filter_products() {
    $category = $_POST['category'];
    $productType = $_POST['productType']; // New parameter
    ob_start();

    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => 'rd_product_type',
                'field' => 'name',
                'terms' => $productType, // Use the new parameter here
            ],
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category,
            ],
        ],
    ];

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
    } else {
        echo "No products found for this category.";
    }

    wp_reset_postdata();

    $output = ob_get_clean();
    echo $output;
    die();
}

add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

/*
 ****************************************************************
 * SINGLE PRODUCT MODS
 ***********************************************************
*/
//Remove the Breadcrumbs from Body
add_action( 'wp', 'remove_wc_breadcrumbs' );
function remove_wc_breadcrumbs() {
    if ( is_product() ) {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    }
}

//Remove Price from Single Product Body
add_action( 'wp', 'remove_single_product_price' );
function remove_single_product_price() {
    if ( is_product() ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    }
}

//Add Product Description Below the Title
add_action('woocommerce_single_product_summary', 'the_content', 6);

//Change Button Text to "Add to Basket
function custom_cart_button_text() {
    return __('Add to Basket', 'woocommerce');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_cart_button_text');

//Remove Tabbed Short Description
function remove_product_tabs($tabs) {
    unset($tabs['description']); // Remove the description tab
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);

// Remove the additional information tab
add_action( 'init', 'remove_woocommerce_product_tabs', 99 );
function remove_woocommerce_product_tabs() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
}

// Remove categories display
add_action( 'woocommerce_single_product_summary', 'remove_product_categories', 1 );
function remove_product_categories() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

// SINGLE DONUTS
add_action('woocommerce_before_add_to_cart_button', 'remove_elements_start', 10);
add_action('woocommerce_after_add_to_cart_button', 'remove_elements_end', 10);
// Remove the add to cart button and other stuff we don't need
function remove_elements_start() {
    global $product;

    $product_id = $product->get_id();
    $terms = wp_get_post_terms($product_id, 'rd_product_type');

    if (!is_wp_error($terms) && !empty($terms)) {
        $product_type = $terms[0]->name;

        if (strcasecmp($product_type, 'Donut') === 0) {
            ob_start();
        }
    }
}
function remove_elements_end() {
    global $product;

    $product_id = $product->get_id();
    $terms = wp_get_post_terms($product_id, 'rd_product_type');

    if (!is_wp_error($terms) && !empty($terms)) {
        $product_type = $terms[0]->name;

        if (strcasecmp($product_type, 'Donut') === 0) {
            ob_end_clean();
        }
    }
}
// Remove thea ttributes to cart button
add_action('woocommerce_single_product_summary', 'remove_attribute_dropdowns', 1);

function remove_attribute_dropdowns() {
    global $product;

    $product_id = $product->get_id();
    $terms = wp_get_post_terms($product_id, 'rd_product_type');

    if (!is_wp_error($terms) && !empty($terms)) {
        $product_type = $terms[0]->name;

        if (strcasecmp($product_type, 'Donut') === 0) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }
    }
}

// NOTIFICATION BAR
function custom_woocommerce_notices_output() {
    $all_notices  = WC()->session->get( 'wc_notices', array() );
    $notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

    foreach ( $notice_types as $notice_type ) {
        if ( wc_notice_count( $notice_type ) > 0 ) {
            wc_get_template( "notices/{$notice_type}.php", array(
                'notices' => $all_notices[ $notice_type ],
            ) );
        }
    }

    wc_clear_notices();
}

remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_notices_output', 10 );
add_action( 'woocommerce_before_single_product', 'custom_woocommerce_notices_output', 10 );

