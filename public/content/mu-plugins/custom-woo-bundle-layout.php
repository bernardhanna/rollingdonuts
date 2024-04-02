<?php
/*
Plugin Name: Custom WooCommerce Bundle Layout
Description: Uses Splide slider for displaying WooCommerce Smart Bundle products.
*/

add_action('woocommerce_before_single_product', 'custom_wc_bundle_layout', 20);

function custom_wc_bundle_layout()
{
    global $product;

    if ($product->get_type() === 'woosb') {
?>
        <div class="custom-woosb-layout">
            <div class="woosb-slider-container splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        // Assuming $product->get_items() gets you the bundled items. This might need adjustment.
                        $items = $product->get_items();
                        foreach ($items as $item) {
                            $_product = wc_get_product($item['id']);
                            echo '<li class="splide__slide"><img src="' . wp_get_attachment_image_url($_product->get_image_id(), 'full') . '" alt="' . esc_attr($_product->get_name()) . '"></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="woosb-selected-products-container">
                <div class="woosb-selected-products">
                    <!-- Dynamically filled based on selected products -->
                </div>
                <?php
                echo '<button type="button" class="woosb-add-to-cart button alt">' . esc_html($product->single_add_to_cart_text()) . '</button>';
                ?>
            </div>
        </div>
    <?php
    }

    // Enqueue and initialize the Splide slider
    add_action('wp_footer', 'initialize_splide_slider_for_woosb', 30);
}

function initialize_splide_slider_for_woosb()
{
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.woosb-slider-container', {
                perPage: 3,
                rewind: true,
                gap: '1rem',
            }).mount();
        });
    </script>
<?php
}
