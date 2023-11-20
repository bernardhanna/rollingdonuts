<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 11:49:50
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 11:51:40
 */
?>
            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?> >

                <?php do_action('woocommerce_register_form_start'); ?>

                <!-- First name and Last name Input -->
                <div class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-1/2 px-3 mb-4">
                        <label for="reg_first_name"><?php esc_html_e('First Name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" required class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" autocomplete="given-name" />
                    </div>
                    <div class="w-1/2 px-3">
                        <label for="reg_last_name"><?php esc_html_e('Last Name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" required class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" autocomplete="family-name" />
                    </div>
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="reg_email"><?php esc_html_e('Email Address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="email" required class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" />
                </div>

                <!-- Set Password Input -->
                <div class="mb-4">
                    <label for="reg_password"><?php esc_html_e('Set Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="password" required class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                </div>

                <!-- Confirm Password Input -->
                <div class="mb-4">
                    <label for="confirm_password"><?php esc_html_e('Confirm Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="password" required class="woocommerce-Input woocommerce-Input--text input-text" name="confirm_password" id="confirm_password" />
                </div>

                <!-- Checkbox for data handling -->
                <div class="mb-4">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input required class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="privacy_agreement" id="privacy_agreement" />
                        <span><?php esc_html_e('I agree with the handling of my data in accordance with the company privacy policy.', 'woocommerce'); ?></span>
                    </label>
                </div>

                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

                <!-- Submit/Register Button -->
                <button
                    type="submit"
                    class="btn text-black-full hover:text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-medium py-3 bg-yellow-primary rounded-lg-x w-full rd-border hover:bg-black-primary mb-4 woocommerce-button button woocommerce-form-register__submit"
                    name="register"
                    value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                    <?php esc_html_e('Register', 'woocommerce'); ?>
                </button>

                <!-- Already have an account Link -->
                <div class="form-row text-center">
                    <p class="font-laca text-sm-font font-light text-black-full"><?php esc_html_e('Already have an account?', 'woocommerce'); ?>
                        <a class="underline hover:no-underline" href="#" @click="activeTab = 'sign-in'"><?php esc_html_e('Login', 'woocommerce'); ?></a>
                    </p>
                </div>

                <?php do_action('woocommerce_register_form_end'); ?>

            </form>
