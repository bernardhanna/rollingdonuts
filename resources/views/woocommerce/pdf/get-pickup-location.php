<?php
function get_pickup_location($order_id)
{
    global $wpdb;
    $order = wc_get_order($order_id);
    $shipping_method = $order->get_shipping_method();
    if (strpos($shipping_method, "Collect from your local Rolling Donut free of charge") !== false) {
        $pickup_location = [];
        $sql = "SELECT wp_woocommerce_order_itemmeta.*,wp_woocommerce_order_items.*
        FROM wp_woocommerce_order_items
        JOIN wp_woocommerce_order_itemmeta
        ON wp_woocommerce_order_itemmeta.order_item_id = wp_woocommerce_order_items.order_item_id
        WHERE order_id = '$order_id' AND order_item_type = 'shipping'
        ORDER BY wp_woocommerce_order_itemmeta.meta_key;
         ";

        $order_items = $wpdb->get_results($sql);

        foreach ($order_items as $item) {
            if ($item->meta_key == "_pickup_location_address") {
                $pickup_location['address'] = unserialize($item->meta_value);
            }

            if ($item->meta_key == "_pickup_location_phone") {
                $pickup_location['phone'] = $item->meta_value;
            }

            if ($item->meta_key == "_pickup_location_name") {
                $pickup_location['name'] = $item->meta_value;
            }
        }

        $output = $pickup_location['name'] . "<br>";
        //        $pickup_location['address']['address_1'] . " " .
        //        $pickup_location['address']['address_2'] . " " .
        //        $pickup_location['address']['postcode'] . "<br>" .
        //        $pickup_location['phone'];
        return $output;
    } else {
        return false;
    }
}
