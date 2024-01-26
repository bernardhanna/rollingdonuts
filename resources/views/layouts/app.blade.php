<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 15:22:14
 */
?>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        @include('utils.styles')
    </head>

    <body <?php body_class('p-0 w-full'); ?>>
        <?php wp_body_open(); ?>
        <?php do_action('get_header'); ?>

        <div id="app">
            <a class="sr-only focus:not-sr-only" href="#main">
                {{ __('Skip to content') }}
            </a>

            @include('sections.header')


            <div class="{{ is_account_page() && is_user_logged_in() ? 'bg-black-full' : 'mx-auto min-h-full' }}">
                @yield('content')
            </div>


            @include('sections.footer')
        </div>

        <?php do_action('get_footer'); ?>
        <?php wp_footer(); ?>
        @include('utils.scripts')
    </body>
</html>
