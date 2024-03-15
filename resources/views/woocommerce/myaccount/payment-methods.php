<?php
defined('ABSPATH') || exit;

$saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

do_action('woocommerce_before_account_payment_methods', $has_methods); ?>

<?php if ($has_methods) : ?>
    <style>
        .button.delete {
            color: #C70000;
            font-size: 18px;
            font-style: normal;
            font-weight: 410;
            line-height: 26px;
        }

        .button.delete :hover {
            color: black;
            text-decoration: underline;
        }
    </style>

    <div class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table w-full">
        <div class="hidden md:flex w-full">
            <div class="w-full flex justify-between bg-grey-disabled px-10 py-2">
                <?php foreach (wc_get_account_payment_methods_columns() as $column_id => $column_name) : ?>
                    <div class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr($column_id); ?> payment-method-<?php echo esc_attr($column_id); ?>"><span class="nobr font-bold"><?php echo esc_html($column_name); ?></span></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php foreach ($saved_methods as $type => $methods) : ?>
            <?php foreach ($methods as $method) : ?>
                <div class="payment-method<?= !empty($method['is_default']) ? ' default-payment-method' : ''; ?> flex flex-col md:flex-row justify-between border-b-2 border-grey-disabled last:border-b-0 bg-white">
                    <?php foreach (wc_get_account_payment_methods_columns() as $column_id => $column_name) : ?>
                        <div class="px-4 md:px-10 py-4 woocommerce-PaymentMethod bg-white woocommerce-PaymentMethod--<?= esc_attr($column_id); ?> payment-method-<?= esc_attr($column_id); ?>" data-title="<?= esc_attr($column_name); ?>">
                            <?php
                            if (has_action('woocommerce_account_payment_methods_column_' . $column_id)) {
                                do_action('woocommerce_account_payment_methods_column_' . $column_id, $method);
                            } elseif ('method' === $column_id) {
                                // Include title for mobile view before the detail
                                echo '<span class="md:hidden font-bold mr-2">Card:</span>';
                                if (!empty($method['method']['last4'])) {
                                    echo sprintf(esc_html__('%1$s ending in %2$s', 'woocommerce'), esc_html(wc_get_credit_card_type_label($method['method']['brand'])), esc_html($method['method']['last4']));
                                } else {
                                    echo esc_html(wc_get_credit_card_type_label($method['method']['brand']));
                                }
                            } elseif ('expires' === $column_id) {
                                // Include title for mobile view before the detail
                                echo '<span class="md:hidden font-bold mr-2">Expires:</span> ';
                                echo esc_html($method['expires']);
                            } elseif ('actions' === $column_id) {
                                foreach ($method['actions'] as $key => $action) {
                                    // Apply specific class if needed to style the delete button differently
                                    $btnClass = $key === 'delete' ? 'button delete' : 'button';
                                    echo '<a href="' . esc_url($action['url']) . '" class="' . $btnClass . ' ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>

<?php else : ?>

    <?php wc_print_notice(esc_html__('No saved methods found.', 'woocommerce'), 'notice'); ?>

<?php endif; ?>

<?php do_action('woocommerce_after_account_payment_methods', $has_methods); ?>

<?php if (WC()->payment_gateways->get_available_payment_gateways()) : ?>
    <div class="w-full max-w-max-1000 px-4 add-payment-button-container">
        <div class="flex justify-start"><a class="button mx-auto btn-width rounded-btn-72 border-3 border-color-yellow-primary bg-yellow-primary text-black-full text-mob-xs-font mobile:text-reg-font lg:text-sm-md-font font-reg420 w-full max-md:w-[342px] md:w-[322px] h-[64px] flex flex-row items-center justify-center hover:bg-white button wc-reorder-button mt-8" href="<?php echo esc_url(wc_get_endpoint_url('add-payment-method')); ?>"><?php esc_html_e('Add payment method', 'woocommerce'); ?></a></div>
    </div>
<?php endif; ?>
