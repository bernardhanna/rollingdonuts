<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-10 15:00:54
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 16:20:56
 */

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form');
?>
<div class="mx-auto px-4 pb-24 lg:max-w-max-848">
    <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
        <div class="border-black-full border-2 border-solid rounded-[10px] laptop:rounded-md-32 pt-10 pb-10 px-0 mobile:px-4 laptop:px-0" x-data="{ activeTab: 'sign-in', showLostPassword: false }">
            <div class="text-sm font-medium text-center">
                <ul class="flex flex-wrap -mb-px text-md-font font-reg420 signin-tabs pb-2 ml-auto mr-auto lg:w-[639px]">
                    <li class="w-1/2 relative">
                        <a id="signInTab" href="#"
                            @click="activeTab = 'sign-in'; showLostPassword = false"
                            :class="{ 'active-tab': activeTab === 'sign-in', 'inactive-tab': activeTab !== 'sign-in' }"
                            x-text="showLostPassword ? 'Forgot Password' : 'Sign In'">
                        </a>
                    </li>
                    <li class="w-1/2 relative">
                        <a id="registerTab" href="#"
                            @click="activeTab = 'register'; showLostPassword = false"
                            :class="{ 'active-tab': activeTab === 'register', 'inactive-tab': activeTab !== 'register' }">
                            Register
                        </a>
                    </li>
                </ul>
            </div>

            <div>
            <!-- Sign In Form -->
            <form
            class="w-full m-auto max-w-max-704 px-4 mobile:px-0"
            x-show="activeTab === 'sign-in' && !showLostPassword"
            method="post"
            action="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
            <!-- Email/Username Input -->
            <div class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide pt-9 w-full max-w-max-704 ml-auto mr-auto">
                <label class="ml-2 text-mob-xs-font font-reg420" for="username"><?php esc_html_e('Email*', 'woocommerce'); ?></label>
                <div class="relative mb-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"></path></svg>
              </div>
                <input required type="email" class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('Email*', 'woocommerce'); ?>" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide pt-4 w-full max-w-max-704 ml-auto mr-auto">
                <label class="ml-2 text-mob-xs-font font-reg420" for="password"><?php esc_html_e('Password', 'woocommerce'); ?></label>
                <div class="relative mb-2">
                <div x-data="{ showPassword: false }" @click="showPassword = !showPassword" class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path x-show="!showPassword" fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"></path></svg>
              </div>
                <input required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_attr_e('Enter Password', 'woocommerce'); ?>" />
             </div>
            </div>

              <!-- Forgot Password Link -->
              <div class="form-row ml-2 mb-2  w-full max-w-max-704 relative text-right mobile:text-left max-mobile:right-4 max-mobile:pt-4">
                <p class="woocommerce-LostPassword lost_password text-mob-xs-font font-reg420">
                    <a class="underline hover:no-underline" href="#" @click.prevent="showLostPassword = true"><?php esc_html_e('Forgot your password?', 'woocommerce'); ?></a>
                </p>
             </div>

            <!-- Remember Me Checkbox -->
            <div class="form-row ml-2 mb-2 w-full max-w-max-704">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme flex">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox bg-white mr-2 h-[20px] w-[20px] flex flex-col rounded-sm border-2 border-solid border-grey-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span class="text-sm-font font-regular"><?php esc_html_e('Keep me signed in', 'woocommerce'); ?></span>
                </label>
            </div>

            <!-- Nonce Field -->
            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

            <!-- Submit Button -->
            <button
                x-ref="submitBtn"
                class="btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[52px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary woocommerce-button button woocommerce-form-login__submit ml-auto mr-auto max-w-max-704 mt-6"
                type="submit"
                name="login"
                value="<?php esc_attr_e('Sign in', 'woocommerce'); ?>"><?php esc_html_e('Sign in', 'woocommerce'); ?>
            </button>

                <!-- Register Link -->
            <div class="form-row text-center pt-4">
                <p class="font-laca text-sm-font font-light text-black-full"><?php esc_html_e("Don't Have an Account?"); ?>
                    <a class="underline hover:no-underline" href="#" @click="activeTab = 'register'"><?php esc_html_e('Register', 'woocommerce'); ?>
                    </a>
                </p>
            </div>

            </form>

        </div>
        <div x-show="showLostPassword">
            <form method="post" class="woocommerce-ResetPassword lost_reset_password max-w-max-704 ml-auto mr-auto px-4 mobile:px-0">
                <p class="my-4" ><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>
                <label class="ml-2 text-mob-xs-font font-reg420" for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
                <div class="relative woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"><path fill="#484848" d="M9.993 10.573a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9ZM10 0a6 6 0 0 1 3.04 11.174c3.688 1.11 6.458 4.218 6.955 8.078c.047.367-.226.7-.61.745c-.383.045-.733-.215-.78-.582c-.54-4.19-4.169-7.345-8.57-7.345c-4.425 0-8.101 3.161-8.64 7.345c-.047.367-.397.627-.78.582c-.384-.045-.657-.378-.61-.745c.496-3.844 3.281-6.948 6.975-8.068A6 6 0 0 1 10 0Z"></path></svg>
              </div>
                    <input required class="woocommerce-Input woocommerce-Input--text input-text oocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="<?php esc_attr_e('Enter Username or Password', 'woocommerce'); ?>" />
                </div>

                <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                <div class="woocommerce-form-row form-row mt-8">
                    <input required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full" type="hidden" name="wc_reset_password" value="true" />
                    <button type="submit" class="woocommerce-Button button btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[52px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary mb-4 woocommerce-button button woocommerce-form-login__submit" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
                </div>
                <a class="flex justify-center text-center w-full underline hover:no-underline woocommerce-LostPassword lost_password text-mob-xs-font font-reg420" href="#" @click.prevent="showLostPassword = false">Back to Sign in</a>
                <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
            </form>
        </div>

        <div x-show="activeTab === 'register'">
            <!-- Register Form -->
            <form method="post" class="woocommerce-form woocommerce-form-register register max-w-max-564 ml-auto mr-auto pt-9 px-4 mobile:px-0" <?php do_action('woocommerce_register_form_tag'); ?> >

            <?php do_action('woocommerce_register_form_start'); ?>

            <!-- First name and Last name Input -->
            <div class="flex flex-wrap pt-4 mb-2 macbook:justify-between">
                <div class="w-full macbook:w-[256px]">
                    <label class="ml-2 text-mob-xs-font font-reg420" for="reg_first_name"><?php esc_html_e('First Name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" required class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('First name*', 'woocommerce'); ?>" name="first_name" id="reg_first_name" autocomplete="given-name" />
                </div>
                <div class="w-full macbook:w-[256px]">
                    <label for="reg_last_name" class="text-mob-xs-font font-reg420"><?php esc_html_e('Last Name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" required class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('Surname*', 'woocommerce'); ?>" name="last_name" id="reg_last_name" autocomplete="family-name" />
                </div>
            </div>

            <!-- Email Input -->
            <div class="pt-4 mb-2">
                <label for="reg_email" class="ml-2 text-mob-xs-font font-reg420"><?php esc_html_e('Email Address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                <input type="email" required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('Email*', 'woocommerce'); ?>" name="email" id="reg_email" autocomplete="email" />
            </div>

            <!-- Set Password Input -->
            <div class="pt-4 mb-2">
                <label for="reg_password" class="ml-2 text-mob-xs-font font-reg420"><?php esc_html_e('Set Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                <input type="password" required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('Password*', 'woocommerce'); ?>" name="password" id="reg_password" autocomplete="new-password" />
            </div>

            <!-- Confirm Password Input -->
            <div class="pt-4 mb-2">
                <label for="confirm_password" class="ml-2 text-mob-xs-font font-reg420"><?php esc_html_e('Confirm Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                <input type="password" required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full border-grey-input" placeholder="<?php esc_attr_e('Confirm Password*', 'woocommerce'); ?>" name="confirm_password" id="confirm_password" />
            </div>

            <!-- Checkbox for data handling -->
            <div class="pt-4 mb-2">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme flex">
                    <input required class="woocommerce-form__input woocommerce-form__input-checkbox bg-white mr-2 h-[20px] w-[20px] border-grey-input flex flex-col rounded-sm border-2 border-solid" type="checkbox" name="privacy_agreement" id="privacy_agreement" />
                    <span class="text-mob-xs-font font-regular"><?php esc_html_e('I agree with the handling of my data in accordance with the company privacy policy.', 'woocommerce'); ?></span>
                </label>
            </div>

            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

            <!-- Submit/Register Button -->
            <button
                type="submit"
                class="btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[52px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary mt-4 mb-4 woocommerce-button button woocommerce-form-register__submit"
                name="register"
                value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                <?php esc_html_e('Register', 'woocommerce'); ?>
            </button>

            <!-- Already have an account Link -->
            <div class="form-row text-center pt-4">
                <p class="font-laca text-sm-font font-light text-black-full"><?php esc_html_e('Already have an account?', 'woocommerce'); ?>
                    <a class="underline hover:no-underline" href="#" @click="activeTab = 'sign-in'"><?php esc_html_e('Login', 'woocommerce'); ?></a>
                </p>
            </div>

            <?php do_action('woocommerce_register_form_end'); ?>

        </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php do_action('woocommerce_after_customer_login_form'); ?>
