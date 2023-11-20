<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 11:49:37
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 11:50:29
 */
?>
<form
x-show="activeTab === 'sign-in' && !showLostPassword"
method="post"
action="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
<!-- Email/Username Input -->
<div class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label class="ml-2 text-mob-xs-font font-reg420" for="username"><?php esc_html_e('Email*', 'woocommerce'); ?></label>
    <div class="relative mb-4">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"></path></svg>
  </div>
    <input required type="email" class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary
text-mob-xs-font font-laca font-light pl-11 flex w-full" placeholder="<?php esc_attr_e('Email*', 'woocommerce'); ?>" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
    </div>
</div>

<!-- Password Input -->
<div class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label class="ml-2 text-mob-xs-font font-reg420" for="password"><?php esc_html_e('Password', 'woocommerce'); ?></label>
    <div class="relative mb-6">
    <div x-data="{ showPassword: false }" @click="showPassword = !showPassword" class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path x-show="!showPassword" fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"></path></svg>
  </div>
    <input required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
text-mob-xs-font font-laca font-light pl-11 flex w-full" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_attr_e('Enter Password', 'woocommerce'); ?>" />
 </div>
</div>

  <!-- Forgot Password Link -->
  <div class="form-row ml-2 mb-2">
    <p class="woocommerce-LostPassword lost_password text-mob-xs-font font-reg420">
        <a class="underline hover:no-underline" href="#" @click.prevent="showLostPassword = true"><?php esc_html_e('Forgot your password?', 'woocommerce'); ?></a>
    </p>
 </div>

<!-- Remember Me Checkbox -->
<div class="form-row ml-2 mb-6">
    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox bg-white mr-2 h-[20px] w-[20px] rounded-sm" name="rememberme" type="checkbox" id="rememberme" value="forever" />
        <span class="text-sm-font font-regular"><?php esc_html_e('Keep me signed in', 'woocommerce'); ?></span>
    </label>
</div>

<!-- Nonce Field -->
<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

<!-- Submit Button -->
<button
    x-ref="submitBtn"
    class="btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium py-3 bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary mb-4 woocommerce-button button woocommerce-form-login__submit"
    type="submit"
    name="login"
    value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?>
</button>

    <!-- Register Link -->
<div class="form-row text-center">
    <p class="font-laca text-sm-font font-light text-black-full"><?php esc_html_e("Don't Have an Account?"); ?>
        <a class="underline hover:no-underline" href="#" @click="activeTab = 'register'"><?php esc_html_e('Register', 'woocommerce'); ?>
        </a>
    </p>
</div>

</form>
