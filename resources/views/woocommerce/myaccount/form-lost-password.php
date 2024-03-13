<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>
<style>
    .woocommerce-ResetPassword {
        padding: 4rem;
    }

    @media (max-width: 768px) {
        .woocommerce-ResetPassword {
            padding: 2rem;
        }
    }

    @media (max-width: 575px) {
        .woocommerce-ResetPassword {
            padding: 1rem;
        }
    }

    label {
        font-weight: bold;
        margin-left: 4px;
    }
</style>
<form method="post" class="woocommerce-ResetPassword lost_reset_password w-full max-w-max-704 mx-auto border-black-full border-2 border-solid rounded-[10px] laptop:rounded-md-32">
    <p class="text-reg-font text-black-font leading-none"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine
                                                                                                                                                                                                                                                                                            ?><p class="pt-4 woocommerce-form-row woocommerce-form-row--first form-row form-row-first"><label for="user_login  ml-2 text-mob-xs-font text-black font-bold"><?php esc_html_e('Username or email', 'woocommerce'); ?></label><input class="mt-2 rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full max-w-max-704 woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" placeholder="<?php esc_html_e('Enter Username or email', 'woocommerce'); ?>" autocomplete="username" /></p>
    <div class="clear"></div><?php do_action('woocommerce_lostpassword_form'); ?><p class="woocommerce-form-row form-row"><input type="hidden" name="wc_reset_password" value="true" /><button type="submit" class="btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[52px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary ml-auto mr-auto max-w-max-704 mt-6 woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button></p><?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>
</form><?php
        do_action('woocommerce_after_lost_password_form');
