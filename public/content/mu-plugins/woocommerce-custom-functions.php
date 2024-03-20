<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 15:42:22
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-25 09:11:51
 */

/*
Plugin Name: WooCommerce Custom Functions
Description: Custom functions for WooCommerce.
Version: 1.0
Author: Bernard Hanna
*/
/*
 ****************************************************************
 * GENERAL WOO COMMERCE SETUP
 ***********************************************************
*/
// NOTICES
add_filter('login_errors', 'custom_login_error_message');

function custom_login_error_message($error)
{
    // Check if the error is related to incorrect password for the email
    if (strpos($error, 'The password you entered for the email address') !== false) {
        $error = 'Oops! Looks like you have entered the wrong password!';
    }
    return $error;
}

// Add your custom WooCommerce functions here
function rd_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'rd_add_woocommerce_support');
// SET path
add_filter('woocommerce_locate_template', function ($template, $template_name, $template_path) {
    $blade_template = locate_template("resources/views/woocommerce/{$template_name}");
    return (!$blade_template) ? $template : $blade_template;
}, 10, 3);
/*
 ****************************************************************
 * GENERAL WOO COMMERCE EDITS
 ***********************************************************
*/
// Set products per row
function custom_loop_columns()
{
    return 3; // 3 products per row
}
add_filter('loop_shop_columns', 'custom_loop_columns', 999);

// STYLE THE ADD TO CART
add_filter('woocommerce_loop_add_to_cart_args', 'customize_add_to_cart_button', 10, 2);

function customize_add_to_cart_button($args, $product)
{
    $args['class'] = 'bg-white text-mob-xs-font font-edmondsans font-reg420 py-4 px-10 flex items-center justify-center rounded-btn-72 border-1-fix';  // Here you can add your custom classes
    return $args;
}

// Image Styles
function custom_woocommerce_image_sizes($size)
{
    // Custom height for single product image on mobile
    if ('woocommerce_single' === $size['name']) {
        $size['height'] = 125;
    }

    // Custom height for product thumbnails on mobile
    if ('woocommerce_thumbnail' === $size['name']) {
        $size['height'] = 125;
    }

    // Custom height for product gallery thumbnails on mobile
    if ('woocommerce_gallery_thumbnail' === $size['name']) {
        $size['height'] = 125;
    }

    return $size;
}
add_filter('woocommerce_get_image_size', 'custom_woocommerce_image_sizes');

function custom_large_device_image_sizes($size)
{
    // Custom height for single product image on large devices
    if (wp_is_mobile() === false && 'woocommerce_single' === $size['name']) {
        $size['height'] = 386;
    }

    // Custom height for product thumbnails on large devices
    if (wp_is_mobile() === false && 'woocommerce_thumbnail' === $size['name']) {
        $size['height'] = 386;
    }

    // Custom height for product gallery thumbnails on large devices
    if (
        wp_is_mobile() === false && 'woocommerce_gallery_thumbnail' === $size['name']
    ) {
        $size['height'] = 386;
    }

    return $size;
}
add_filter('woocommerce_get_image_size', 'custom_large_device_image_sizes');
/*
 ****************************************************************
 * RD PRODUCT TYPE USED FOR FILTERING
 ***********************************************************
*/
//Product Types Mods
function get_rd_product_type($product_id)
{
    $terms = get_the_terms($product_id, 'rd_product_type');
    if ($terms && !is_wp_error($terms)) {
        return $terms[0]->name;  // Fetch the term name
    }
    return 'No RD Product Type';
}
// Add Product Types to Products on backend
add_filter('manage_edit-product_columns', function ($columns) {
    $columns['rd_product_type'] = __('RD Product Type', 'rollingdonuts');
    return $columns;
});

add_action('manage_product_posts_custom_column', function ($column) {
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
add_action('restrict_manage_posts', function () {
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

// Only allow selecting one rd_product_type on quick edit / bulk eidt
function add_quick_edit_single_checkbox()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Function to enforce single checkbox
            function enforceSingleCheckbox(checkboxes) {
                checkboxes.on('change', function() {
                    checkboxes.not(this).prop('checked', false);
                });
            }

            // For Quick Edit
            $('button.editinline').click(function() {
                setTimeout(function() {
                    enforceSingleCheckbox($('input[name="tax_input[rd_product_type][]"]'));
                }, 50);
            });

            // For Bulk Edit
            $('#doaction, #doaction2').click(function() {
                setTimeout(function() {
                    enforceSingleCheckbox($('input[name="tax_input[rd_product_type][]"]'));
                }, 50);
            });
        });
    </script>
<?php
}
add_action('admin_footer', 'add_quick_edit_single_checkbox');

add_filter('parse_query', function ($query) {
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
function filter_products()
{
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
 ***********************************************************/

// Customize the product summary on single product pages.
function customize_single_product_summary()
{
    // Remove the quantity field.
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

    // Add your custom Add to Cart button with Tailwind CSS classes.
    add_action('woocommerce_single_product_summary', 'custom_add_to_cart_button', 30);
}
add_action('woocommerce_before_single_product_summary', 'customize_single_product_summary', 1);

function custom_add_to_cart_button()
{
    global $product;

    // Get the RD product type
    $rd_product_type = get_rd_product_type($product->get_id());

    // Determine the button text based on the RD product type
    $button_text = 'Order now'; // Default text

    if (strcasecmp($rd_product_type, 'Donut') === 0) {
        // For Donut, change button behavior to a direct link instead of form submission
        $action_url = home_url('/donut-box/');
        $button_html = '<a href="' . esc_url($action_url) . '" class="single_add_to_cart_button button alt h-[58px] text-sm-md-font font-reg420 text-yellow-primary hover:text-black-full bg-black-full hover:bg-yellow-primary rounded-lg-x border-2 border-yellow-primary w-full flex items-center justify-center max-w-max-368">' . esc_html($button_text) . '</a>';
        echo $button_html;
    } else {
        // For other products, keep the standard add to cart functionality
        $action_url = esc_url($product->add_to_cart_url());
        switch ($rd_product_type) {
            case 'Merch':
                $button_text = 'Add to Basket';
                break;
            case 'Box':
                $button_text = 'Add Box';
                break;
        }

        // Output the form and button with dynamic action URL and button text for non-Donut products
        echo '<form class="cart py-8" action="' . $action_url . '" method="post" enctype="multipart/form-data">';
        echo '<button type="submit" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" class="single_add_to_cart_button h-[58px] text-sm-md-font font-reg420 text-yellow-primary hover:text-black-full bg-black-full hover:bg-yellow-primary rounded-lg-x border-2 border-yellow-primary w-full max-w-max-368">' . esc_html($button_text) . '</button>';
        echo '</form>';
    }
}

// Change text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text');

// Change text on archives/product listings
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text');

function custom_add_to_cart_text()
{
    return __('Select and customise', 'woocommerce');
}
//Remove the Breadcrumbs from Body
add_action('wp', 'remove_wc_breadcrumbs');
function remove_wc_breadcrumbs()
{
    if (function_exists('is_product') && is_product()) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
}

add_action('woocommerce_before_main_content', 'remove_wc_breadcrumbs_on_shop_page', 20);

function remove_wc_breadcrumbs_on_shop_page()
{
    if (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag()) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
}

//Remove Price from Single Product Body
add_action('wp', 'remove_single_product_price');
function remove_single_product_price()
{
    if (function_exists('is_product') && is_product()) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    }
}

//Add Product Description Below the Title
add_action('woocommerce_single_product_summary', 'the_content', 6);

//Change Button Text to "Add to Basket
function custom_cart_button_text()
{
    return __('Add to Basket', 'woocommerce');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_cart_button_text');

//Remove Tabbed Short Description
function remove_product_tabs($tabs)
{
    unset($tabs['description']); // Remove the description tab
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);

// Remove the additional information tab
add_action('init', 'remove_woocommerce_product_tabs', 99);
function remove_woocommerce_product_tabs()
{
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
}

// Remove categories display
add_action('woocommerce_single_product_summary', 'remove_product_categories', 1);
function remove_product_categories()
{
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}

// SINGLE DONUTS
add_action('woocommerce_before_add_to_cart_button', 'remove_elements_start', 10);
add_action('woocommerce_after_add_to_cart_button', 'remove_elements_end', 10);
// Remove the add to cart button and other stuff we don't need
function remove_elements_start()
{
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
function remove_elements_end()
{
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
// Remove the add to cart button for Single Donut
add_action('woocommerce_single_product_summary', 'remove_attribute_dropdowns', 1);

function remove_attribute_dropdowns()
{
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

//Prevent Single Donut Add to Cart
add_filter('woocommerce_add_to_cart_validation', 'restrict_single_donut_purchase', 10, 3);
function restrict_single_donut_purchase($passed, $product_id, $quantity)
{
    $product_type = get_rd_product_type($product_id);
    if (strcasecmp($product_type, 'Donut') === 0) {
        // Optionally, add a WC notice to inform the user
        wc_add_notice(__('Donuts can only be purchased as part of a bundle.', 'text-domain'), 'error');
        return false; // Prevent the add to cart action
    }
    return $passed;
}

//Prevent item added to cart on refresh
function custom_redirect_after_add_to_cart()
{
    if (isset($_REQUEST['add-to-cart'])) {
        $product_id = (int) $_REQUEST['add-to-cart'];
        $redirect_url = get_permalink($product_id); // Redirect back to the product page
        // For redirecting to the cart page use wc_get_cart_url() instead of get_permalink($product_id)

        wp_safe_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'custom_redirect_after_add_to_cart');

// NOTIFICATION BAR
add_filter('woocommerce_add_success', function ($message) {
    if (strpos($message, 'Cart updated') !== false) {
        // Returning an empty string removes the message
        return '';
    }
    return $message; // Return the original message for anything else
}, 10, 1);

function custom_woocommerce_notices_output()
{
    $all_notices  = WC()->session->get('wc_notices', array());
    $notice_types = apply_filters('woocommerce_notice_types', array('error', 'success', 'notice'));

    foreach ($notice_types as $notice_type) {
        if (wc_notice_count($notice_type) > 0) {
            wc_get_template("notices/{$notice_type}.php", array(
                'notices' => $all_notices[$notice_type],
            ));
        }
    }

    wc_clear_notices();
}

remove_action('woocommerce_before_shop_loop', 'wc_print_notices', 10);
remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
add_action('woocommerce_before_shop_loop', 'custom_woocommerce_notices_output', 10);
add_action('woocommerce_before_single_product', 'custom_woocommerce_notices_output', 10);

//Only Donuts products on the WooCOmmerce Shop page/ Our Donuts page
add_action('pre_get_posts', 'filter_products_by_rd_product_type');

function filter_products_by_rd_product_type($query)
{
    if (!is_admin() && is_post_type_archive('product') && $query->is_main_query()) {
        $tax_query = array(
            array(
                'taxonomy' => 'rd_product_type',
                'field'    => 'slug',
                'terms'    => 'Donut',
                'operator' => 'IN',
            ),
        );
        $query->set('tax_query', $tax_query);
    }
}
/*
 ****************************************************************
 * BREADCRUMB EDITS
 ***********************************************************
*/
// Change Bread Crumb Delimiter
function custom_woo_breadcrumbs_delimiter($defaults)
{
    $defaults['delimiter'] = ' &gt; '; // Changes the default " / " delimiter to " > "
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'custom_woo_breadcrumbs_delimiter');

//Change the breadcrumb catgeory link
add_filter('woocommerce_get_breadcrumb', 'customize_woocommerce_breadcrumbs', 20, 2);
function customize_woocommerce_breadcrumbs($crumbs, $breadcrumb)
{
    global $post;

    if (is_product()) {
        $terms = wp_get_post_terms($post->ID, 'rd_product_type');

        if (!is_wp_error($terms) && !empty($terms)) {
            $product_type = $terms[0]->name;

            if (strcasecmp($product_type, 'Donut') === 0) {
                // Remove the category (second last item)
                array_splice($crumbs, -2, 1);

                // Insert "Our Donuts" before the last item
                array_splice($crumbs, -1, 0, array(array('Our Donuts', home_url('/our-donuts/'))));
            }
            if (strcasecmp($product_type, 'Merch') === 0) {
                // Remove the category (second last item)
                array_splice($crumbs, -2, 1);

                // Insert "Our Donuts" before the last item
                array_splice($crumbs, -1, 0, array(array('Our Merch', home_url('/merch/'))));
            }
            if (strcasecmp($product_type, 'Box') === 0) {
                // Remove the category (second last item)
                array_splice($crumbs, -2, 1);

                // Insert "Our Donuts" before the last item
                array_splice($crumbs, -1, 0, array(array('Our Boxes', home_url('/donut-box/'))));
            }
        }
    }

    return $crumbs;
}
/*
 ****************************************************************
 * PRODUCT INDEX
 ***********************************************************/
// Custom function to limit WooCommerce product descriptions
function custom_truncate_product_description($description)
{
    $max_length = 70; // Change this to your desired character limit
    if (strlen($description) > $max_length) {
        $description = substr($description, 0, $max_length) . ''; // Add ellipsis if exceeded
    }
    return $description;
}
/*
 ****************************************************************
 * Dashboard My Acccount
 ***********************************************************
*/
//Bypass are you sure you want to log out screen
add_action('check_admin_referer', 'logout_without_confirmation', 10, 2);

function logout_without_confirmation($action, $result)
{
    if ($action == "log-out" && !$result) {
        wp_logout();
        wp_redirect(wc_get_page_permalink('myaccount'));
        exit();
    }
}

//BILLING FORM
add_filter('woocommerce_form_field_args', 'customize_my_account_address_fields', 10, 3);

function customize_my_account_address_fields($args, $key, $value)
{
    // Check if we're on the My Account page
    if (is_account_page()) {
        // Add custom class to all input fields
        $args['input_class'][] = 'rounded-lg-x h-input text-black-secondary
        text-mob-xs-font font-laca font-light pl-11 w-full flex';

        // Add custom class to all labels
        $args['label_class'][] = 'ml-2 text-mob-xs-font font-reg420';

        // Define custom placeholders for specific fields
        $custom_placeholders = array(
            'billing_first_name' => 'First name',
            'billing_last_name'  => 'Surname',
            'billing_company'    => 'Company Name',
            'billing_address_1'  => 'Enter your address',
            'billing_postcode' => 'Eircode',
            'billing_phone' => 'Phone Number',
            'billing_email' => 'Email Address',

        );

        // If there's a custom placeholder for this field, use it
        if (isset($custom_placeholders[$key])) {
            $args['placeholder'] = $custom_placeholders[$key];
        }
    }
    return $args;
}
//SHIPPING FORM
add_filter('woocommerce_shipping_fields', 'customize_checkout_shipping_fields', 20, 1);
function customize_checkout_shipping_fields($shipping_fields)
{
    // Define custom placeholders for specific fields
    $custom_placeholders = array(
        'shipping_first_name' => 'First name',
        'shipping_last_name'  => 'Surname',
        'shipping_company'    => 'Company Name',
        'shipping_address_1'  => 'Enter your address',
        'shipping_postcode'   => 'Eircode',
        'shipping_phone'      => 'Phone Number',
        'shipping_email'      => 'Email Address',
    );

    // Iterate over the shipping fields and apply changes
    foreach ($shipping_fields as $key => $field) {
        // Add custom class to all input fields
        $shipping_fields[$key]['input_class'][] = 'rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 w-full flex';

        // Add custom class to all labels
        $shipping_fields[$key]['label_class'][] = 'mt-4 ml-2 text-mob-xs-font font-reg420';

        // If there's a custom placeholder for this field, use it
        if (isset($custom_placeholders[$key])) {
            $shipping_fields[$key]['placeholder'] = $custom_placeholders[$key];
        }
    }

    return $shipping_fields;
}
// EDIT BUTTON ON BILLING ON MY ACCOUNT
function custom_woocommerce_button_classes($button, $product)
{
    global $post;
    if (isset($post->post_name) && $post->post_name == 'my-account') {
        // Example: Add 'bg-blue-500' and 'text-white' classes from Tailwind CSS
        $button = str_replace('class="button ', 'class="button bg-blue-500 text-white ', $button);
    }
    return $button;
}
add_filter('woocommerce_loop_add_to_cart_link', 'custom_woocommerce_button_classes', 10, 2);

// REMOVE DOWNLOADS
function remove_downloads_from_my_account($items)
{
    unset($items['downloads']);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_downloads_from_my_account');

/*
 ****************************************************************
 * Cart page
 ***********************************************************
*/
//Set Thumbnail size
add_filter('woocommerce_get_image_size_thumbnail', 'custom_woocommerce_thumbnail_size', 10, 2);

function custom_woocommerce_thumbnail_size($size)
{
    // Check if it's the cart page
    if (is_cart()) {
        return array(
            'width'  => 64,
            'height' => 64,
            'crop'   => 1,
        );
    }
    // If it's not the cart page, return the original size
    return $size;
}
// Add Increment and Decrement Buttons
function custom_quantity_update_script_with_svg_and_wrapper()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            function addQuantityButtons() {
                $('input.qty').not('.hasQtyButtons').each(function() {
                    var $input = $(this);
                    $input.addClass('hasQtyButtons');

                    // Create wrapper div and add 'relative' class
                    var $wrapper = $('<div class="relative flex items-center justify-between quantity_input"></div>');

                    // Move the input inside the wrapper
                    $input.wrap($wrapper);

                    // Get the new wrapper reference
                    $wrapper = $input.parent();

                    var decrementSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="4" viewBox="0 0 19 4" fill="none"><path d="M18.0553 2.26316C18.0553 3.2175 17.2816 3.99116 16.3273 3.99116H2.0073C1.05295 3.99116 0.279297 3.2175 0.279297 2.26316C0.279297 1.30881 1.05295 0.535156 2.0073 0.535156H16.3273C17.2816 0.535156 18.0553 1.30881 18.0553 2.26316Z" fill="#291F19"/></svg>';
                    var $decrementBtn = $('<button type="button" class="border border-solid border-black rounded bg-white h-[29px] w-[29px] ml-4 flex items-center justify-center decrement-btn absolute left-0 hover:bg-yellow-primary"></button>').click(function(e) {
                        e.preventDefault();
                        var value = parseInt($input.val()) - 1;
                        $input.val(value >= 1 ? value : 1);
                        $input.trigger('change');
                        triggerCartUpdate($input);
                    });

                    var incrementSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none"><path d="M2.08737 8.00708C1.13303 8.00708 0.359375 7.23343 0.359375 6.27908C0.359375 5.32473 1.13303 4.55108 2.08738 4.55108H4.42338V2.18308C4.42338 1.22873 5.19703 0.455078 6.15137 0.455078C7.10572 0.455078 7.87937 1.22873 7.87937 2.18308V4.55108H10.2474C11.2017 4.55108 11.9754 5.32473 11.9754 6.27908C11.9754 7.23343 11.2017 8.00708 10.2474 8.00708H7.87937V10.3431C7.87937 11.2974 7.10572 12.0711 6.15137 12.0711C5.19703 12.0711 4.42338 11.2974 4.42338 10.3431V8.00708H2.08737Z" fill="#291F19"/></svg>';
                    var $incrementBtn = $('<button type="button" class="border border-solid border-black rounded bg-white h-[29px] w-[29px] mr-4 flex items-center justify-center increment-btn absolute right-0 hover:bg-yellow-primary"></button>').click(function(e) {
                        e.preventDefault();
                        var value = parseInt($input.val()) + 1;
                        $input.val(value);
                        $input.trigger('change');
                        triggerCartUpdate($input);
                    });

                    // Add SVG icons directly
                    $decrementBtn.html(decrementSvg);
                    $incrementBtn.html(incrementSvg);

                    // Append buttons to the wrapper
                    $wrapper.append($decrementBtn);
                    $wrapper.append($incrementBtn);
                });
            }

            function triggerCartUpdate($input) {
                var $form = $input.closest('form');

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: $form.serialize() + '&update_cart=Update Cart',
                    success: function() {
                        $(document.body).trigger('updated_cart_totals');
                    },
                    error: function() {
                        console.error('Failed to update cart.');
                    }
                });
            }

            addQuantityButtons();

            $(document.body).on('updated_cart_totals', function() {
                addQuantityButtons();
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_quantity_update_script_with_svg_and_wrapper');

/*
 ****************************************************************
 * Checkout  page
 ***********************************************************
*/
// Customise Checkput Fields
function custom_woocommerce_form_field_args($args, $key, $value)
{

    //Styling Form Fields Using Filters
    $args['label_class'][] = 'ml-2 text-mob-xs-font font-reg420 block pb-2';
    $args['input_class'][] = 'woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full';

    // Check if the key matches any of our conditions
    switch ($key) {
        case 'billing_first_name':
            $args['placeholder'] = 'First Name';
            $args['input_class'][] = 'lg:w-99';
            $args['wrapper_class'] = 'first-name-wrapper';
            $args['before_field'] = '<div class="billing-name-wrapper flex w-full flex-wrap flex-col md:flex-row md:justify-between items-center">';  //
            break;

        case 'billing_last_name':
            $args['placeholder'] = 'Last Name';
            $args['input_class'][] = 'lg:w-99';
            $args['after_field'] = '</div>';  // Close the wrapping div
            break;

        case 'billing_company':
            $args['placeholder'] = 'Company';
            break;

        case 'billing_country':
            $args['placeholder'] = 'Country';
            break;

        case 'billing_address_1':
            $args['placeholder'] = 'House Number and street name';
            break;

        case 'billing_address_2':
            $args['placeholder'] = 'Apartment, suite, unit etc (Optional)';
            break;

        case 'billing_city':
            $args['placeholder'] = 'Town/ City';
            break;

        case 'billing_state':
            $args['placeholder'] = 'County';
            $args['type'] = 'text'; // Change type to text input
            $args['default'] = 'Dublin'; // Set default value to Dublin
            $args['custom_attributes'] = array('readonly' => 'readonly'); // Make the field readonly
            break;

        case 'billing_postcode':
            $args['placeholder'] = 'Eircode';
            break;

        case 'billing_phone':
            $args['placeholder'] = 'Telephone number';
            break;

        case 'billing_email':
            $args['placeholder'] = 'Email';
            break;


        case 'shipping_company':
            $args['placeholder'] = 'Company';
            break;

        case 'shipping_address_1':
            $args['placeholder'] = 'House Number and street name';
            break;

        case 'shipping_address_2':
            $args['placeholder'] = 'Apartment, suite, unit etc (Optional)';
            break;

        case 'shipping_city':
            $args['placeholder'] = 'Town/ City';
            break;

        case 'shipping_state':
            $args['placeholder'] = 'County';
            break;

        case 'shipping_postcode':
            $args['placeholder'] = 'Eircode';
            break;



        default:
            break;
    }

    return $args;
}

//STYLE NAMES FIELD
add_filter('woocommerce_form_field_args', 'custom_woocommerce_form_field_args', 10, 3);
add_filter('woocommerce_form_field', 'change_woocommerce_field_markup', 10, 4);


function change_woocommerce_field_markup($field, $key, $args, $value)
{
    // Remove 'form-row' class from the field
    $field = str_replace('form-row', '', $field);

    // Wrap each field with a div
    $field = '<div class="single-field-wrapper w-full" data-priority="' . $args['priority'] . '">' . $field . '</div>';

    // Wrap first and last name fields together for both billing and shipping
    if ($key === 'billing_first_name' || $key === 'shipping_first_name') {
        $field = '<div class="name-field w-full flex flex-col xl:flex-row xl:justify-between">' . $field;
    } else if ($key === 'billing_last_name' || $key === 'shipping_last_name') {
        $field = $field . '</div>';
    }

    return $field;
}

add_filter("woocommerce_form_field", "change_woocommerce_field_markup", 10, 4);
//Only ALlow Dublin as an Option
function custom_woocommerce_states($states)
{
    $states['IE'] = array(
        //'' => 'Select Area Code',  // Placeholder
        'D' => __('Dublin', 'woocommerce'),
        'D01' => 'Dublin 01', 'D02' => 'Dublin 02', 'D03' => 'Dublin 03', 'D04' => 'Dublin 04',
        'D05' => 'Dublin 05', 'D06' => 'Dublin 06', 'D6W' => 'Dublin 6W', 'D07' => 'Dublin 07',
        'D08' => 'Dublin 08', 'D09' => 'Dublin 09', 'D11' => 'Dublin 11', 'D12' => 'Dublin 12',
        'D13' => 'Dublin 13', 'D14' => 'Dublin 14', 'D15' => 'Dublin 15', 'D16' => 'Dublin 16',
        'D17' => 'Dublin 17', 'D18' => 'Dublin 18', 'D20' => 'Dublin 20', 'D22' => 'Dublin 22', 'D24' => 'Dublin 24',
        'break' => '************* Note: We Do Not Delivery to the Any of the below ****************',
        'CE' => 'Clare', 'CN' => 'Cavan', 'CW' => 'Carlow', 'C' => 'Cork',
        'DL' => 'Donegal', 'G' => 'Galway', 'KE' => 'Kildare', 'KY' => 'Kerry',
        'KK' => 'Kilkenny', 'LS' => 'Laois', 'LM' => 'Leitrim', 'LH' => 'Louth',
        'LD' => 'Longford', 'L' => 'Limerick', 'MH' => 'Meath', 'MN' => 'Monaghan',
        'MO' => 'Mayo', 'OY' => 'Offaly', 'RN' => 'Roscommon', 'SO' => 'Sligo',
        'TA' => 'Tipperary', 'WD' => 'Waterford', 'WH' => 'Westmeath', 'WX' => 'Wexford',
        'WW' => 'Wicklow'
    );
    return $states;
}
add_filter('woocommerce_states', 'custom_woocommerce_states');

/*
 ****************************************************************
 * SHIPPING ZONES SET UP
 ***********************************************************

add_filter('woocommerce_states', 'custom_woocommerce_states');

function custom_woocommerce_states($states) {
    $states['IE'] = array(
        'D01' => 'Dublin 01', 'D02' => 'Dublin 02', 'D03' => 'Dublin 03', 'D04' => 'Dublin 04',
        'D05' => 'Dublin 05', 'D06' => 'Dublin 06', 'D6W' => 'Dublin 6W', 'D07' => 'Dublin 07',
        'D08' => 'Dublin 08', 'D09' => 'Dublin 09', 'D11' => 'Dublin 11', 'D12' => 'Dublin 12',
        'D13' => 'Dublin 13', 'D14' => 'Dublin 14', 'D15' => 'Dublin 15', 'D16' => 'Dublin 16',
        'D17' => 'Dublin 17', 'D18' => 'Dublin 18', 'D20' => 'Dublin 20', 'D22' => 'Dublin 22', 'D24' => 'Dublin 24'
    );

    return $states;
}

add_action('woocommerce_init', 'add_dublin_shipping_zones');

function add_dublin_shipping_zones() {
    $north_zones = array('D01', 'D03', 'D05', 'D07', 'D09', 'D11', 'D13', 'D15', 'D17');
    $south_zones = array('D02', 'D04', 'D06', 'D6W', 'D08', 'D12', 'D14', 'D16', 'D18', 'D20', 'D22', 'D24');
}

add_filter('woocommerce_checkout_fields', 'add_postcode_dropdown_to_checkout');

function add_postcode_dropdown_to_checkout($fields) {
    $postcode_field = array(
        'type' => 'select',
        'options' => array(
            '' => 'Select Area Code',  // Placeholder
            'D01' => 'Dublin 01', 'D02' => 'Dublin 02', 'D03' => 'Dublin 03', 'D04' => 'Dublin 04',
            'D05' => 'Dublin 05', 'D06' => 'Dublin 06', 'D6W' => 'Dublin 6W', 'D07' => 'Dublin 07',
            'D08' => 'Dublin 08', 'D09' => 'Dublin 09', 'D11' => 'Dublin 11', 'D12' => 'Dublin 12',
            'D13' => 'Dublin 13', 'D14' => 'Dublin 14', 'D15' => 'Dublin 15', 'D16' => 'Dublin 16',
            'D17' => 'Dublin 17', 'D18' => 'Dublin 18', 'D20' => 'Dublin 20', 'D22' => 'Dublin 22', 'D24' => 'Dublin 24'
        ),
        'label' => 'Dublin Postcode',
        'required' => true,
    );

    // Insert the postcode field after the state field
    $order = array();
    foreach ($fields['billing'] as $key => $value) {
        $order[$key] = $value;
        if ($key === 'billing_state') {
            $order['billing_postcode_dropdown'] = $postcode_field;
        }
    }
    $fields['billing'] = $order;

    return $fields;
}

add_filter('woocommerce_shipping_zone_matching_package', 'assign_shipping_zone_based_on_postcode', 10, 2);

function assign_shipping_zone_based_on_postcode($zone, $package) {
    $postcode = $package['destination']['postcode'];
    $north_zones = array('D01', 'D03', 'D05', 'D07', 'D09', 'D11', 'D13', 'D15', 'D17');
    $south_zones = array('D02', 'D04', 'D06', 'D6W', 'D08', 'D12', 'D14', 'D16', 'D18', 'D20', 'D22', 'D24');

    if (in_array($postcode, $north_zones)) {
        $zone = new WC_Shipping_Zone(1);
    } elseif (in_array($postcode, $south_zones)) {
        $zone = new WC_Shipping_Zone(2);
    }
    return $zone;
}
*/
/*
 ****************************************************************
 * CART TOTALS
 ***********************************************************\
*/
/*
 ****************************************************************
 * PAYMENTS
 ***********************************************************\
*/
//Payment button
function change_woocommerce_order_button_text($order_button_text)
{
    return 'Pay now'; // Change the button text to "Pay now"
}

add_filter('woocommerce_order_button_text', 'change_woocommerce_order_button_text');

function custom_woocommerce_order_button_html($button_html)
{
    // Retrieve the order button text
    $order_button_text = apply_filters('woocommerce_order_button_text', __('Place order', 'woocommerce'));

    // Define custom classes
    $custom_classes = 'btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[66px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary woocommerce-button button woocommerce-form-login__submit ml-auto mr-auto max-w-max-704 mt-6';

    // Build the button HTML
    $button_html = '<button type="submit" class="button alt ' .
        esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . ' ' .
        $custom_classes . '" name="woocommerce_checkout_place_order" id="place_order" value="' .
        esc_attr($order_button_text) . '" data-value="' .
        esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>';

    return $button_html;
}

add_filter('woocommerce_order_button_html', 'custom_woocommerce_order_button_html');
// ADD ICONS TO FIELDS
add_filter('woocommerce_default_address_fields', 'override_default_address_checkout_fields', 20, 1);
function override_default_address_checkout_fields($address_fields)
{
    $address_fields['first_name']['class'][] = 'icon-first-name';
    $address_fields['last_name']['class'][] = 'icon-last-name';
    $address_fields['company']['class'][] = 'icon-company';
    $address_fields['address_1']['class'][] = 'icon-address-1';
    $address_fields['address_2']['class'][] = 'icon-address-2';
    $address_fields['city']['class'][] = 'icon-city';
    $address_fields['state']['class'][] = 'icon-state';
    $address_fields['postcode']['class'][] = 'icon-postcode';
    $address_fields['country']['class'][] = 'icon-country';
    $address_fields['phone']['class'][] = 'icon-phone';
    $address_fields['email']['class'][] = 'icon-email';
    return $address_fields;
}


function custom_woocommerce_login_form_field_args($args, $key, $value)
{
    // Add Tailwind classes to form fields
    if (in_array($key, array('username', 'password'))) {
        $args['input_class'] = array('border', 'border-gray-300', 'p-2', 'rounded');
        $args['label_class'] = array('block', 'text-sm', 'font-medium', 'mb-1');
    }

    return $args;
}
add_filter('woocommerce_form_field_args', 'custom_woocommerce_login_form_field_args', 10, 3);

function custom_login_button_styles()
{
    $custom_css = "
        .woocommerce-form-login .woocommerce-button {
            background-color: #3182ce; /* Tailwind blue-500 */
            color: #ffffff;
            padding: 12px;
            border-radius: 0.25rem;
        }
    ";
    wp_add_inline_style('your-main-stylesheet-handle', $custom_css);
}
add_action('wp_enqueue_scripts', 'custom_login_button_styles');


/*
 ****************************************************************
 * NOTICES
 ***********************************************************\
*/
add_filter('wc_add_to_cart_message_html', 'customize_wc_add_to_cart_message_with_tailwind', 10, 2);

function customize_wc_add_to_cart_message_with_tailwind($message, $products)
{
    $productNames = array_map(function ($productId) {
        return get_the_title($productId);
    }, array_keys($products));

    $productName = $productNames[0];

    $viewCartButtonClasses = 'text-yellow-primary text-sm-md-font font-reg42 hover:underline';
    $productNameClasses = 'font-laca text-white text-sm-md-font font-light';

    $styledProductName = "<span class=\"$productNameClasses\">$productName</span>";
    $message = str_replace("“{$productName}”", $styledProductName, $message);

    $styledViewCartLink = str_replace('class="button wc-forward"', "class=\"$viewCartButtonClasses\"", $message);

    return $styledViewCartLink;
}

//DISABLE FOR SINGLE DONUTS
add_filter('woocommerce_add_to_cart_message_html', 'disable_added_to_cart_notification_for_donuts', 10, 3);

function disable_added_to_cart_notification_for_donuts($message, $products, $show_qty)
{
    foreach ($products as $product_id => $qty) {
        // Check if the product has the RD type of Donut
        $product_type = get_rd_product_type($product_id);
        if (strcasecmp($product_type, 'Donut') === 0) {
            // If yes, return an empty string to disable the notification
            return '';
        }
    }
    // Otherwise, return the default message
    return $message;
}

// Consolidate WC Notices
function combine_wc_notices_into_one($message, $products)
{
    // Get all notices
    $notices = WC()->session->get('wc_notices', array());

    // Check if there are any "success" notices (you can also check for 'error' or 'notice' types)
    if (isset($notices['success']) && count($notices['success']) > 1) {
        // Combine all success messages into one
        $combined_message = '';
        foreach ($notices['success'] as $notice) {
            $combined_message .= $notice['notice'] . ' ';
        }

        // Clear the individual success notices
        $notices['success'] = array();

        // Add the combined message as a new single notice
        wc_add_notice($combined_message, 'success');

        // Since we've modified the notices, set them back in the session
        WC()->session->set('wc_notices', $notices);
    }

    // Return the original message - in practice, this will be overridden by the combined notice we set above
    return $message;
}

//Fix issue of single donuts not adding to bundle
function allow_bundles_and_boxes_in_cart($passed, $product_id, $quantity, $variation_id = '', $variations = '')
{
    $product = wc_get_product($product_id);
    $product_type = $product->get_type();

    // Adjust these checks according to your actual product types or identifiers
    if ($product_type === 'woosb' || $product_type === 'diy_box') {
        return true;
    }

    return $passed;
}
add_filter('woocommerce_add_to_cart_validation', 'allow_bundles_and_boxes_in_cart', 10, 5);


add_action('woocommerce_before_add_to_cart', function () {
    error_log('Attempting to add to cart');
});

/*
 ****************************************************************
 * Delivery SLot Plugin Edits
 ***********************************************************\
*/
function iconic_modify_delivery_slots_label_for_collection_and_delivery($labels, $order)
{
    $labels['date'] = 'Collection / Delivery Date'; // Changing the 'Delivery Date' label

    // You can also customize other labels as needed:
    $labels['details'] = '';
    $labels['select_date'] = 'Select a Collection / Delivery date';
    $labels['choose_date'] = 'Please choose a date for your collection or delivery';
    $labels['select_date_first'] = 'Please choose a date first';
    $labels['choose_time_slot'] = 'Please choose a time slot for your collection or delivery';

    return $labels;
}

add_filter('iconic_wds_labels', 'iconic_modify_delivery_slots_label_for_collection_and_delivery', 10, 2);


// MOVE THE SHIPPING OPTIONS BEFORE THE DELIVERY SLOTS
function custom_move_shipping_options()
{
    static $already_run = false;

    // Check if the function has already run
    if ($already_run) {
        return;
    }

    if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) {
        wc_cart_totals_shipping_html();
    }

    // Mark the function as having run
    $already_run = true;
}
add_action('iconic_wds_before_checkout_fields', 'custom_move_shipping_options', 10);


// FIX TO TIME CHANGING WHEN COUNTY IS CHANGED
function iconic_save_delivery_time_to_session()
{
    if (isset($_POST['jckwds-delivery-time'])) {
        WC()->session->set('iconic_delivery_time', sanitize_text_field($_POST['jckwds-delivery-time']));
    }
}
add_action('woocommerce_checkout_update_order_review', 'iconic_save_delivery_time_to_session');

function iconic_restore_delivery_time_from_session()
{
    $deliveryTime = WC()->session->get('iconic_delivery_time');
    if (!empty($deliveryTime)) {
    ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var savedDeliveryTime = <?php echo json_encode($deliveryTime); ?>;
                var deliveryTimeField = document.getElementById('jckwds-delivery-time');

                if (deliveryTimeField && savedDeliveryTime) {
                    deliveryTimeField.value = savedDeliveryTime;
                }
            });
        </script>
    <?php
    }
}
add_action('woocommerce_after_checkout_form', 'iconic_restore_delivery_time_from_session');

/*
 ****************************************************************
 * LOCAL PICKUP  EDITS
 ***********************************************************\
*/
add_filter('wc_local_pickup_plus_get_pickup_location_package_field_html', 'customize_pickup_location_field_html_one', 10, 3);

function customize_pickup_location_field_html_one($field_html, $package_id, $package)
{
    // Remove all <br /> tags from the output
    $field_html = str_replace('<br />', '', $field_html);

    return $field_html;
}

add_filter('wc_local_pickup_plus_get_pickup_location_package_field_html', 'customize_pickup_location_field_html_two', 10, 3);

function customize_pickup_location_field_html_two($field_html, $package_id, $package)
{
    // Add "Collect at: " text before the address within the pickup-location-address div
    $search = '<div class="pickup-location-address">';
    $replace = '<div class="pickup-location-address"><strong>Collect at:</strong> ';

    // Using str_replace to insert the text
    $field_html = str_replace($search, $replace, $field_html);

    return $field_html;
}

/*
 ****************************************************************
 * My Account
 ***********************************************************\
*/

//REORDER BUTTON
add_action('woocommerce_order_details_after_order_table', 'remove_default_order_again_button', 1);

function remove_default_order_again_button()
{
    // Remove the default WooCommerce 'Order Again' button by unhooking it
    remove_action('woocommerce_order_details_after_order_table', 'woocommerce_order_again_button');
}

add_action('woocommerce_order_details_after_order_table', 'custom_add_order_again_button', 30);

// REMOVE The reorder notifications

function custom_add_order_again_button($order)
{
    if (!$order || !is_a($order, 'WC_Order')) return;
    if (!$order->has_status('completed')) return; // Or any other status you wish to check

    $reorder_url = wp_nonce_url(add_query_arg('order_again', $order->get_id(), wc_get_cart_url()), 'woocommerce-order_again');

    // Start session if not already started
    if (!session_id()) session_start();

    // Set a session flag when the "Order Again" button is generated
    $_SESSION['custom_order_again_clicked'] = true;

    echo '<div class="w-full max-w-max-1000 px-4 wc-reorder-button-container"><div class="flex justify-start"><a href="' . esc_url($reorder_url) . '" class="mx-auto btn-width rounded-btn-72 border-3 border-color-yellow-primary bg-yellow-primary text-black-full text-sm-md-font font-reg420 w-full max-md:w-[342px] md:w-[322px] h-[64px] flex flex-row items-center justify-center hover:bg-white button wc-reorder-button mt-8"><svg class="mr-2" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25.9904 15.6191C26.6514 16.5185 27.2976 16.6668 28.2774 16.8904C28.9557 17.0449 29.7451 17.2265 30.547 17.6985C30.6681 16.4568 30.6285 15.2039 30.4296 13.9573C29.8984 10.6263 28.2242 7.5573 25.7149 5.31359C23.4489 3.28857 20.5936 2.00734 17.6 1.66016C17.5889 1.88749 17.5728 2.1 17.5567 2.29027L17.5543 2.3224C17.4764 3.30463 17.4245 3.95452 18.0769 4.84286C18.733 5.73738 19.3742 5.88317 20.3453 6.10556L20.3614 6.10927C21.5611 6.38355 23.0449 6.72209 24.362 8.51606C25.6803 10.3113 25.5592 11.831 25.4616 13.0517C25.3813 14.0586 25.3282 14.7196 25.9892 15.6191H25.9904Z" fill="black"/>
<path d="M16 0C7.17714 0 0 7.17714 0 16C0 24.8229 7.17714 32 16 32C24.8229 32 32 24.8229 32 16C32 7.17714 24.8229 0 16 0ZM24.3484 8.32618C23.0968 6.62239 21.6871 6.29992 20.5467 6.03923L20.5319 6.03552C19.6102 5.82425 18.9998 5.68587 18.3771 4.83583C17.7569 3.99197 17.8063 3.37421 17.8805 2.44015L17.8829 2.4105C17.8978 2.22888 17.9138 2.02749 17.9237 1.81127C20.7691 2.14116 23.4811 3.35815 25.6346 5.28309C28.0191 7.41436 29.6093 10.3314 30.1146 13.4956C30.3036 14.6792 30.3407 15.8715 30.2258 17.0502C29.4635 16.6005 28.7135 16.4287 28.0686 16.2817C27.1382 16.0692 26.5229 15.9283 25.8953 15.0734C25.2676 14.2184 25.3183 13.5907 25.3937 12.6344C25.4863 11.4743 25.6012 10.03 24.3484 8.32494V8.32618ZM16 30.5174C7.99506 30.5174 1.48263 24.0049 1.48263 16C1.48263 7.99506 7.99506 1.48263 16 1.48263C16.1495 1.48263 16.299 1.4851 16.4473 1.49004C16.4436 1.7705 16.4238 2.04355 16.404 2.29313L16.4015 2.32278C16.3188 3.35568 16.2335 4.4244 17.1812 5.71305C18.1313 7.00788 19.1839 7.24757 20.202 7.47984L20.223 7.48479C21.2547 7.72077 22.2283 7.94317 23.1537 9.20216C24.0791 10.4624 24 11.4607 23.916 12.522C23.832 13.5685 23.7467 14.652 24.7005 15.9506C25.6556 17.2503 26.7144 17.4925 27.7399 17.7273C28.5702 17.9163 29.4276 18.114 30.2246 18.9171C28.8704 25.5283 23.0079 30.5161 16.0025 30.5161L16 30.5174Z" fill="#2D2A2A"/>
<g clip-path="url(#clip0_2683_11557)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M22.1757 14.3244C22.5174 15.583 22.4665 16.916 22.0297 18.1449C21.5929 19.3737 20.7911 20.4398 19.7317 21.2004L20.9997 21.2004C21.1588 21.2004 21.3114 21.2636 21.4239 21.3761C21.5365 21.4886 21.5997 21.6413 21.5997 21.8004C21.5997 21.9595 21.5365 22.1121 21.4239 22.2247C21.3114 22.3372 21.1588 22.4004 20.9997 22.4004L17.5997 22.4004L17.5997 19.0004C17.5997 18.8413 17.6629 18.6886 17.7754 18.5761C17.8879 18.4636 18.0405 18.4004 18.1997 18.4004C18.3588 18.4004 18.5114 18.4636 18.6239 18.5761C18.7365 18.6886 18.7997 18.8413 18.7997 19.0004L18.7997 20.382C19.7801 19.7553 20.522 18.8179 20.9067 17.7198C21.2914 16.6217 21.2967 15.4262 20.9217 14.3247C20.5467 13.2232 19.8131 12.2793 18.8382 11.644C17.8634 11.0087 16.7037 10.7188 15.5445 10.8205C14.3854 10.9222 13.2939 11.4097 12.4446 12.2051C11.5953 13.0005 11.0373 14.0577 10.8599 15.2077C10.6825 16.3577 10.8959 17.5339 11.466 18.5483C12.0361 19.5626 12.9299 20.3565 14.0045 20.8028C14.1479 20.8662 14.2608 20.9831 14.319 21.1287C14.3772 21.2743 14.3762 21.4369 14.3161 21.5816C14.256 21.7264 14.1416 21.842 13.9974 21.9035C13.8531 21.965 13.6906 21.9676 13.5445 21.9108C12.5408 21.4938 11.6599 20.8282 10.9847 19.9766C10.3096 19.1249 9.86239 18.1154 9.68535 17.0431C9.5083 15.9709 9.60723 14.8712 9.97281 13.8477C10.3384 12.8242 10.9586 11.9107 11.7749 11.1933C12.5912 10.4758 13.5768 9.97808 14.6387 9.74695C15.7007 9.51582 16.804 9.55892 17.8446 9.87218C18.8853 10.1854 19.829 10.7586 20.5869 11.5375C21.3448 12.3164 21.891 13.2755 22.1757 14.3244Z" fill="#2D2A2A"/>
</g>
<defs>
<clipPath id="clip0_2683_11557">
<rect width="12.8" height="12.8" fill="white" transform="matrix(-4.37114e-08 -1 -1 4.37114e-08 22.4 22.4004)"/>
</clipPath>
</defs>
</svg>
' . esc_html__('Order Again', 'woocommerce') . '</a></div></div>';
}

add_action('woocommerce_before_cart', 'custom_add_order_again_button');


add_action('woocommerce_before_cart', 'custom_disable_wc_notices_on_cart_page');

function custom_disable_wc_notices_on_cart_page()
{
    if (is_cart()) {
        wc_clear_notices();
    }
}


function customize_payment_methods_columns($columns)
{
    // Change 'edit' to the actual column ID of the "Edit" column if it exists
    // This is just an example; you'll need to adjust it based on the actual setup
    if (isset($columns['method'])) {
        $columns['method'] = __('Card', 'woocommerce'); // Changing the title of the 'method' column
    }

    // If the 'actions' column is where the edit option exists
    if (isset($columns['actions'])) {
        $columns['actions'] = __('Edit', 'woocommerce'); // Attempt to rename the actions column, if applicable
    }

    return $columns;
}
add_filter('woocommerce_account_payment_methods_columns', 'customize_payment_methods_columns');

/*
 ****************************************************************
 * PRODUCT ATTRIBUTES
 ***********************************************************\
*/
//ENABLE ATTRIUBUTES AND MAKE THE COLURS DYNAMIC
function cw_woo_attribute()
{
    global $product;
    $attributes = $product->get_attributes();
    if (!$attributes) {
        return;
    }

    $nonce = wp_create_nonce('cw_add_to_cart_nonce');
    echo '<div class="custom-attributes" data-nonce="' . esc_attr($nonce) . '">';

    foreach ($attributes as $attribute) {
        if ($attribute->get_variation()) {
            continue;
        }
        $attribute_taxonomy = $attribute->get_taxonomy_object();
        $attribute_name = $attribute_taxonomy->attribute_label;

        echo "<div class='{$attribute->get_name()} attribute-container'>";
        echo "<strong class='text-mob-md-font font-reg420 text-black-full'>{$attribute_name}:</strong> <div class='color-name-display'></div>";

        if ($attribute->is_taxonomy() && ($attribute->get_name() == 'pa_color' || $attribute->get_name() == 'pa_colour')) {
            $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), 'all');

            foreach ($terms as $term) {
                $term_name = esc_html($term->name);
                $colorValue = strtolower($term_name); // Assumes names are valid CSS color values
                echo "<button type='button' class='attribute-button color-swatch' onclick='updateColorSelection(this, \"{$term_name}\")' style='background-color: {$colorValue}; width: 3rem; height: 3rem; border: 1px solid #ccc; border-radius: 50%; margin-right: 5px;'></button> ";
            }
        } else {
            // Handle non-color attributes
            $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), 'all');
            foreach ($terms as $term) {
                echo "<button type='button' class='attribute-button' data-attribute-name='{$attribute->get_name()}' data-attribute-value='" . esc_attr($term->slug) . "'>" . esc_html($term->name) . "</button> ";
            }
        }
        echo "</div>";
    }

    echo '</div>';

    // Inline JavaScript for single selection and display color name
    echo "<script>
        function updateColorSelection(element, colorName) {
            // Clear previous selections
            document.querySelectorAll('.color-swatch').forEach(btn => btn.classList.remove('selected'));
            // Mark the clicked swatch as selected
            element.classList.add('selected');
            // Update the display with the selected color name
            document.querySelector('.color-name-display').textContent = colorName;
        }
    </script>";
}
add_action('woocommerce_single_product_summary', 'cw_woo_attribute', 25);


function add_selected_attributes_to_cart_item($cart_item_data, $product_id, $variation_id)
{
    if (!empty($_POST['selected_attributes'])) {
        foreach ($_POST['selected_attributes'] as $name => $value) {
            $cart_item_data['selected_attributes'][$name] = sanitize_text_field($value);
        }
    }

    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'add_selected_attributes_to_cart_item', 10, 3);

//BUTTON JS, SET UP SWATCHES
add_action('wp_footer', 'cw_add_custom_attribute_scripts');
function cw_add_custom_attribute_scripts()
{
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const attributeContainers = document.querySelectorAll('.attribute-container');
            const addToCartButton = document.querySelector('button.single_add_to_cart_button');

            // Initially disable the Add to Cart button only if there are attribute containers
            addToCartButton.disabled = attributeContainers.length > 0;

            function checkAllAttributesSelected() {
                let allSelected = true;
                attributeContainers.forEach(container => {
                    if (!container.querySelector('.attribute-button.selected')) {
                        allSelected = false;
                    }
                });
                // Enable or disable the Add to Cart button based on attribute selection
                addToCartButton.disabled = !allSelected;
            }

            // Bind click event listeners to attribute buttons, if any
            if (attributeContainers.length > 0) {
                document.querySelectorAll('.attribute-button').forEach(button => {
                    button.addEventListener('click', function() {
                        // Unselect siblings
                        this.closest('.attribute-container').querySelectorAll('.attribute-button').forEach(btn => {
                            btn.classList.remove('selected');
                        });
                        // Mark the clicked button as selected
                        this.classList.add('selected');
                        // Re-check if all attributes have been selected
                        checkAllAttributesSelected();
                    });
                });
            }

            // Update color name display for color swatches, if present
            document.querySelectorAll('.color-swatch').forEach(button => {
                button.addEventListener('click', function() {
                    const colorName = this.getAttribute('data-color-name');
                    document.querySelector('.color-name-display').textContent = colorName;
                });
            });
        });
    </script>
<?php
}
//SET THE CORRECT TERMS AT CART
add_filter('woocommerce_get_item_data', 'display_selected_attributes_in_cart', 10, 2);
function display_selected_attributes_in_cart($item_data, $cart_item)
{
    if (isset($cart_item['selected_attributes'])) {
        foreach ($cart_item['selected_attributes'] as $attribute => $value) {
            // Format the attribute name for display
            $formatted_name = ucfirst(str_replace('pa_', '', $attribute)); // Remove 'pa_' prefix and capitalize
            $formatted_name = str_replace('_', ' ', $formatted_name); // Replace underscores with spaces
            $formatted_name = ucwords($formatted_name); // Capitalize each word

            // Check if there's a more friendly name set in WooCommerce and use it
            $taxonomy = wc_attribute_taxonomy_name(str_replace('pa_', '', $attribute));
            if (taxonomy_exists($taxonomy)) {
                $attribute_taxonomy = get_taxonomy($taxonomy);
                if ($attribute_taxonomy && !is_wp_error($attribute_taxonomy)) {
                    $formatted_name = $attribute_taxonomy->labels->singular_name;
                }
            }

            $item_data[] = array(
                'name' => $formatted_name,
                'value' => $value,
            );
        }
    }

    return $item_data;
}

add_filter('woocommerce_add_cart_item_data', 'add_custom_product_selection_to_cart_item', 10, 3);

function add_custom_product_selection_to_cart_item($cart_item_data, $product_id, $variation_id)
{
    if (!empty($_POST['selected_attributes'])) {
        $cart_item_data['custom_attributes'] = $_POST['selected_attributes'];
    }

    return $cart_item_data;
}

add_filter('woocommerce_get_item_data', 'display_custom_attributes_in_cart', 10, 2);

function display_custom_attributes_in_cart($item_data, $cart_item)
{
    if (isset($cart_item['custom_attributes'])) {
        foreach ($cart_item['custom_attributes'] as $attribute => $value) {
            $item_data[] = array(
                'name' => $attribute,
                'value' => $value,
            );
        }
    }
    return $item_data;
}


add_action('woocommerce_checkout_create_order_line_item', 'save_custom_attributes_to_order_items', 10, 4);

function save_custom_attributes_to_order_items($item, $cart_item_key, $values, $order)
{
    if (!empty($values['custom_attributes'])) {
        foreach ($values['custom_attributes'] as $attribute => $value) {
            $item->add_meta_data($attribute, $value);
        }
    }
}

/*
 ****************************************************************
 * NOTICES    // Now you can use $location_label without worrying about undefined array keys
 ****************************************************************
*/
// Remove the notices from their original location
remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);

// Add the notices back, but before the checkout form specifically
add_action('woocommerce_before_checkout_form', 'custom_woocommerce_output_all_notices', 40);

function custom_woocommerce_output_all_notices()
{
    if (function_exists('wc_print_notices')) {
        wc_print_notices();
    }
}
/*
 ****************************************************************
 * Fix to allow us to use $location_label without worrying about undefined array keys
 ****************************************************************
*/
add_filter('some_plugin_filter_before_lookup', function ($lookup_data) {
    if (isset($lookup_data['state']) && $lookup_data['state'] === 'IE21' && !isset($states[$lookup_data['state']])) {
        // Handle the missing 'IE21' key scenario, maybe default to a fallback or correct the data
        $lookup_data['state'] = '';
    }
    return $lookup_data;
});
