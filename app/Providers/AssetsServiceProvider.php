<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-18 16:20:29
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
            wp_enqueue_style('glide-one', 'https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.core.css', array(), null);
            wp_enqueue_style('glide-two', 'https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.theme.min.css', array(), null);
            wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), null);
            wp_enqueue_style('edmondsans', 'https://fonts.cdnfonts.com/css/edmondsans', false);
            wp_enqueue_style('laca', 'https://fonts.cdnfonts.com/css/laca?styles=51511,51510,51505,51504,51507,51506,51503,51502,51509,51508,51513,51512,51501,51500,51499,51498', false);
            remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
            bundle('app')->enqueue();
        }, 1);

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
