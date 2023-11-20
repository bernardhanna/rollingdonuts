<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-23 15:09:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-23 15:23:52
 */

/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>
<h3 class="text-black text-md-font font-reg420">My addresses</h3>
<p class="text-mob-xs-font font-laca font-light pt-4">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="w-full pt-6 flex flex-wrap flex-row lg:justify-between woocommerce-Addresses  addresses">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>

	<div class="w-1/2 woocommerce-Address">
		<header class="woocommerce-Address-title title flex items-center">
			<h4 class="text-base-font font-reg420"><?php echo esc_html( $address_title ); ?></h4>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit pl-8"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="28" height="28" rx="14" fill="black"/>
            <path d="M15.3723 12.0133L15.9856 12.6267L9.9464 18.6667H9.33315V18.0533L15.3723 12.0133ZM17.772 8C17.6053 8 17.432 8.06667 17.3054 8.19333L16.0855 9.41333L18.5852 11.9133L19.805 10.6933C20.065 10.4333 20.065 10.0133 19.805 9.75333L18.2452 8.19333C18.1119 8.06 17.9453 8 17.772 8ZM15.3723 10.1267L8 17.5V20H10.4997L17.872 12.6267L15.3723 10.1267Z" fill="#FFED56"/>
            </svg>
            </a>
		</header>
		<address class="font-laca text-sm-font font-light not-italic pt-4">
			<?php
				echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
			?>
		</address>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;
