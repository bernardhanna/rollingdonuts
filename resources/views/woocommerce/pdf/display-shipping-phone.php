<?php
$order_shipping_phone = get_post_meta($order_id, '_shipping_phone', true);
$tmp =$order->get_billing_phone();
if ($order_shipping_phone != $order->get_billing_phone()) {
?>
<div class="shipping-phone">Shipping phone: <?php echo $order_shipping_phone; ?></div>
<?php } ?>
