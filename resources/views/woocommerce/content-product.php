<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-10 12:18:40
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 12:23:09
 */
global $product;

$rd_product_type = get_rd_product_type($product->get_id());

?>
<li <?php wc_product_class('w-48 lg:w-31-5 product-small-device flex flex-col relative md:pb-12', $product); ?> x-data="{ showAllergens: false, windowWidth: window.innerWidth }" @resize.window="windowWidth = window.innerWidth">
    <?php
    $product_allergens = get_field('product_allergens', $product->get_id());
    $box_number = get_field('box_number', $product->ID);
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
            <div x-cloak x-show="showAllergens" class="z-50 relative rounded-t-lg top-1.5 right-1.5">
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
        <div x-cloak x-show="showAllergens" class="p-4 rounded-tl-lg z-40 allergen-info absolute top-4 right-4 bg-white text-black w-[220px] -m-[10px]">
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
    <a class="relative w-full max-md:rounded-t-lg" href="<?php the_permalink(); ?>" x-data="{ isHovered: false }">
        <div class="max-md:hidden absolute inset-0 light-black-gradient opacity-50 z-10 md:h-[386px] rounded-sm-10"></div>
        <?php echo woocommerce_get_product_thumbnail('full', array('class' => 'border-top-eight max-md:rounded-t-lg w-full h-max-max-125 md:max-h-full object-cover h-[200px] md:h-[386px] md:border-2 md:border-solid md:border-black md:rounded-sm-8 m-0')); ?>
        <div id="productContentOne" class="absolute top-0 left-0 h-auto md:h-[386px] z-10 p-4 w-full" @mouseenter="isHovered = windowWidth >= 768" @mouseleave="isHovered = false" x-transition.duration.500ms>
        <?php if(!empty($box_number)): ?>
        <div class="z-10 hidden lg:flex left-4 top-4 absolute bg-white text-black-full font-laca text-center border-2 border-black-full p-2 border-normal rounded-normal">Box of <?php echo $box_number; ?></div>
        <?php endif; ?>
            <div class="h-full w-full flex flex-col justify-end">
                <h4 class="hidden md:block text-white text-md-font font-reg420 font-edmondsans">
                    <?php the_title(); ?>
                </h4>
                <div id="productInfo" class="flex justify-between items-end w-full" x-show="isHovered" x-transition.duration.500ms>
                    <p class="text-white text-left font-laca font-light text-sm-md-font">
                        <?php
                        $product_description = custom_truncate_product_description($product->get_short_description());
                        echo $product_description;
                        ?>
                    </p>
                    <span class="text-white font-laca font-light text-sm-md-font text-right">
                        <?php woocommerce_template_loop_price(); ?>
                    </span>
                </div>
            </div>
        </div>
        <div id="productContentTwo" class="flex flex-col max-md md:pt-4">
            <div class="md:mt-2 flex max-md:flex-col justify-between max-md:p-4 " x-show="!isHovered">
                <h4 class="block md:hidden text-black-full text-mob-xs-font font-reg420 font-edmondsans pb-4"><?php the_title(); ?></h4>
                <p class="hidden md:block font-laca font-light text-mob-md-font md:text-sm-md-font pr-4"> <?php
                                                                                                            $product_description = custom_truncate_product_description($product->get_short_description());
                                                                                                            echo $product_description;
                                                                                                            ?></p>
                <span class="text-black-full font-reg420 text-mob-md-font md:text-sm-md-font"><?php woocommerce_template_loop_price(); ?></span>
            </div>

            <div class="hidden md:block mt-2 relative p-4" x-show="isHovered" x-show.transition="isHovered" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                <button @click="window.location='<?php the_permalink(); ?>'" class="button w-full text-mob-xs-font md:text-sm-font font-reg420 h-[32px] md:h-[58px] flex justify-center items-center rounded-large border-black-full border-solid border-2 bg-white hover:bg-yellow-primary">
                    <?php echo ($rd_product_type == 'Donut') ? __('Find out More', 'rolling-donut') : __('Select and Customise', 'rolling-donut'); ?>
                </button>
            </div>
            <div class="block md:hidden p-4">
                <button @click="window.location='<?php the_permalink(); ?>'" class="button w-full text-mob-xs-font md:text-sm-font font-reg420 h-[32px] md:h-[58px] flex justify-center items-center rounded-large border-black-full border-solid border-2 bg-white hover:bg-yellow-primary">
                    <?php echo ($rd_product_type == 'Donut') ? __('Find out More', 'rolling-donut') : __('Select and Customise', 'rolling-donut'); ?>
                </button>
            </div>
        </div>
    </a>
</li>