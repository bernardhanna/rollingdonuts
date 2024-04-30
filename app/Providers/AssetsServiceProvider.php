<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 09:41:48
 */


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use function Roots\bundle;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Register assets services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register the theme assets.
         *
         * @return void
         */

         add_action('wp_enqueue_scripts', function (): void {

            if (!is_cart() && !is_checkout() || is_wc_endpoint_url('order-received')) {
                // Dequeue WooCommerce styles
                wp_dequeue_style('woocommerce-general');
                wp_dequeue_style('woocommerce-layout');
                wp_dequeue_style('woocommerce-smallscreen');
            } else {
                // This is either cart or checkout page but not the thank you page, re-enqueue necessary styles
                wp_enqueue_style('woocommerce-general');
                wp_enqueue_style('woocommerce-layout');
                wp_enqueue_style('woocommerce-smallscreen');
            }
            // Conditionally enqueue Leaflet.js and Leaflet.css for a specific template
            if (is_page_template('templates/template-locations.blade.php')) {
                wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), null);
                wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, true);
            }
            if (is_product() || is_shop() || is_product_category()) {
                wp_enqueue_script('wc-add-to-cart-variation');
            }

            wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), null);
            wp_enqueue_style('edmondsans', 'https://fonts.cdnfonts.com/css/edmondsans', false);
            wp_enqueue_style('laca', 'https://fonts.cdnfonts.com/css/laca?styles=51511,51510,51505,51504,51507,51506,51503,51502,51509,51508,51513,51512,51501,51500,51499,51498', false);
            //wp_dequeue_script('wooextbox-main-js');
            remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
            bundle('app')->enqueue();
        }, 9999);


        /**
         * Register the theme assets with the block editor.
         *
         * @return void
         */
        //add_action('enqueue_block_editor_assets', function (): void {
         //   bundle('editor')->enqueue();

        /**
         * Add the type="module" attribute to script tags that have the .mjs extension.
         *
         * @param  string $tag
         * @return string
         */
        add_filter('script_loader_tag', function (string $tag): string {
            $hasModuleExtension = str_contains($tag, '.mjs"');

            $hasModuleAttribute = ! empty(array_filter(
                ['type="module"', 'type=module', "type='module'"],
                fn ($value) => str_contains($tag, $value)
            ));

            if (! $hasModuleExtension || $hasModuleAttribute) {
                return $tag;
            }

            return str_replace(' src=', ' type=module src=', $tag);
        }, 10, 2);

        /**
         * Remove default theme.json styles.
         *
         * @link   https://developer.wordpress.org/block-editor/reference-guides/filters/global-styles-filters/
         * @return void
         */
        add_action('after_setup_theme', function (): void {
            if (is_admin()) {
                return;
            }

            add_filter('wp_theme_json_data_default', function (\WP_Theme_JSON_Data $theme_json) {
                return new \WP_Theme_JSON_Data([]);
            });
        });
    }
}
