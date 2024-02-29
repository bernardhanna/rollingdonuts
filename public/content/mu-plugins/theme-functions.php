<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-24 14:54:58
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 17:19:00
 */

/*
Plugin Name: `Rolling Donut Theme Functions`
Description: Keeping our functions.php clean
Version: 1.0
Author: Bernard Hanna@
*/
// Yoast Breadcrumbs
add_filter('wpseo_breadcrumb_links', 'customize_yoast_breadcrumbs_links');

function customize_yoast_breadcrumbs_links($links) {

    if (should_remove_breadcrumbs()) {
        return [];
    }

    if (is_woocommerce_related()) {
        return $links;
    }

    echo generate_breadcrumb_output($links);
    return [];
}

function should_remove_breadcrumbs() {

    return is_front_page() ||
           is_account_page() ||
           is_cart() ||
           is_checkout() ||
           is_single() ||
           is_page_template('templates/template-sitemap.blade.php');
}

function is_woocommerce_related() {
    return is_woocommerce() ||
           is_shop() ||
           is_product_category() ||
           is_product() ||
           is_page_template('templates/template-box-products.blade.php') ||
           is_page_template('templates/template-merch-products.blade.php');
}

function generate_breadcrumb_output($links) {
    $breadcrumb = '<nav class="breadcrumb-nav pt-4">';
    $lastIndex = count($links) - 1;

    foreach ($links as $index => $link) {
        $isLastItem = ($index === $lastIndex);
        $colorClass = $isLastItem ? 'text-yellow-primary font-bolder' : 'text-white';

        $breadcrumb .= '<span class="breadcrumb-item text-white"><a class="' . $colorClass . 'font-medium font-laca text-sm-font" href="' . esc_url($link['url']) . '">' . esc_html($link['text']) . '</a></span>';

        if ($index < $lastIndex) {
            $breadcrumb .= '<span class="mx-2 text-white font-laca text-sm-font"> > </span>';
        }
    }

    $breadcrumb .= '</nav>';

    return $breadcrumb;
}



//ENABLE EXCERPT ON PAGES
function enable_page_excerpt() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_page_excerpt');

//Remove The [&hellip;]
function custom_wp_trim_excerpt($text) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more = '';  // This line removes the '[&hellip;]'
        $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');


// Edit backend Styles
function custom_admin_styles() {
    echo '<style>
        /* Your custom CSS goes here */
        .wp-core-ui .button-primary {
            background: #ffed56;
            color: #000000;
        }
        .wp-core-ui .button-primary:hover {
            background: #000000;
            color: #ffed56;
        }
        .acf-settings-wrap #postbox-container-1 .postbox #major-publishing-actions #publishing-action .button {
            background-color: #ffed56;
            background-color: #ffed56!important;
        }
        .acf-settings-wrap #postbox-container-1 .postbox #major-publishing-actions #publishing-action .button:hover {
            background-color: #000000!important;
            color: #ffed56!important;
        }
        .acf-settings-wrap #postbox-container-2 .acf-postbox.seamless .inside.acf-fields.-sidebar .acf-tab-wrap.-left .acf-tab-group li.active a, .acf-settings-wrap #postbox-container-2 .acf-postbox.seamless .inside.acf-fields.-sidebar .acf-tab-wrap.-left .acf-tab-group li:focus a, .acf-settings-wrap #postbox-container-2 .acf-postbox.seamless .inside.acf-fields.-sidebar .acf-tab-wrap.-left .acf-tab-group li:hover a {
            background-color: #ffed56!important;
            color: #000000!important;
        }
        .login #login .admin-email-confirm-form .admin-email__details {
            color: #ffffff!important;
        }
    </style>';
}
add_action('admin_head', 'custom_admin_styles');

add_action('login_head', function () {
    echo '<style type="text/css">
        .login #login .admin-email-confirm-form .admin-email__details {
            font-size: .875rem;
            color: white !important;
        }
    </style>';
});

// Change Theme Options Brand colors
add_filter('acf_color_palette', function () {
  return [
    'brand' => '#000000',
    'current' => '#ffed56',
  ];
});
// Remove footer text
add_filter('admin_footer_text', '__return_false', 100);
// Login Page Branding
add_filter('login_color_palette', function () {
  return [
      'brand' => '#ffffff',
      'trim' => '#181818',
      'trim-alt' => '#ffffff',
      'login-trim' => '#000000'
  ];
});
// Login Page Text
add_filter('login_headertext', function () {
  return get_bloginfo('name');
});

// Add custom styles to the login page
add_action('login_headertext', function () {
    if (function_exists('get_field')) {
  // Retrieve the main_logo URL from the theme options
    $custom_logo_url = get_field('main_logo', 'option');

    // Check if the logo URL exists
    if ($custom_logo_url) {
        echo '<style>
                .login #login {
                margin: auto;
                padding: 0px;
                max-width: 100%;
            }
            .login #login>h1 {
            background-color: white;
            width: unset;
            height: unset;
            }
            #login h1 a, .login h1 a {
                background-image: url(' . esc_url($custom_logo_url) . ')!important;
                height: 150px!important;
                width: 320px!important;
                background-size: contain!important;
                background-repeat: no-repeat!important;
                padding-bottom: 30px;
            }
            #loginform .button-primary {
                background: #ffed56!important;
                font-weight: bold!important;
            }
            #loginform .button-primary:hover {
                background: #ffffff!important;
            }
        </style>';
    }
    }
});
//POST PAGINATION
function custom_pagination() {
    global $wp_query;
    $big = 999999999; // an unlikely integer

    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 2,
        'prev_next' => true,
        'prev_text' => '<span class="pagination-prev"><i class="fa-solid fa-chevron-left text-xxs-font text-grey-subdued mr-2"></i> Prev</span>',
        'next_text' => '<span class="pagination-next">Next <i class="ml-2 fa-solid fa-chevron-right text-xxs-font text-grey-subdued"></i></span>',
        'add_args' => false,
        'add_fragment' => '',
    ));

    if (is_array($pages)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination flex justify-center items-center w-full flex-row pt-20">';
        foreach ($pages as $page) {
            // Ensure the 'page-numbers' class is replaced with 'page-link' for consistency
            $page = str_replace('page-numbers', 'page-link', $page);
            echo "<li class=\"page-item\">$page</li>";
        }
        echo '</ul>';
        echo '</nav>';
    }
}
//BLOG FILTER
add_action('pre_get_posts', function ($query) {
    // Check if it's the main query and a category filter has been applied
    if ($query->is_main_query() && isset($_GET['category']) && is_numeric($_GET['category'])) {
        $query->set('cat', $_GET['category']);
    }
});
//READING TIME FOR POSTS
function reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 250); // Assuming 250 words per minute reading speed.
    return $reading_time;
}

// Disable Breadcrumbs in header
function disable_woocommerce_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

add_action('wp', 'disable_woocommerce_breadcrumbs');
