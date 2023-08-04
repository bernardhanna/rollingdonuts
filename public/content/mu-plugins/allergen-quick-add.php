<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-03 12:48:15
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 16:50:17
 */
/**
 * Plugin Name: Allergen Quick Add
 * Description: Quickly add an Allergen with just title and featured image.
 */

// Prevent direct access
defined('ABSPATH') || exit;

// Enqueue our custom script on the Allergen post type listing page
add_action('admin_enqueue_scripts', 'enqueue_allergen_quick_add_scripts');
function enqueue_allergen_quick_add_scripts($hook) {
    global $post_type;

    if ($hook == 'edit.php' && $post_type == 'allergen') {
        wp_enqueue_script('allergen-quick-add', plugin_dir_url(__FILE__) . 'allergen-quick-add.js', ['jquery', 'media-upload', 'thickbox'], null, true);
        wp_enqueue_style('thickbox');
        wp_localize_script('allergen-quick-add', 'allergenQuickAdd', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('allergen_quick_add_nonce')
        ]);
    }
}


// AJAX handler to add the new allergen
add_action('wp_ajax_allergen_quick_add', 'handle_allergen_quick_add');
function handle_allergen_quick_add() {
    check_ajax_referer('allergen_quick_add_nonce');

    $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $thumbnail_id = isset($_POST['thumbnail_id']) ? absint($_POST['thumbnail_id']) : 0;

    $allergen_id = wp_insert_post([
        'post_title' => $title,
        'post_type' => 'allergen',
        'post_status' => 'publish'
    ]);

    if ($thumbnail_id) {
        set_post_thumbnail($allergen_id, $thumbnail_id);
    }

    wp_send_json_success(['message' => 'Allergen added successfully!']);
}

// Prevent accessing the default post editor screen for Allergen
add_action('load-post.php', 'prevent_allergen_edit_screen');
add_action('load-post-new.php', 'prevent_allergen_edit_screen');
function prevent_allergen_edit_screen() {
    global $post_type;

    if ('allergen' === $post_type) {
        wp_redirect(admin_url('edit.php?post_type=allergen'));
        exit;
    }
}
