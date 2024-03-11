<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-10 09:53:01
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 10:14:50
 */

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
defined('ABSPATH') || exit();

global $product;

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>
<div class="product-listing flex flex-col lg:flex-row" x-data="{
    boxSize: 12,
    selectedItems: [],
    boxFull: false,
    totalCost: 0,
    addItem(item) {
        if (this.selectedItems.length < this.boxSize) {
            this.selectedItems.push({...item, uniqueKey: Date.now() + Math.random()});
            this.totalCost += parseFloat(item.price);
        } else {
            this.boxFull = true;
        }
    },
    submitForm() {
        this.$refs.customBoxForm.submit();
    }
}">

    <div class="w-1/2 left">
        <h2>Our Donuts</h2>
        <?php
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'rd_product_type',
                'field'    => 'slug',
                'terms'    => 'donut',
            ],
        ],
    ];

    $loop = new WP_Query($args);

    if ($loop->have_posts()) : ?>
        <div class="products w-full">
            <div class="flex flex-wrap -mx-2">
                <?php while ($loop->have_posts()) : $loop->the_post(); global $product; ?>
               <div @click="addItem({id: '<?php the_ID(); ?>', title: '<?php the_title(); ?>', imageUrl: '<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>', price: '<?php echo $product->get_price(); ?>' })" class="product w-1/3 px-2 mb-4 cursor-pointer">
                    <a class="block p-4 bg-white shadow hover:shadow-lg transition-shadow duration-200">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="product-image h-24 w-24 mb-4 mx-auto"
                            style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>'); background-size: cover; background-position: center center; width: 100px; height: 100px;">
                        </div>
                        <?php endif; ?>
                        <h3 class="product-title text-lg mb-2"><?php the_title(); ?></h3>
                        <span class="price text-sm text-gray-600"><?php echo $product->get_price_html(); ?></span>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php else : ?>
        <p>No donuts found!</p>
        <?php endif; wp_reset_postdata(); ?>
    </div>
    <div class="w-1/2 right">
        <h2>Custom Box</h2>
        <div>
            <select x-model.number="boxSize" @change="boxFull = false"
                class="mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="12">Box of 12</option>
                <option value="24">Box of 24</option>
            </select>
        </div>
        <template x-if="boxFull">
            <p class="text-red-500">Box is full.</p>
        </template>
        <div class="flex flex-wrap -mx-1 box">
            <template x-for="item in selectedItems" :key="item.uniqueKey">
                <div class="p-1 w-1/4">
                    <img :src="item.imageUrl" alt="Selected Donut" class="w-24 h-24">
                </div>
            </template>
            <template x-for="i in boxSize - selectedItems.length" :key="i">
                <div class="p-1 w-1/4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14">
                        <g fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M.5 7a6.5 6.5 0 1 0 13 0a6.5 6.5 0 1 0-13 0" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 7a2 2 0 1 0 4 0a2 2 0 1 0-4 0m6.5-.5l-.5 1M3 9l1 1m4-7.5l1 1" />
                            <path
                                d="M3.5 4.75a.25.25 0 0 1 0-.5m0 .5a.25.25 0 0 0 0-.5m5 7a.25.25 0 1 1 0-.5m0 .5a.25.25 0 1 0 0-.5" />
                        </g>
                    </svg>
                </div>
            </template>
        </div>
        <div class="total-cost mt-4">
             Total Cost: <span x-text="totalCost.toFixed(2)"></span>
        </div>
        <form x-ref="customBoxForm" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <?php wp_nonce_field('add_custom_box_to_cart_action', 'add_custom_box_to_cart_nonce'); ?>
            <input type="hidden" name="action" value="add_custom_box_to_cart">
            <input type="hidden" name="products" x-model="JSON.stringify(selectedItems)">
            <input type="hidden" name="total_price" x-model="totalCost.toFixed(2)">
            <button type="button" @click="submitForm()">Add box to basket</button>
        </form>
    </div>
</div>
