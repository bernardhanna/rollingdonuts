<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-24 14:11:22
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-25 09:14:26
 */

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>
<style>
    #jckwds-delivery-date-description {
        display: none !important;
    }

    .woocommerce-info::before {
        display: none;
    }

    .woocommerce-info {
        border-top-color: #000;
        padding: 1em;
        margin: 0px;
        margin-bottom: 1rem;
    }

    .woocommerce-checkout form.checkout_coupon {
        border: none;
        padding: 0px;
        border: none;
        padding-top: 1rem;
    }

    .woocommerce-checkout #payment {
        background: transparent;
        border-radius: unset;
    }

    .woocommerce-checkout #payment div.payment_box {
        position: relative;
        box-sizing: border-box;
        width: 100%;
        padding: 1em;
        margin: 1em 0;
        font-size: .92em;
        border-radius: 2px;
        line-height: 1.5;
        background-color: transparent;
        color: #515151;
    }

    .woocommerce-checkout #payment div.payment_box {
        position: relative;
        box-sizing: unset;
        width: 100%;
        padding: unset;
        margin: unset;
        font-size: unset;
        border-radius: unset;
        line-height: 1.5;
        background-color: transparent;
        color: unset;
    }

    .woocommerce-checkout #payment div.form-row {
        padding: 0px;
    }

    .woocommerce-checkout #payment div.payment_box::before {
        display: none;
    }

    .woocommerce-checkout #payment div.payment_box .form-row {
        margin: 0 0 0em;
    }

    .woocommerce-checkout #payment ul.payment_methods li input {
        margin: 0px;
        width: 20px !important;
        height: 20px !important;
        margin-right: 0.5rem;
    }

    .woocommerce-checkout #payment ul.payment_methods {
        text-align: left;
        padding: 1.5rem;
        margin: 0;
        list-style: none outside;
        margin-bottom: 1rem;
        border: solid;
        border-radius: 1.25rem;
        border: var(--Item-counter, 2px) solid #000;
    }

    [type='text'],
    [type='email'],
    [type='url'],
    [type='password'],
    [type='number'],
    [type='date'],
    [type='datetime-local'],
    [type='month'],
    [type='tel'],
    [type='time'],
    [type='week'],
    [multiple],
    textarea,
    select {
        border: 0px solid #D8D7CE;
    }

    .woocommerce-shipping-totals .select2-container .select2-selection--single {
        height: 3.5rem;
        border-radius: 12.5rem;
        margin-top: 1rem;
    }

    .woocommerce-shipping-totals .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 1.75rem;
    }

    .woocommerce-shipping-totals .select2-container--default.select2-container--open.select2-container--below .select2-selection--single {
        border-bottom-left-radius: unset;
        border-bottom-right-radius: unset;
        border-radius: 12.5rem;
    }

    @media (min-width: 1733px) {
        .woocommerce-shipping-totals .select2-container--open .select2-dropdown {
            left: 7.5rem !important;
            right: 0 !important;
        }
    }

    .woocommerce #payment #place_order,
    .woocommerce-page #payment #place_order {
        margin-top: 1rem;
        float: right;
        border-radius: 4.5rem;
        border: 3px solid var(--black-key, #000);
        background: var(--yellow-main, #FFED56);
        color: black;
        font-size: 1.5rem;
        font-style: normal;
        font-weight: 420;
        line-height: 1.625rem;
    }

    .woocommerce #payment #place_order:hover,
    .woocommerce-page #payment #place_order:hover {
        background: var(--black-key, #000);
        color: var(--yellow-main, #FFED56);
    }

    .coupon-btn {
        border-radius: 4.5rem !important;
        border: 3px solid #FFED56 !important;
        background: #000 !important;
        color: #FFED56 !important;
        font-family: Edmondsans !important;
        font-size: 1.25rem !important;
        font-style: normal !important;
        font-weight: 420 !important;
        line-height: 1.5rem !important;
    }

    .coupon-btn:hover {
        background: #FFED56 !important;
        color: #000 !important;
    }

    .checkout_coupon [type='text'] {
        border: 1px solid #D8D7CE;
    }

    .woocommerce-shipping-contents {
        display: none;
    }

    .woocommerce ul#shipping_method li label {
        display: inline;
        font-size: 1.125rem;
        font-style: normal;
        font-weight: 410;
        line-height: 1.625rem;
    }

    .pickup-location-field .pickup-location-address {
        font-size: .8em;
        margin: 15px 0;
        font-size: 1.125rem;
        font-style: normal;
        font-weight: 350;
        line-height: 1.625rem;
        margin-bottom: 0px;
    }

    @media (max-width: 768px) {
        .woocommerce form .form-row {
            width: 100% !important;
        }

        .woocommerce form.checkout_coupon {
            margin: 0px !important;
        }
    }
</style>
<div class="pb-24 mb-10 pt-8">
    <form name="checkout" method="post" class="checkout woocommerce-checkout mx-auto max-w-max-1568 flex lg:flex-row flex-col lg:justify-between" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

        <?php if ($checkout->get_checkout_fields()) : ?>

            <?php do_action('woocommerce_checkout_before_customer_details'); ?>
            <div class="xxl:w-1/2 desktop:w-[772px] w-full pr-0 md:pr-8 desktop:pr-0" id="customer_details">
                <div class="col-1 hideText">
                    <h3 class="text-black-full text-md-font font-reg420 pb-8"><?php esc_html_e('1. Delivery Method', 'woocommerce'); ?></h3>
                    <?php do_action('woocommerce_checkout_billing'); ?>
                </div>

                <div class="col-2">
                    <?php do_action('woocommerce_checkout_shipping'); ?>
                </div>
            </div>

            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

        <?php endif; ?>
        <div class="xxl:w-1/2 desktop:w-[640px] w-full ">
            <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

            <h3 class="text-md-font font-reg420 mb-6" id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

            <?php do_action('woocommerce_checkout_before_order_review'); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action('woocommerce_checkout_order_review'); ?>
            </div>

            <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
    </form>
</div>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find all instances of the shipping options container
        const shippingOptions = document.querySelectorAll('.woocommerce-shipping-totals');
        // If more than one instance found, remove duplicates
        if (shippingOptions.length > 1) {
            for (let i = 1; i < shippingOptions.length; i++) {
                shippingOptions[i].remove();
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var deliveryTimeField = document.getElementById('jckwds-delivery-time');
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function() {
                setTimeout(function() {
                    var savedDeliveryTime = <?php echo json_encode(WC()->session->get('iconic_delivery_time')); ?>;
                    if (deliveryTimeField && savedDeliveryTime) {
                        deliveryTimeField.value = savedDeliveryTime;
                    }
                }, 100); // Adjust this delay as needed
            });
        });

        var config = {
            childList: true,
            subtree: true
        };
        var target = document.querySelector('.woocommerce-checkout-review-order-table'); // Adjust based on actual target
        if (target) observer.observe(target, config);
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Target the element containing the "Collection" text. This selector might need adjustment.
        var shippingLabel = document.querySelector('.checkout .col-1 h3');
        if (shippingLabel && shippingLabel.textContent.includes('Collection')) {
            shippingLabel.textContent = shippingLabel.textContent.replace('Collection.', '');
            // Or set to a completely new value
            // shippingLabel.textContent = '1. Delivery Method';
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        var col1 = document.querySelector('.col-1.hideText'); // Select the container

        if (col1) {
            // This assumes 'Collection' is a direct text node of .col-1.hideText
            Array.from(col1.childNodes).forEach(function(node) {
                if (node.nodeType === 3 && node.textContent.trim() === 'Collection') { // nodeType 3 is a text node
                    node.remove(); // Removes the 'Collection' text node
                }
            });
        }
    });
</script>