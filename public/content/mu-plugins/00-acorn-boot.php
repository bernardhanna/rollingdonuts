<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-08 15:07:16
 */


if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this site.', 'rollingdonuts'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'rollingdonuts'),
        ]
    );
}

//\Roots\bootloader()->boot();
add_action('after_setup_theme', fn () => \Roots\bootloader()->boot());

