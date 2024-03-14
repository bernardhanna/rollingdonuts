<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 16:19:38
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 16:27:38
 */

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account w-full" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

    <?php do_action('woocommerce_edit_account_form_start'); ?>
    <div class="w-full flex flex-flow flex-col  mobile:flex-row mb-4 gap-3">
        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-full lg:w-1/2">
            <label class="ml-2 text-mob-xs-font font-reg420" for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text  rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" placeholder="<?php esc_attr_e('First Name', 'woocommerce'); ?>" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last w-full lg:w-1/2">
            <label class="ml-2 text-mob-xs-font font-reg420" for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" placeholder="<?php esc_attr_e('Surname', 'woocommerce'); ?>" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
        </p>
    </div>
    <div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide ">
        <label class="ml-2 text-mob-xs-font font-reg420" for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input placeholder="<?php esc_attr_e('Email Address', 'woocommerce'); ?>" type="email" class="woocommerce-Input woocommerce-Input--email input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
    </p>
    <div class="bg-grey-background p-4 mobile:py-10 mobile:px-8 my-12 rounded-20px">
        <fieldset>
            <legend class="text-md-font font-reg420"><?php esc_html_e('Password change', 'woocommerce'); ?></legend>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                <label class="ml-2 text-mob-xs-font font-reg420" for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                <input placeholder="<?php esc_attr_e('Password', 'woocommerce'); ?>" type="password" class="woocommerce-Input woocommerce-Input--password input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" name="password_current" id="password_current" autocomplete="off" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-4">
                <label class="ml-2 text-mob-xs-font font-reg420" for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                <input placeholder="<?php esc_attr_e('Password', 'woocommerce'); ?>" type="password" class="woocommerce-Input woocommerce-Input--password  rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" name="password_1" id="password_1" autocomplete="off" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide ">
                <label class="ml-2 text-mob-xs-font font-reg420" for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
                <input placeholder="<?php esc_attr_e('Password', 'woocommerce'); ?>" type="password" class="woocommerce-Input woocommerce-Input--password input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full" name="password_2" id="password_2" autocomplete="off" />
            </p>
        </fieldset>
    </div>
    <div class="clear"></div>

    <?php do_action('woocommerce_edit_account_form'); ?>

    <p>
        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
        <button type="submit" class="btn  text-yellow-primary hover:text-black-full text-mob-lg-font lg:text-sm-md-font font-medium py-3 bg-black-full hover:bg-primary-yellow rounded-lg-x w-full lg:w-1/2 hover:bg-yellow-primary mb-4 border-solid border-2 border-yellow-primary hover:border-black-full woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
        <input type="hidden" name="action" value="save_account_details" />
    </p>

    <?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>