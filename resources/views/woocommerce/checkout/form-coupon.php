<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-24 14:18:19
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 14:21:23
 */

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="mx-auto px-0 lg:px-4 max-w-max-1568 flex justify-start text-left flex-col">
<h1 class="text-black-full text-xl-font font-reg420 mb-2"><?php _e('Check out', 'rolling-donut'); ?></h1>
<span class="text-sm-md-font font-light mb-6"><?php _e('Please Note: Delivery in Dublin area only', 'rolling-donut'); ?></span>
<div class="woocommerce-form-coupon-toggle">
    <?php
    wc_print_notice(
        apply_filters(
            'woocommerce_checkout_coupon_message',
            esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon font-bold underline">' . esc_html__( 'Click here', 'woocommerce' ) . '</a>' . esc_html__( ' to enter your code', 'woocommerce' )
        ),
        'notice'
    );
    ?>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>
    <div class="flex flex-col md:flex-row w-full items-center py-4 md:w-3/5 xxl:w-[772px]">
        <div class="form-row form-row-first w-full">
            <input type="text" name="coupon_code" class="input-text woocommerce-Input woocommerce-Input--text input-text rounded-lg-x h-input text-black-secondary text-mob-xs-font font-laca font-light pl-11 flex w-full lg:w-99 mr-4" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
        </div>

        <div class="form-row mt-4 md:mt-0 form-row-last w-full md:w-2/5">
            <button type="submit" class="h-input button text-yellow-primary bg-black-full border-3 border-solid border-yellow-primary rounded-btn-72 text-base-font font-reg420 hover:border-black-full hover:bg-yellow-primary hover:text-black-full  min-w-min-208 w-full md:w-[208px] flex items-center justify-center <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
        </div>
    </div>
	<div class="clear"></div>
</form>
</div>
