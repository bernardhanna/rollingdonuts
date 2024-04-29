<?php
defined('ABSPATH') || exit;

global $product;

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

$selected_product_ids = get_post_meta($product->get_id(), '_donut_box_builder_product_selection', true);
$max_quantity = get_post_meta($product->get_id(), '_donut_box_builder_quantity', true);

if (empty($selected_product_ids) || !is_array($selected_product_ids)) {
    $selected_product_ids = [];
}

if ($product) {
    $product_type = $product->get_type();
    echo 'Product Type: ' . $product_type;
}
?>

<div x-data="{
    // Initialize box with empty (null) slots up to maxQuantity
    box: Array.from({ length: <?php echo esc_attr($max_quantity); ?> }, () => null),
    maxQuantity: <?php echo esc_attr($max_quantity); ?>,
    svgPlaceholder: '/content/uploads/2024/04/Donuts.svg',

    addToBox(productId, imageUrl) {
        // Find the first null (empty) slot and replace it with the new product
        const emptyIndex = this.box.findIndex(slot => slot === null);
        if (emptyIndex !== -1) {
            this.box[emptyIndex] = { id: productId, image: imageUrl };
            console.log('Product added:', productId);
        } else {
            alert('Box is full.');
        }
    },
    removeFromBox(index) {
        // Remove the product from the box and set the slot back to null
        this.box[index] = null;
        console.log('Product removed from box:', index);
    },
    addBoxToCart() {
        if (this.box.length > 0) {
            const productIds = this.box.map(item => item.id).join(',');
            console.log('Adding to cart:', productIds);
            fetch(my_script_object.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    'action': 'donut_box_add_to_cart',
                    'nonce': my_script_object.nonce,
                    'donut_box_product_id': <?php echo esc_js($product->get_id()); ?>, // Pass Donut Box Builder product ID
                    'products': productIds
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response:', data);
                if (data.success) {
                    alert('Box added to cart.');
                    this.box = []; // Clear the box

                    // Assuming the cart count and total elements exist
                    const cartCountElement = document.querySelector('.cart-contents-count');
                    const cartTotalElement = document.querySelector('.cart-contents-total');

                    if (cartCountElement) {
                        cartCountElement.textContent = data.data.cart_contents_count; // Update cart count
                    }
                    if (cartTotalElement) {
                            cartTotalElement.innerHTML = data.data.cart_total_price; // Update cart total
                    }
                } else {
                    alert('There was an error adding the box to the cart.');
                }
            })
            .catch(error => {
                console.error('There was an error with the fetch operation: ', error);
            });
        } else {
            alert('Please add some products to the box before adding to cart.');
        }
    }
}" id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="grid grid-cols-3 gap-4 product-grid">
        <?php
        foreach ($selected_product_ids as $product_id) {
            $prod = wc_get_product($product_id);
            if (!$prod) continue;

            $image_url = wp_get_attachment_image_url($prod->get_image_id(), 'medium');
            if (!$image_url) continue;

            $product_id_attr = esc_attr($product_id);
            $image_url_js = esc_js($image_url);

            echo "<div class='product-item' data-product-id='{$product_id_attr}'>";
            echo "<img src='{$image_url}' alt='" . esc_attr($prod->get_name()) . "' class='object-cover w-full h-auto'>";
            echo "<div class='p-4 text-center product-info'>";
            echo "<h3 class='product-title'>" . esc_html($prod->get_name()) . "</h3>";
            echo "<button @click=\"addToBox({$product_id_attr}, '{$image_url_js}')\" class='px-4 py-2 text-white rounded bg-yellow-primary hover:bg-blue-600'>Add to Box</button>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </div>
    <div class="box-contents bg-black-full">
        <p class="text-white" x-text="`Items in box: ${box.filter(Boolean).length}/${maxQuantity}`"></p>
        <div class="grid grid-cols-3 gap-4 box-grid">
            <!-- Display items added to the box or empty placeholders -->
            <template x-for="(item, index) in box" :key="index">
                <div class="box-item" :class="{ 'placeholder': !item }">
                    <!-- If an item has been added, display its image and remove button -->
                    <template x-if="item">
                        <div>
                            <img :src="item.image" alt="" class="object-cover w-20 h-20">
                            <button @click="removeFromBox(index)" class="remove-item-btn"><svg width="40" height="46" viewBox="0 0 40 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_3010_9364)">
                                        <rect y="0.101562" width="39.786" height="39.786" rx="19.893" fill="#C70000" shape-rendering="crispEdges" />
                                        <rect x="1.33966" y="1.44122" width="37.1067" height="37.1067" rx="18.5533" stroke="black" stroke-width="2.67932" shape-rendering="crispEdges" />
                                        <path d="M12.7392 16.1441L16.013 12.8703L19.8628 16.7201L23.7428 12.84L27.0166 16.1138L23.1366 19.9939L27.0166 23.874L23.7428 27.1478L19.8628 23.2677L16.013 27.1175L12.7392 23.8437L16.5889 19.9939L12.7392 16.1441Z" fill="black" />
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_3010_9364" x="0" y="0.101562" width="39.7861" height="45.1438" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="5.35865" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3010_9364" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3010_9364" result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                    </template>
                    <!-- If the slot is empty, show the SVG placeholder -->
                    <template x-if="!item">
                        <img :src="svgPlaceholder" alt="Placeholder" class="object-cover w-20 h-20">
                    </template>
                </div>
            </template>
        </div>
        <div id="add-to-cart-container">
            <button @click="addBoxToCart" class="px-4 py-2 text-white rounded bg-black-full hover:bg-green-700">Add Box to Cart</button>
        </div>
    </div>

</div>
<?php do_action('woocommerce_after_single_product_summary'); ?>
