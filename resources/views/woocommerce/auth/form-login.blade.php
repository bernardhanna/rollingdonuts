<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 13:57:14
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 14:58:34
 */
?>
{{--
Auth form login.

This template can be overridden by copying it to yourtheme/woocommerce/auth/form-login.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce\Templates\Auth
@version 7.0.1
--}}

@if (!defined('ABSPATH'))
    {{ exit() }}
@endif

@php
    do_action('woocommerce_auth_page_header');
@endphp

<h1 class="text-left">
    {{ sprintf(esc_html__('%s would like to connect to your store', 'woocommerce'), esc_html($app_name)) }}
</h1>

@php
    wc_print_notices();
@endphp

<p>
    {!! sprintf(__('To connect to %1$s you need to be logged in. Log in to your store below, or <a href="%2$s">cancel and return to %1$s</a>', 'woocommerce'), esc_html(wc_clean($app_name)), esc_url($return_url)) !!}
</p>


<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px">
        <li class="mr-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Profile</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Dashboard</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Settings</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Contacts</a>
        </li>
        <li>
            <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
        </li>
    </ul>
</div>


@php
    do_action('woocommerce_auth_page_footer');
@endphp
