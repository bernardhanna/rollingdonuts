<?php

add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'woocommerce_analytics_dashboard_widget',          // Widget slug.
        'WooCommerce Analytics',                           // Title.
        'display_woocommerce_analytics_dashboard_widget'   // Display function.
    );
});

function display_woocommerce_analytics_dashboard_widget()
{
    if (!current_user_can('manage_woocommerce')) {
        echo 'You do not have sufficient permissions to access this page.';
        return;
    }

    $total_sales_today = wc_get_total_sales('today');
    $total_orders_today = wc_get_order_count('today');

    echo '<p><strong>Total Sales Today:</strong> ' . wc_price($total_sales_today) . '</p>';
    echo '<p><strong>Total Orders Today:</strong> ' . $total_orders_today . '</p>';

    // Link to WooCommerce Analytics page
    echo '<p><a href="admin.php?page=wc-admin&path=%2Fanalytics%2Foverview" class="button button-primary">View Detailed Analytics</a></p>';
}


function wc_get_total_sales($period = 'today')
{
    global $wpdb;
    $date_today = date('Y-m-d');

    // Query the sum of all totals from today's orders
    $total_sales = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(meta_value)
        FROM {$wpdb->postmeta} pm
        INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
        WHERE pm.meta_key = '_order_total'
        AND p.post_type = 'shop_order'
        AND DATE(p.post_date) = %s
        AND p.post_status IN ('wc-completed', 'wc-processing')
    ", $date_today));

    return $total_sales ?: 0;
}

function wc_get_order_count($period = 'today')
{
    global $wpdb;
    $date_today = date('Y-m-d');

    // Query the count of all orders from today
    $order_count = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->posts} p
        WHERE p.post_type = 'shop_order'
        AND DATE(p.post_date) = %s
        AND p.post_status IN ('wc-completed', 'wc-processing')
    ", $date_today));

    return $order_count ?: 0;
}

function add_custom_dashboard_widgets()
{
    wp_add_dashboard_widget(
        'custom_link_widget', // Widget slug.
        'Quick Links', // Title.
        'custom_dashboard_links' // Display function.
    );
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

function custom_dashboard_links()
{
    if (!current_user_can('manage_options')) {
        echo 'You do not have sufficient permissions to access these pages.';
        return;
    }

    // Link to Future Orders
    $future_orders_url = admin_url('admin.php?page=mt-future-orders');
    echo '<div class="custom_dashboard_link">';
    echo '<p>Quickly access and manage future orders:</p>';
    echo '<a href="' . esc_url($future_orders_url) . '" class="button button-primary">View Future Orders</a>';
    echo '</div>';

    // Link to Theme Options
    $theme_options_url = admin_url('admin.php?page=theme-options');
    echo '<div class="custom_dashboard_link">';
    echo '<p>Manage your theme settings:</p>';
    echo '<a href="' . esc_url($theme_options_url) . '" class="button button-primary">Theme Options</a>';
    echo '</div>';

    // Link to Menu Options
    $menu_options_url = admin_url('nav-menus.php');
    echo '<div class="custom_dashboard_link">';
    echo '<p>Edit the Header Menu</p>';
    echo '<a href="' . esc_url($menu_options_url) . '" class="button button-primary">Menu Options</a>';
    echo '</div>';
}

add_action('wp_dashboard_setup', 'add_pickup_location_dashboard_widgets');
add_action('wp_dashboard_setup', 'add_pickup_location_dashboard_widgets');

function add_pickup_location_dashboard_widgets()
{
    wp_add_dashboard_widget(
        'woocommerce_orders_by_location_widget',          // Widget slug.
        'WooCommerce Orders by Location',                 // Title.
        'display_orders_by_location_widget'               // Display function.
    );
}

function display_orders_by_location_widget()
{
    if (!current_user_can('manage_woocommerce')) {
        echo 'You do not have sufficient permissions to access this page.';
        return;
    }

    $locations = [
        'Liffey Valley' => 'edit.php?s&post_status=all&post_type=shop_order&action=-1&m=0&_customer_user&delivery_date&_pickup_location=1542&filter_action=Filter&paged=1&action2=-1',
        'Bachelors Walk' => 'edit.php?s&post_status=all&post_type=shop_order&action=-1&m=0&_customer_user&delivery_date&_pickup_location=1546&filter_action=Filter&paged=1&action2=-1',
        'South King' => 'edit.php?s&post_status=all&post_type=shop_order&action=-1&m=0&_customer_user&delivery_date&_pickup_location=1543&filter_action=Filter&paged=1&action2=-1',
        'Swords Pavilions' => 'edit.php?post_status=all&post_type=shop_order&m=0&_customer_user&delivery_date&_pickup_location=1541&filter_action=Filter&paged=1',
        'Kildare Village' => 'edit.php?post_status=all&post_type=shop_order&m=0&_customer_user&delivery_date&_pickup_location=1539&filter_action=Filter&paged=1',
        'Whitewater Newbridge' => 'edit.php?s&post_status=all&post_type=shop_order&action=-1&m=0&_customer_user&delivery_date&_pickup_location=1521&filter_action=Filter&paged=1&action2=-1',
    ];

    echo '<div class="custom_dashboard_links" style="margin-top: 20px;">';
    foreach ($locations as $location_name => $url) {
        echo '<p style="display: flex; justify-content: space-between; align-items: center; "><strong>' . esc_html($location_name) . ':</strong> <a href="' . esc_url(admin_url($url)) . '" class="button button-primary">View Orders</a></p>';
    }
    echo '</div>';
}


add_action('wp_dashboard_setup', 'add_quick_content_dashboard_widget');

function add_quick_content_dashboard_widget()
{
    wp_add_dashboard_widget(
        'quickly_add_content_widget',       // Widget slug.
        'Quickly Add Content',              // Title.
        'display_quick_content_widget'      // Display function.
    );
}

function display_quick_content_widget()
{
    if (!current_user_can('edit_posts')) {
        echo 'You do not have sufficient permissions to access this page.';
        return;
    }

    // Associative array of content types and their respective admin URLs
    $content_types = [
        'Add a new Product' => 'post-new.php?post_type=product',
        'Add a new Blog Post' => 'post-new.php',
        'Add a new FAQ' => 'post-new.php?post_type=faq',
        'Add a new Allergen' => 'post-new.php?post_type=allergen',
        'Add a new Shop Location' => 'post-new.php?post_type=location',
        'Add a new Testimonial' => 'post-new.php?post_type=testimonial',
        'Add a new Page' => 'post-new.php?post_type=page'
    ];

    echo '<div class="quickly-add-content-links">';
    foreach ($content_types as $label => $url) {
        echo '<p><a href="' . esc_url(admin_url($url)) . '" class="button button-primary">' . esc_html($label) . '</a></p>';
    }
    echo '</div>';
}
