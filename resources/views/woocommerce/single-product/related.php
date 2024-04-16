<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-21 16:38:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 14:29:47
 */
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */
if (!defined('ABSPATH')) {
    exit;
}

global $product;
$product_id = $product->get_id();

// Get the 'rd_product_type' terms for the current product
$terms = wp_get_post_terms($product_id, 'rd_product_type', array('fields' => 'ids'));

// Define a custom WP Query to get related variable products
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 4,
    'post__not_in'   => array($product_id),
    'tax_query'      => array(
        array(
            'taxonomy' => 'rd_product_type',
            'field'    => 'term_id',
            'terms'    => $terms,
            'operator' => 'IN',
        ),
    )
);

$related_products = new WP_Query($args);

if ($related_products->have_posts()) : ?>

    <div class="related rd-related-product pb-5-5rem product overflow-hidden w-full">
        <h4 class="text-black-full text-sm-md-font lg:text-lg-font font-reg420 pt-12 pb-4">
            <?php
            if (!is_wp_error($terms) && !empty($terms)) {
                $product_type = get_term($terms[0], 'rd_product_type')->name;

                if (strcasecmp($product_type, 'merch') === 0) {
                    esc_html_e('Other designs you might like', 'woocommerce');
                } else {
                    esc_html_e('Other donuts you might like', 'woocommerce');
                }
            } else {
                // Default text if no terms are found or if an error occurs
                esc_html_e('You might also like', 'woocommerce');
            }
            ?>
        </h4>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
            <?php
            global $product;

            $rd_product_type = get_rd_product_type($product->get_id());

            ?>
            <li <?php wc_product_class('flex flex-col w-full relative lg:w-23 max-xs:w-full sm-mob:w-48 lg:h-492 h-auto', $product); ?> x-data="{ showAllergens: false }">
                <?php
                $product_allergens = get_field('product_allergens', $product->get_id());
                $allergen_text = '';
                if ($product_allergens) {
                    foreach ($product_allergens as $allergen) {
                        $allergen_text .= $allergen->post_title . ', ';
                    }
                    $allergen_text = rtrim($allergen_text, ' ');
                }
                ?>
                <?php if (!empty($product_allergens)) :  // Only show if allergens are selected
                ?>
                    <div class="absolute top-4 right-4 cursor-pointer z-50 " @click="showAllergens = !showAllergens">
                        <div class="z-50" x-show="!showAllergens">
                            <span class="sr-only"><?php _e('info icon', 'rolling-donut'); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30" fill="none">
                                <circle cx="15.678" cy="14.8499" r="14.721" fill="black" />
                                <path d="M15.6767 26.0037C21.8359 26.0037 26.8289 21.0107 26.8289 14.8515C26.8289 8.69226 21.8359 3.69922 15.6767 3.69922C9.51745 3.69922 4.52441 8.69226 4.52441 14.8515C4.52441 21.0107 9.51745 26.0037 15.6767 26.0037Z" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.6777 10.3906H15.6889" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div x-show="showAllergens" class="z-50 relative rounded-t-lg top-1.5 right-1.5">
                            <span class="sr-only"><?php _e('close', 'rolling-donut'); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                <rect x="1.5" y="1" width="20" height="20" rx="10" fill="black" />
                                <circle cx="11.5" cy="11" r="11" fill="#FFED56" />
                                <path d="M11.4993 19.3346C16.1017 19.3346 19.8327 15.6037 19.8327 11.0013C19.8327 6.39893 16.1017 2.66797 11.4993 2.66797C6.89698 2.66797 3.16602 6.39893 3.16602 11.0013C3.16602 15.6037 6.89698 19.3346 11.4993 19.3346Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.5 14L8.5 8" stroke="#0E1217" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.5 14L14.5 8" stroke="#0E1217" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div x-show="showAllergens" class="p-4 rounded-tl-lg z-40 allergen-info absolute top-4 right-4 bg-white text-black lg:w-[220px] -m-[10px]">
                        <span class="text-black-full text-sm-font font-reg420"><?php _e('Ingredients', 'rolling-donut'); ?></span>
                        <div class="w-full mt-4">
                            <div class="w-full flex flex-wrap flex-row">
                                <?php
                                $product_allergens = get_field('product_allergens', $product->get_id());
                                if ($product_allergens) {
                                    foreach ($product_allergens as $allergen) {
                                        $allergen_id = $allergen->ID;
                                        if (has_post_thumbnail($allergen_id)) {
                                            echo '<div class="flex row items-center pb-4 w-1/2"><img src="' . get_the_post_thumbnail_url($allergen_id, 'thumbnail') . '" alt="' . $allergen->post_title . '" class="mr-1 h-6 w-6">';
                                        }
                                        echo '<span class="font-laca text-mob-xs-font font-regular">';
                                        echo esc_html($allergen->post_title);
                                        echo '</span>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <a class="related-post w-full h-full related-shadow cursor-pointer relative bg-white border-2 border-solid border-black hover:border-yellow-primary rounded-sm-8" href="<?php the_permalink(); ?>">
                    <div class="absolute inset-0 light-black-gradient opacity-50 z-10 h-[157px] lg:h-[200px]"></div>
                    <?php $bg_color = get_field('featured_donut_bg_color'); ?>
                    <?php echo woocommerce_get_product_thumbnail('related', array('class' => 'w-full object-cover rounded-sm-8 related-post-img h-[157px] lg:h-[200px] m-0', 'style' => "background-color: {$bg_color};")); ?>
                    <div class="relative top-0 left-0 z-10 p-4 w-full bg-white">
                        <div class="w-full flex flex-col justify-between lg:h-[245px]">
                            <h4 class="text-black-full text-md-fon md:text-sm-md-font font-reg420 font-edmondsans"><?php the_title(); ?></h4>
                            <div class="flex flex-col w-full">
                                <p class="hidden md:block text-black-full text-left font-laca font-light text-base-font">
                                    <?php
                                    $product_description = custom_truncate_product_description($product->get_short_description());
                                    echo $product_description;
                                    ?>
                                </p>
                                <span class="text-black-full font-laca font-reg420 text-sm-md-font md:text-md-font text-left pb-4"><?php woocommerce_template_loop_price(); ?></span>
                                <button href="<?php the_permalink(); ?>" class="button w-full text-mob-xs-font  md:text-base-font font-reg420 h-[32px] md:h-[58px] flex justify-center items-center rounded-large border-black-full border-solid border-2 bg-white hover:bg-yellow-primary">
                                    <?php
                                    if ($rd_product_type == 'Donut') {
                                        echo __('Find out More', 'rolling-donut');
                                    } elseif ($rd_product_type == 'Box') {
                                        echo __('Select and Customise', 'rolling-donut');
                                    } elseif ($rd_product_type == 'Merch') {
                                        echo __('Add to Basket', 'rolling-donut');
                                    }
                                    ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

        <?php endwhile; ?>

        <?php woocommerce_product_loop_end(); ?>

    </div>

<?php
endif;

wp_reset_postdata();
