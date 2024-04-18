<?php

defined('ABSPATH') || exit;

do_action('woocommerce_cart_is_empty');

?>
<style>
    .woocommerce-notices-wrapper {
        display: none;
    }

    .woocommerce-info::before {
        display: none;
    }

    .cart-empty.woocommerce-info .woocommerce-info::before {
        display: none;
    }

    .return-to-shop a.button {
        --tw-text-opacity: 1;
        color: rgb(0 0 0 / var(--tw-text-opacity));
        font-weight: 420;
        font-size: 24px;
        --tw-bg-opacity: 1;
        background-color: rgb(255 237 86 / var(--tw-bg-opacity));
        border-radius: 72px;
        justify-content: center;
        align-items: center;
        max-width: 356px;
        width: 100%;
        height: 64px;
        display: inline-flex;
        margin-top: 2rem;
    }

    .return-to-shop a.button:hover {
        background-color: black;
        color: #FFED56;
    }
</style>
<p class="return-to-shop">
    <a class="single_add_to_cart_button h-[58px] text-sm-md-font font-reg420 text-yellow-primary hover:text-black-full bg-black-full hover:bg-yellow-primary rounded-lg-x border-2 border-yellow-primary w-full max-w-max-368 button flex justify-center items-center wc-backward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" href="<?php echo esc_url(home_url('/donut-box/')); ?>">
        <?php
        echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce')));
        ?>
    </a>
</p>
