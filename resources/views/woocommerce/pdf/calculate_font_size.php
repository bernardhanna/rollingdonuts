<h3 style="left"><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
        <hr>
<?php
// $customer_note_len = strlen($this->get_shipping_notes());
// $font_size = (int)4000/$customer_note_len;
// if ($font_size > 32) $font_size = 32;
// if ($font_size < 24) $font_size = 24;
$font_size = 18;
echo '<div class="customer-note-text" style="font-size:' . $font_size . 'px; line-height: 1.2em;">';
echo '<p>' . $this->shipping_notes() . '</p>';
echo '</div>';
