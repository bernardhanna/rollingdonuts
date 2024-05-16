<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<style>
    /* Main Body */
@page {
	margin-top: 1cm;
	margin-bottom: 3cm;
	margin-left: 2cm;
	margin-right: 2cm;
}
body {
	background: #fff;
	color: #000;
	margin: 0cm;
	/* want to use custom fonts? http://docs.wpovernight.com/woocommerce-pdf-invoices-packing-slips/using-custom-fonts/ */
	font-size: 9pt;
	line-height: 100%; /* fixes inherit dompdf bug */
}

h1, h2, h3, h4 {
	font-weight: bold;
	margin: 0;
}

h1 {
	font-size: 16pt;
	margin: 5mm 0;
}

h2 {
	font-size: 14pt;
}

h3, h4 {
	font-size: 9pt;
}


ol,
ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

li,
ul {
	margin-bottom: 0.75em;
}

p {
	margin: 0;
	padding: 0;
}

p + p {
	margin-top: 1.25em;
}

a {
	border-bottom: 1px solid;
	text-decoration: none;
}

/* Basic Table Styling */
table {
	border-collapse: collapse;
	border-spacing: 0;
	page-break-inside: always;
	border: 0;
	margin: 0;
	padding: 0;
}

th, td {
	vertical-align: top;
	text-align: left;
}

table.container {
	width:100%;
	border: 0;
}

tr.no-borders,
td.no-borders {
	border: 0 !important;
	border-top: 0 !important;
	border-bottom: 0 !important;
	padding: 0 !important;
	width: auto;
}

/* Header */
table.head {
	margin-bottom: 12mm;
}

td.header img {
	max-height: 3cm;
	width: auto;
}

td.header {
	font-size: 16pt;
	font-weight: 700;
}

td.shop-info {
	width: 40%;
}
.document-type-label {
	text-transform: uppercase;
}

/* Recipient addressses & order data */
table.order-data-addresses {
	width: 100%;
	margin-bottom: 10mm;
}

td.order-data {
	width: 40%;
}

.invoice .shipping-address {
	width: 30%;
}

.packing-slip .billing-address {
	width: 30%;
}

td.order-data table th {
	font-weight: normal;
	padding-right: 2mm;
}

/* Order details */
table.order-details {
	width:100%;
	margin-bottom: 8mm;
}

.quantity,
.price {
	width: 20%;
}

.order-details tr {
	page-break-inside: always;
	page-break-after: auto;
}

.order-details td,
.order-details th {
	border-bottom: 1px #ccc solid;
	border-top: 1px #ccc solid;
	padding: 0.375em;
}

.order-details th {
	font-weight: bold;
	text-align: left;
}

.order-details thead th {
	color: white;
	background-color: black;
	border-color: black;
}

/* product bundles compatibility */
.order-details tr.bundled-item td.product {
	padding-left: 5mm;
}

.order-details tr.product-bundle td,
.order-details tr.bundled-item td {
	border: 0;
}


/* item meta formatting for WC2.6 and older */
dl {
	margin: 4px 0;
}

dt, dd, dd p {
	display: inline;
	font-size: 7pt;
	line-height: 7pt;
}

dd {
	margin-left: 5px;
}

dd:after {
	content: "\A";
	white-space: pre;
}
/* item-meta formatting for WC3.0+ */
.wc-item-meta {
	margin: 4px 0;
	font-size: 7pt;
	line-height: 7pt;
}
.wc-item-meta p {
	display: inline;
}
.wc-item-meta li {
	margin: 0;
	margin-left: 5px;
}

/* Notes & Totals */
.customer-notes {
	margin-top: 5mm;
}

table.totals {
	width: 100%;
	margin-top: 5mm;
}

table.totals th,
table.totals td {
	border: 0;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
}

table.totals th.description,
table.totals td.price {
	width: 50%;
}

table.totals tr.order_total td,
table.totals tr.order_total th {
	border-top: 2px solid #000;
	border-bottom: 2px solid #000;
	font-weight: bold;
}

table.totals tr.payment_method {
	display: none;
}

/* Footer Imprint */
#footer {
	position: absolute;
	bottom: -2cm;
	left: 0;
	right: 0;
	height: 2cm; /* if you change the footer height, don't forget to change the bottom (=negative height) and the @page margin-bottom as well! */
	text-align: center;
	border-top: 0.1mm solid gray;
	margin-bottom: 0;
	padding-top: 2mm;
}

/* page numbers */
.pagenum:before {
	content: counter(page);
}
.pagenum,.pagecount {
	font-family: sans-serif;
}

hr {
	background: url('https://www.imgurupload.com/uploads/20201201/11c7078d917972a1091974209c88913ea059b9e2.png') no-repeat top right;
	background-size: 24px;
	display: block;
	width: 100%;
	height: 48px;
	border: 0;
	position: relative;
}
hr:before,
hr:after {
	content: '';
	display: block;
	position: absolute;
	background: white;
	height: 1px;
	top: 10px;
	border: 0;
	border-top: 2px dashed black;

}
hr:before {
	left: 0;
	right: 100%;
	margin-right: 0px;
}
hr:after {
	right: 0;
	left: 0%;
	margin-left: 0px;
}

</style>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

<table class="container head">
	<tr>
		<td class="header">
		<?php
		if( $this->has_header_logo() ) {
			$this->header_logo();
		} else {
			echo $this->get_title();
		}
		?>
		</td>
		<td class="shop-info">
			<div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
			<div class="shop-address"><?php $this->shop_address(); ?></div>
		</td>
	</tr>
</table>

<h1 class="document-type-label">
<?php if( $this->has_header_logo() ) echo $this->get_title(); ?>
</h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address shipping-address">
			<!-- <h3><?php _e( 'Shipping Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3> -->
			<?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
			<?php $this->shipping_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
			<?php if ( isset($this->settings['display_email']) ) { ?>
			<div class="billing-email"><?php $this->billing_email(); ?></div>
			<?php } ?>
			<?php if ( isset($this->settings['display_phone']) ) { ?>
			<div class="billing-phone"><?php $this->billing_phone(); ?></div>
			<?php include ('display-shipping-phone.php');	?>
			<?php } ?>
		</td>
		<td class="address billing-address">
			<?php if ( isset($this->settings['display_billing_address']) && $this->ships_to_different_address()) { ?>
			<h3><?php _e( 'Billing Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<?php do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); ?>
			<?php $this->billing_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); ?>
			<?php } ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
				<tr class="order-number">
					<th><?php _e( 'Order Number:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_number(); ?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Order Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_date(); ?></td>
				</tr>
				<tr class="shipping-method">
					<th><?php _e( 'Shipping Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->shipping_method(); ?></td>
				</tr>
                <?php include 'display-location.php'; ?>
                <?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
			</table>
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>



<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$count = 0;
		$items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>

		<!-- OUTSET CUSTOM -->
		<?php
		// Variables to be used for styling
		// OLD DETECTION METHOD - CHECKS IF IS A VARIATION PRODUCT
		// $isSubProduct = ( !empty ($item['variation_id']) ) ? true : false;
		// NEW METHOD - CHECK IF ITEM HAS '_woosb_ids' META INFORMATION (SMART BUNDLE SubProducts)
		$product_id = $item['product_id'];
		// array of categories slug to be search for
		$diy_categories = ["displays", "special-occasions", "personal-orders-list
		", "corporate-orders", "branded-donuts", "non-branded-donuts"];
		$product_categories = get_the_terms ( $product_id, 'product_cat' );
		// check is product has children first
		$isSubProduct = !$item['item']->meta_exists('_woosb_ids');

		if ($isSubProduct)
		{
			foreach ($product_categories as $product_category)
			{
				if (in_array($product_category->slug, $diy_categories))
				{
					$isSubProduct = false;
					break;
				}
			}
		}
		// first item will be always bolded
		$makeBold = $count == 0 ? true : false;
		// don't enter when order item is a parent one
		if ($isSubProduct) $isSubProduct = $makeBold ? false : true;
		++$count;
		$MainProductStyleTd = "border-top: solid 3px #000000; font-size:1.3rem;";
		$SubProductStyleTd = "";
		$customMetaStyleTitle = "font-size:12px;";
		$customMetaStyleText = "font-size:12px; font-weight:normal;";
		?>
		<!-- End of OUTSET CUSTOM -->

		<tr
			class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>"
		>
			<td
				class="product"
				style="<?php echo ( !$isSubProduct ) ? $MainProductStyleTd : $SubProductStyleTd ?>"
				>

				<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>

				<!-- If is not sub-product, start STRONG tag, else use spaces and dash -->
				<?php echo ( !$isSubProduct ) ? '<strong>' : '&nbsp;&nbsp;&nbsp;–&nbsp;' ?>

				<!-- DISABLED FOR CHANGING POSITION (NOW IT IS BELOW, AFTER IMAGE) -->
				<span class="item-name"><?php echo $item['name']; ?></span>

				<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
				<span class="item-meta">
				<?php

				// OUTSET CUSTOM

				// echo $item['meta']; // OLD META INFOS PRINT CODE, REPLACED BY BELOW FOR PRINTING ONLY SELECTED META INFO

				$itemMeta = $item['item']->get_meta_data();

				// CUSTOM FORM FIELDS IDS
				$itemMeta_UploadedImagesQty	= 13;
				$itemMeta_UploadedImage1	= 1;
				$itemMeta_UploadedImage2	= 5;
				$itemMeta_UploadedImage3	= 14;
				$itemMeta_UploadedImage4	= 19;
				$itemMeta_UploadedImage5	= 20;
				$itemMeta_CustomPrice 		= 15;
				$itemMeta_CustomNotes 		= 18;
				$itemMeta_SpecialOccasion 	= 23;

				foreach ($itemMeta as $key => $value) {

					if ( isset($value->get_data('current_data')['value']['_gravity_form_linked_entry_id']) ) {

						$formEntries = $value->get_data('current_data')['value']['_gravity_form_lead'];

						// IF IS NOT A SUBPRODUCT
						if ( !$isSubProduct ){

							echo '<dl class="meta">';

							// IMAGES
							if (
								!empty($formEntries[$itemMeta_UploadedImage1])
							 || !empty($formEntries[$itemMeta_UploadedImage2])
							 || !empty($formEntries[$itemMeta_UploadedImage3])
							 || !empty($formEntries[$itemMeta_UploadedImage4])
							 || !empty($formEntries[$itemMeta_UploadedImage5])
							) {
								echo '<br><p style="' . $customMetaStyleTitle . '">Uploaded Images:</p><br>';
							}
							if ( !empty($formEntries[$itemMeta_UploadedImage1]) ){
								echo '<a target="_blank" href="' . $formEntries[$itemMeta_UploadedImage1] . '">';
								echo '<img src="' . $formEntries[$itemMeta_UploadedImage1] . '" height="50" width="auto" />';
								echo '</a>';
							}
							if ( !empty($formEntries[$itemMeta_UploadedImage2]) ){
								echo '<a target="_blank" href="' . $formEntries[$itemMeta_UploadedImage2] . '">';
								echo '<img src="' . $formEntries[$itemMeta_UploadedImage2] . '" height="50" width="auto" />';
								echo '</a>';
							}
							if ( !empty($formEntries[$itemMeta_UploadedImage3]) ){
								echo '<a target="_blank" href="' . $formEntries[$itemMeta_UploadedImage3] . '">';
								echo '<img src="' . $formEntries[$itemMeta_UploadedImage3] . '" height="50" width="auto" />';
								echo '</a>';
							}
							if ( !empty($formEntries[$itemMeta_UploadedImage4]) ){
								echo '<a target="_blank" href="' . $formEntries[$itemMeta_UploadedImage4] . '">';
								echo '<img src="' . $formEntries[$itemMeta_UploadedImage4] . '" height="50" width="auto" />';
								echo '</a>';
							}
							if ( !empty($formEntries[$itemMeta_UploadedImage5]) ){
								echo '<a target="_blank" href="' . $formEntries[$itemMeta_UploadedImage5] . '">';
								echo '<img src="' . $formEntries[$itemMeta_UploadedImage5] . '" height="50" width="auto" />';
								echo '</a>';
							}


							// CUSTOM NOTE
							if ( !empty($formEntries[$itemMeta_CustomNotes]) ) {
								echo '<p style="' . $customMetaStyleTitle .  '">Customization Notes:<br>';
								echo '<span style="' . $customMetaStyleText . '">' . $formEntries[$itemMeta_CustomNotes] . '</span></p>';
							}

							// SPECIAL OCCASION
							if ( !empty($formEntries[$itemMeta_SpecialOccasion]) ) {
								echo '<p style="' . $customMetaStyleTitle .  '">Special Occasion:<br>';
								echo '<span style="' . $customMetaStyleText . '">' . $formEntries[$itemMeta_SpecialOccasion] . '</span></p>';
							}

							echo '<dl>';

						}

					}

				}

				// End of OUTSET CUSTOM

				?>
				</span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
				</dl>

				<!-- Closes STRONG tag for main items' title -->
				<?php echo ( !$isSubProduct ) ? '</strong>' : '' ?>

				<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
			</td>
			<td
				class="quantity"
				style="<?php echo ( !$isSubProduct ) ? $MainProductStyleTd : $SubProductStyleTd ?>"
			>
				<?php
				echo ( !$isSubProduct ) ? '<strong>' : '' ;
				echo $item['quantity'];
				echo ( !$isSubProduct ) ? '</strong>' : '' ;
				?>
			</td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
</table>


<!-- TEST - ENDS SCRIPT -->
<?php
// die();
?>



<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
<?php include 'display_allergens.php'; ?>

<div class="customer-notes">

	<?php if ( $this->get_shipping_notes() ) : ?>

        <?php include 'calculate_font_size.php'; ?>
<!--        --><?php //echo '<p style="font-size:14pt">' . $this->shipping_notes() . '</p>'; ?>
	<?php endif; ?>
</div>
<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
<div id="footer">
	<?php $this->footer(); ?>
</div><!-- #letter-footer -->
<?php endif; ?>

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>
