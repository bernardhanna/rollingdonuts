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
    $breadcrumb = '<nav class="pt-4 breadcrumb-nav">';
    $lastIndex = count($links) - 1;

    foreach ($links as $index => $link) {
        $isLastItem = ($index === $lastIndex);
        $colorClass = $isLastItem ? 'text-yellow-primary font-bolder' : 'text-white';

        $breadcrumb .= '<span class="text-white breadcrumb-item"><a class="' . $colorClass . 'font-medium font-laca text-sm-font" href="' . esc_url($link['url']) . '">' . esc_html($link['text']) . '</a></span>';

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
          .hide-in-delivery { display: none; }
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
        'prev_text' => '<span class="pagination-prev"><i class="mr-2 fa-solid fa-chevron-left text-xxs-font text-grey-subdued"></i> Prev</span>',
        'next_text' => '<span class="pagination-next">Next <i class="ml-2 fa-solid fa-chevron-right text-xxs-font text-grey-subdued"></i></span>',
        'add_args' => false,
        'add_fragment' => '',
    ));

    if (is_array($pages)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="flex flex-row items-center justify-center w-full pt-20 pagination">';
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

//ADMIN CLEAN UP:

function plt_hide_wp_mail_smtp_menus()
{
    //Hide "WP Mail SMTP".
    remove_menu_page('wp-mail-smtp');
    //Hide "WP Mail SMTP → Settings".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp');
    //Hide "WP Mail SMTP → Email Log".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-logs');
    //Hide "WP Mail SMTP → Email Reports".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-reports');
    //Hide "WP Mail SMTP → Tools".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-tools');
    //Hide "WP Mail SMTP → About Us".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-about');
    //Hide "WP Mail SMTP → Upgrade to Pro".
    remove_submenu_page('wp-mail-smtp', 'https://wpmailsmtp.com/lite-upgrade/?utm_source=WordPress&utm_medium=admin-menu&utm_campaign=liteplugin&utm_locale=en_us&utm_content=Upgrade%20to%20Pro');
}

add_action('admin_menu', 'plt_hide_wp_mail_smtp_menus', 2147483647);

function plt_hide_pixelyoursite_menus()
{
    //Hide "PixelYourSite".
    remove_menu_page('pixelyoursite');
    //Hide "PixelYourSite → Dashboard".
    remove_submenu_page('pixelyoursite', 'pixelyoursite');
    //Hide "PixelYourSite → UTM Builder".
    remove_submenu_page('pixelyoursite', 'pixelyoursite_utm');
    //Hide "PixelYourSite → System Report".
    remove_submenu_page('pixelyoursite', 'pixelyoursite_report');
}

add_action('admin_menu', 'plt_hide_pixelyoursite_menus', 11);

function plt_hide_advanced_custom_fields_menus()
{
    //Hide "ACF".
    remove_menu_page('edit.php?post_type=acf-field-group');
    //Hide "ACF → Field Groups".
    remove_submenu_page('edit.php?post_type=acf-field-group', 'edit.php?post_type=acf-field-group');
    //Hide "ACF → Post Types".
    remove_submenu_page('edit.php?post_type=acf-field-group', 'edit.php?post_type=acf-post-type');
    //Hide "ACF → Taxonomies".
    remove_submenu_page('edit.php?post_type=acf-field-group', 'edit.php?post_type=acf-taxonomy');
    //Hide "ACF → Options Pages".
    remove_submenu_page('edit.php?post_type=acf-field-group', 'acf_options_preview');
    //Hide "ACF → Tools".
    remove_submenu_page('edit.php?post_type=acf-field-group', 'acf-tools');
}

add_action('admin_menu', 'plt_hide_advanced_custom_fields_menus', 21);

function plt_hide_wordpress_seo_menus()
{
    //Hide "Yoast SEO".
    remove_menu_page('wpseo_dashboard');
    //Hide "Yoast SEO → General".
    remove_submenu_page('wpseo_dashboard', 'wpseo_dashboard');
    //Hide "Yoast SEO → Settings".
    remove_submenu_page('wpseo_dashboard', 'wpseo_page_settings');
    //Hide "Yoast SEO → Integrations".
    remove_submenu_page('wpseo_dashboard', 'wpseo_integrations');
    //Hide "Yoast SEO → Tools".
    remove_submenu_page('wpseo_dashboard', 'wpseo_tools');
    //Hide "Yoast SEO → Academy".
    remove_submenu_page('wpseo_dashboard', 'wpseo_page_academy');
    //Hide "Yoast SEO → Premium".
    remove_submenu_page('wpseo_dashboard', 'wpseo_licenses');
    //Hide "Yoast SEO → Workouts".
    remove_submenu_page('wpseo_dashboard', 'wpseo_workouts');
    //Hide "Yoast SEO → Redirects".
    remove_submenu_page('wpseo_dashboard', 'wpseo_redirects');
    //Hide "Yoast SEO → Support".
    remove_submenu_page('wpseo_dashboard', 'wpseo_page_support');
}

add_action('admin_menu', 'plt_hide_wordpress_seo_menus', 12);

function plt_hide_mailpoet_menus()
{
    //Hide "Tools → Scheduled Actions".
    remove_submenu_page('tools.php', 'action-scheduler');

    //Hide "MailPoet".
    remove_menu_page('mailpoet-homepage');
    //Hide "MailPoet → Home".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-homepage');
    //Hide "MailPoet → Emails".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-newsletters');
    //Hide "MailPoet → Automations".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-automation');
    //Hide "MailPoet → Forms".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-forms');
    //Hide "MailPoet → Subscribers".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-subscribers');
    //Hide "MailPoet → Lists".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-lists');
    //Hide "MailPoet → Segments".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-segments');
    //Hide "MailPoet → Settings".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-settings');
    //Hide "MailPoet → Help".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-help');
    //Hide "MailPoet → Upgrade".
    remove_submenu_page('mailpoet-homepage', 'mailpoet-upgrade');
}

add_action('admin_menu', 'plt_hide_mailpoet_menus', 11);

function plt_hide_insta_gallery_menus()
{
    //Hide "Social Feed Gallery".
    remove_menu_page('qligg_backend');
    //Hide "Social Feed Gallery → Welcome".
    remove_submenu_page('qligg_backend', 'qligg_backend');
    //Hide "Social Feed Gallery → Accounts".
    remove_submenu_page('qligg_backend', 'qligg_backend&tab=accounts');
    //Hide "Social Feed Gallery → Feeds".
    remove_submenu_page('qligg_backend', 'qligg_backend&tab=feeds');
    //Hide "Social Feed Gallery → Settings".
    remove_submenu_page('qligg_backend', 'qligg_backend&tab=settings');
    //Hide "Social Feed Gallery → Premium".
    remove_submenu_page('qligg_backend', 'qligg_backend&tab=premium');
}

add_action('admin_menu', 'plt_hide_insta_gallery_menus', 11);
