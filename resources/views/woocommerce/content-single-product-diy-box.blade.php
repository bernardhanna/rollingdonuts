<?php
defined('ABSPATH') || exit;
global $product;

do_action('woocommerce_before_single_product');
if (post_password_required()) {
    echo get_the_password_form(); // Show the password form if the post is password protected
    return;
}

$is_smart_bundle = $product->get_type() === 'woosb';
?>
<style>
.input-text.qty.text.hasQtyButtons {
    border-radius: 72px;
    border: 1px solid var(--black-full, #000);
    text-align: center;
    font-size: 20px;
    font-style: normal;
    font-weight: 420;
    width: 300px;
}

</style>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="flex flex-wrap -mx-4">
        <?php if ($is_smart_bundle): ?>
        <div class="w-full md:w-1/2 px-4">
            <h2 class="text-xl font-bold mb-4">Choose Your Items</h2>
            <?php do_action('woocommerce_single_product_summary'); ?>
        </div>
        <div class="w-full md:w-1/2 px-4">
            <h2 class="text-xl font-bold mb-4">Your Total</h2>
            <p id="totalPrice">£0.00</p>
            <button onclick="addToCart()">Add to Cart</button>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>

<script>
function addToCart() {
    // Implement add to cart functionality here
    // This could involve collecting selected item IDs, quantities, and then using Ajax to add them to the WooCommerce cart
    console.log('Add to cart clicked');
}

// Example functionality to update the total price, based on selections
// You will need to replace this with actual logic to calculate the total
function updateTotalPrice() {
    let totalPrice = 0;
    // Logic to calculate total based on selected items
    document.getElementById('totalPrice').innerText = `£${totalPrice.toFixed(2)}`;
}

// Call this function whenever the smart bundle selection changes
updateTotalPrice();
</script>
