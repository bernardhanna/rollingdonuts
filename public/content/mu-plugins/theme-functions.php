<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-24 14:54:58
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-10 09:52:28
 */

/*
Plugin Name: `Rolling Donut Theme Functions`
Description: Keeping our functions.php clean
Version: 1.0
Author: Bernard Hanna@
*/
// Edit bnackend Styles
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
    </style>';
}
add_action('admin_head', 'custom_admin_styles');

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
});

