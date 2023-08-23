<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-10 12:18:40
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 16:35:03
 */
global $product;

$rd_product_type = get_rd_product_type($product->get_id());

?>
<li <?php wc_product_class('flex flex-col', $product); ?>>
    <?php if ($rd_product_type == 'Box'): ?>
        <div>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>">
    <?php endif; ?>

        <?php
        // The product thumbnail
        echo woocommerce_get_product_thumbnail('medium', array('class' => 'w-full h-max-max-125 object-cover lg:h-max-max-386 border-2 border-solid border-black rounded-sm-8'));
        ?>

        <div id="productContent" class="">
            <div>
                <h4 class="text-black">
                    <?php the_title(); ?>
                </h4>

                <p class="font-laca font-light text-sm-md-font">
                    <?php echo $product->get_short_description(); ?>
                </p>
            </div>
            <div>
                <span class="text-gray-500">
                    <?php woocommerce_template_loop_price(); ?>
                </span>
            </div>
        </div>
        <div class="mt-2">
            <a href="<?php the_permalink(); ?>" class="button"><?php _e('Select and Customise', 'rolling-donut'); ?></a>
        </div>

    <?php if ($rd_product_type == 'Box'): ?>
        </div>
    <?php else: ?>
        </a>
    <?php endif; ?>

</li>
