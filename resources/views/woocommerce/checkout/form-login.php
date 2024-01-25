<?php
defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
    return;
}

// Customization starts here
?>

<div class="woocommerce-form-login-toggle xxl:w-1/2 desktop:w-[772px] w-full">
    <?php
    wc_print_notice(
        apply_filters(
            'woocommerce_checkout_login_message',
            esc_html__( 'Returning customer?', 'woocommerce' ) . ' <a href="#" class="showlogin font-bold underline">' . esc_html__( 'Click here to login', 'woocommerce' ) . '</a>'
        ),
        'notice'
    );
    ?>

    <form class="woocommerce-form woocommerce-form-login login w-full" method="post" style="display:none;">

        <p class="text-gray-700 text-lg mb-4">
            <?php esc_html_e( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woocommerce' ); ?>
        </p>

        <div class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="username" class="ml-2 text-mob-xs-font font-reg420">
                <?php esc_html_e( 'Username or email', 'woocommerce' ); ?>;
            </label>
            <div class="relative mb-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"></path></svg>
            </div>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary
text-mob-xs-font font-laca font-light pl-11 flex w-full" name="username" id="username" autocomplete="username" placeholder="<?php esc_attr_e('Email', 'woocommerce'); ?>" />
       </div>
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

        <div class="clear"></div>

        <div class="form-row mt-4">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme flex items-center">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox bg-white mr-2 h-[20px] w-[20px] rounded-sm" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span class="text-sm-font font-regular"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
            </label>
            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit bg-blue-500 p-3  btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium h-[52px] bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary woocommerce-button button woocommerce-form-login__submit ml-auto mr-auto mt-6" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Log in', 'woocommerce' ); ?>
            </button>
       </div>

        <div class="lost_password mt-4">
            <a class="underline hover:no-underline" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
       </div>

        <div class="clear"></div>
    </form>
</div>
</div>
<?php wc_print_notices(); ?>
