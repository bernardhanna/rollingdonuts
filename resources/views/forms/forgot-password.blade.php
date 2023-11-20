<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 11:50:03
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 11:51:15
 */
?>
<div x-show="showLostPassword">
    <form method="post" class="woocommerce-ResetPassword lost_reset_password">
        <p class="my-4" ><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>
        <label class="ml-2 text-mob-xs-font font-reg420" for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
        <div class="relative woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"><path fill="#484848" d="M9.993 10.573a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9ZM10 0a6 6 0 0 1 3.04 11.174c3.688 1.11 6.458 4.218 6.955 8.078c.047.367-.226.7-.61.745c-.383.045-.733-.215-.78-.582c-.54-4.19-4.169-7.345-8.57-7.345c-4.425 0-8.101 3.161-8.64 7.345c-.047.367-.397.627-.78.582c-.384-.045-.657-.378-.61-.745c.496-3.844 3.281-6.948 6.975-8.068A6 6 0 0 1 10 0Z"></path></svg>
      </div>
            <input required class="woocommerce-Input woocommerce-Input--text input-text oocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
    text-mob-xs-font font-laca font-light pl-11 flex w-full" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="<?php esc_attr_e('Enter Username or Password', 'woocommerce'); ?>" />
        </div>

        <?php do_action( 'woocommerce_lostpassword_form' ); ?>

        <div class="woocommerce-form-row form-row mt-8">
            <input required class="woocommerce-Input woocommerce-Input--text input-tex rounded-lg-x h-input text-black-secondary
    text-mob-xs-font font-laca font-light pl-11 flex w-full" type="hidden" name="wc_reset_password" value="true" />
            <button type="submit" class="woocommerce-Button button btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium py-3 bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary mb-4 woocommerce-button button woocommerce-form-login__submit" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
        </div>
        <a class="flex justify-center text-center w-full underline hover:no-underline woocommerce-LostPassword lost_password text-mob-xs-font font-reg420" href="#" @click.prevent="showLostPassword = false">Back to Sign in</a>
        <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
    </form>
</div>
