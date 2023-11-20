<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 15:28:22
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 16:14:59
 */

/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post">

    <h4 class="text-md-font font-reg420 pb-4"><?php _e('Edit my Billing Address', 'rolling-donut'); ?></h4><?php // @codingStandardsIgnoreLine ?>
    <span class="font-laca text-sm-font font-light"><?php _e('The following will be used on the checkout page by default', 'rolling-donut'); ?></span>

		<div class="woocommerce-address-fields pt-12">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper">
				<?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
            <!-- Checkbox before the Save address button -->
            <p class="privacy-policy-checkbox pb-8 pt-4">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox bg-white mr-2 h-[20px] w-[20px] rounded-sm" type="checkbox" name="billing_privacy_policy" id="billing_privacy_policy" required>
                <label class="font-laca text-sm-font font-light" for="billing_privacy_policy"><?php _e('I agree with the handling of my data in accordance with the company privacy policy.', 'rolling-donut'); ?></label>
            </p>
			<p>
				<button class="btn text-yellow-primary hover:text-black-full text-mob-lg-font lg:text-sm-md-font font-medium py-3 bg-black-full hover:bg-primary-yellow rounded-lg-x w-1/2 hover:bg-yellow-primary mb-4 border-solid border-2 border-yellow-primary hover:border-black-full" type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
