<?php

require_once 'get-pickup-location.php';

$output = get_pickup_location($order_id);

if ($output)
{
    ?>
    <tr class="pickup-location">
    <th><b><?php _e( 'Pick up location:', 'woocommerce-pdf-invoices-packing-slips' ); ?></b></th>
    <td><b><?php echo $output; ?></b></td>
    </tr>
    <?php
}
