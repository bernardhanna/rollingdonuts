<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>

    <div class="block lg:hidden">
        <?php
        foreach ($customer_orders->orders as $customer_order) {
            $order = wc_get_order($customer_order);
        ?>
            <div class="flex flex-col mb-5 bg-white small:flex-row rounded-all-sides">
                <div class="hidden w-full small:flex small:flex-row small:w-5/12">
                    <?php
                    // Get the items from the order
                    $items = $order->get_items();
                    if (!empty($items)) :
                        $item = array_shift($items); // Get the first item
                        $product = $item->get_product();
                        if ($product && $product->get_image_id()) :
                            $image_html = wp_get_attachment_image($product->get_image_id(), 'woocommerce_thumbnail', false, array(
                                'class' => 'rounded-left-sides
 w-full h-auto object-cover',
                                'style' => '',
                            ));
                            echo $image_html;
                        endif;
                    endif;
                    ?>
                </div>
                <div class="w-full p-4 small:w-7/12">
                    <?php
                    foreach (wc_get_account_orders_columns() as $column_id => $column_name) {
                        echo '<div class="flex flex-row justify-between py-2">';
                        // Conditionally echo the column name, except for 'order-actions'
                        if ($column_id != 'order-actions') {
                            echo '<span class="font-bold">' . esc_html($column_name) . ':' . '</span>';
                        }
                        switch ($column_id) {
                            case 'order-number':
                                echo '<span><a href="' . esc_url($order->get_view_order_url()) . '">' . esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()) . '</a></span>';
                                break;
                            case 'order-date':
                                echo '<span>' . esc_html(wc_format_datetime($order->get_date_created())) . '</span>';
                                break;
                            case 'order-status':
                                echo '<span>' . esc_html(wc_get_order_status_name($order->get_status())) . '</span>';
                                break;
                            case 'order-total':
                                echo '<span>' . wp_kses_post($order->get_formatted_order_total()) . '</span>';
                                break;
                            case 'order-actions':
                                $actions = wc_get_account_orders_actions($order);
                                if (!empty($actions)) {
                                    foreach ($actions as $key => $action) {
                                        // Corrected button styling and included SVG for the 'View' button
                                        if ($key === 'view') {
                                            echo '<a href="' . esc_url($action['url']) . '" class="border border-black-full rounded-btn-72 flex h-[24px] items-center justify-center woocommerce-button px-4 mr-2 hover:bg-yellow-primary font-medium ' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none" style="margin-left: 8px;"><path d="M10 1C4 1 1 8 1 8C1 8 4 15 10 15C16 15 19 8 19 8C19 8 16 1 10 1Z" stroke="black" stroke-width="1.5" stroke-linejoin="round"/><circle cx="10" cy="8" r="3" stroke="black" stroke-width="1.5"/></svg></a>';
                                        } elseif ($key === 'cancel') {
                                            // Custom styling for the 'Cancel' action
                                            echo '<a href="' . esc_url($action['url']) . '" class="border border-red-500 text-red-500 rounded-btn-72 flex h-[24px] items-center justify-center woocommerce-button px-4 mx-2 hover:bg-red-500 hover:text-white font-medium ' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                        } else {
                                            // Corrected button styling for other actions
                                            echo '<a href="' . esc_url($action['url']) . '" class="border border-black-full rounded-btn-72 flex h-[24px] items-center justify-center woocommerce-button px-4 mx-2 hover:bg-yellow-primary font-medium ' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                        }
                                    }
                                }
                                break;
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="hidden w-full lg:table">
        <table class="w-full rounded-lg woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
            <thead class="px-10 py-2 bg-grey-disabled">
                <tr>
                    <th class="px-10 py-2">Image</th> <!-- Add new Image header -->
                    <?php
                    foreach (wc_get_account_orders_columns() as $column_id => $column_name) {
                        echo '<th class="px-10 py-2 woocommerce-orders-table__header woocommerce-orders-table__header-' . esc_attr($column_id) . '"><span class="nobr">' . esc_html($column_name) . '</span></th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($customer_orders->orders as $customer_order) {
                    $order = wc_get_order($customer_order);
                    echo '<tr class="bg-white border-b-2 border-grey-disabled last:border-b-0 woocommerce-orders-table__row woocommerce-orders-table__row--status-' . esc_attr($order->get_status()) . ' order ">';
                    echo
                    '<td class="px-10 py-2">';
                    // Insert product thumbnail
                    $items = $order->get_items();
                    foreach ($items as $item_id => $item) {
                        $_product = $item->get_product();
                        if ($_product && $_product->get_image_id()) {
                            $image_url = wp_get_attachment_image_url($_product->get_image_id(), 'thumbnail');
                            echo '<img class="rounded-all-sides h-[44px] width-[55px] object-cover" src="' . esc_url($image_url) . '" alt="' . esc_attr($_product->get_name()) . '">';
                            break; // Only show the first product image
                        }
                    }
                    echo '</td>';

                    foreach (wc_get_account_orders_columns() as $column_id => $column_name) {
                        echo '<td class="px-10 py-2 woocommerce-orders-table__cell woocommerce-orders-table__cell-' . esc_attr($column_id) . '" data-title="' . esc_attr($column_name) . '">';
                        switch ($column_id) {
                            case 'order-number':
                                echo '<a href="' . esc_url($order->get_view_order_url()) . '">#' . esc_html($order->get_order_number()) . '</a>';
                                break;
                            case 'order-date':
                                echo date('d/m/y', strtotime($order->get_date_created()));
                                break;
                            case 'order-status':
                                echo wc_get_order_status_name($order->get_status());
                                break;
                            case 'order-total':
                                echo $order->get_formatted_order_total();
                                break;
                            case 'order-actions':
                                $actions = wc_get_account_orders_actions($order);
                                if (!empty($actions)) {
                                    foreach ($actions as $key => $action) {
                                        // Corrected button styling and included SVG for the 'View' button
                                        if ($key === 'view') {
                                            echo '<a href="' . esc_url($action['url']) . '" class="border border-black-full rounded-btn-72 flex h-[44px] items-center justify-center woocommerce-button px-4 mx-2 hover:bg-yellow-primary font-medium ' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none" style="margin-left: 8px;"><path d="M10 1C4 1 1 8 1 8C1 8 4 15 10 15C16 15 19 8 19 8C19 8 16 1 10 1Z" stroke="black" stroke-width="1.5" stroke-linejoin="round"/><circle cx="10" cy="8" r="3" stroke="black" stroke-width="1.5"/></svg></a>';
                                        } else {
                                            // Corrected button styling for other actions
                                            echo '<a href="' . esc_url($action['url']) . '" class="border border-black-full rounded-btn-72 flex h-[44px] items-center justify-center woocommerce-button px-4 mx-2 hover:bg-yellow-primary font-medium ' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                        }
                                    }
                                }
                                break;
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php do_action('woocommerce_after_account_orders_pagination'); ?>

<?php else : ?>
    <?php wc_print_notice(esc_html__('No order has been made yet.', 'woocommerce'), 'notice'); ?>
<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>