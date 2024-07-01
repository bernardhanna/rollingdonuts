<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-03 12:48:15
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-04 10:46:24
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

add_filter('manage_allergen_posts_columns', 'add_allergen_image_column');
function add_allergen_image_column($columns) {
    $columns['featured_image'] = 'Allergen Icon';
    return $columns;
}

add_action('manage_allergen_posts_custom_column', 'display_allergen_image_column', 10, 2);
function display_allergen_image_column($column_name, $post_id) {
    if ('featured_image' === $column_name) {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
}

add_action('save_post', 'save_allergen_icon');
function save_allergen_icon($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['allergen_featured_image_nonce']) || !wp_verify_nonce($_POST['allergen_featured_image_nonce'], 'allergen_featured_image_nonce')) {
        return $post_id;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Check for the 'allergen_featured_image' post value and save if present
    if (isset($_POST['allergen_featured_image'])) {
        $thumbnail_id = $_POST['allergen_featured_image'];
        set_post_thumbnail($post_id, $thumbnail_id);
    }

    return $post_id;
}

add_action('quick_edit_custom_box', 'add_quick_edit', 10, 2);
function add_quick_edit($column_name, $post_type) {
    if ($column_name != 'featured_image') return;
    if ($post_type == 'allergen') {
        $post_id = get_the_ID();
        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'thumbnail')[0] ?? '';
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label>
                    <span class="title">Allergen Icon</span>
                    <span class="input-text-wrap" style="display: flex; flex-direction: column; align-items: flex-start;">
                        <input type="button" class="button button-primary" id="set_featured_image" value="Change Icon Image">
                        <input type="hidden" name="allergen_featured_image" id="allergen_featured_image" data-thumbnail-url="">
                        <img id="allergen_featured_preview" style="max-width: 100%; margin-top: 10px;" src="<?php echo esc_url($image_url); ?>" alt="Allergen Icon Preview">
                    </span>
                </label>
                <?php
                // Adding nonce field for added security
                wp_nonce_field('allergen_featured_image_nonce', 'allergen_featured_image_nonce');
                ?>
            </div>
        </fieldset>
        <?php
    }
}

add_action('admin_enqueue_scripts', 'enqueue_quick_edit_scripts');
function enqueue_quick_edit_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('quick-edit-script', plugin_dir_url(__FILE__) . 'allergen-quick-add.js', array('jquery', 'media-upload'), null, true);
}
