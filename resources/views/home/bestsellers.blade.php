<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 14:12:32
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-05 11:57:56
 */
?>
<section class="bestsellers-slider relative bg-repeat" @if (get_field('bg_image'))style="background-image: url('{{ get_field('bg_image')['url'] }}');"@endif>
    <div class="overlay">
        <div class="content relative top-0 flex flex-col align-center w-full pt-14 pb-20 lg:max-w-max-1514 lg:mx-auto">
            @if (get_field('text_image'))
                <img class="text-image w-full h-[86px] lg:h-full max-w-max-1200 mx-auto object-contain" src="{{ get_field('text_image')['url'] }}" alt="{{ get_field('text_image')['alt'] }}" />
            @endif
            @if (get_field('heading'))
                <h2 class="text-lg-font font-regular text-white text-center pb-14 relative lg:-top-8">{{ get_field('heading') }}</h2>
            @endif
            @php
                $bestsellersList = get_field('product');
            @endphp
            <div class="bestseller-splide splide">
                <div class="splide__track mx-0 lg:mx-4 xl:mx-4 xxl:mx-0">
                    <div class="splide__list">
                        @foreach($bestsellersList as $product)
                        <div class="splide__slide flex md:p-12 lg:p-0"  x-data="{ showAllergens: false }">
                            @php
                            $product_allergens = get_field('product_allergens', $product->ID);
                        @endphp

                        @if($product_allergens)
                            <div class="absolute top-4 right-4 cursor-pointer z-50" @click="showAllergens = !showAllergens">
                                <div class="z-50" x-show="!showAllergens">
                                    <span class="sr-only">{{ __('info icon', 'rolling-donut') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30" fill="none">
                                        <circle cx="15.678" cy="14.8499" r="14.721" fill="black"/>
                                        <path d="M15.6767 26.0037C21.8359 26.0037 26.8289 21.0107 26.8289 14.8515C26.8289 8.69226 21.8359 3.69922 15.6767 3.69922C9.51745 3.69922 4.52441 8.69226 4.52441 14.8515C4.52441 21.0107 9.51745 26.0037 15.6767 26.0037Z" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.6777 10.3906H15.6889" stroke="white" stroke-width="2.67654" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div x-show="showAllergens" class="z-50 relative rounded-t-lg top-1.5 right-1.5">
                                    <span class="sr-only">{{ __('close', 'rolling-donut') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                        <rect x="1.5" y="1" width="20" height="20" rx="10" fill="black"/>
                                        <circle cx="11.5" cy="11" r="11" fill="#FFED56"/>
                                        <path d="M11.4993 19.3346C16.1017 19.3346 19.8327 15.6037 19.8327 11.0013C19.8327 6.39893 16.1017 2.66797 11.4993 2.66797C6.89698 2.66797 3.16602 6.39893 3.16602 11.0013C3.16602 15.6037 6.89698 19.3346 11.4993 19.3346Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.5 14L8.5 8" stroke="#0E1217" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.5 14L14.5 8" stroke="#0E1217" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div x-show="showAllergens" class="p-4 rounded-tl-lg z-40 allergen-info absolute top-4 right-4 bg-white text-black lg:w-[220px] -m-[10px]">
                                <span class="text-black-full text-sm-font font-reg420">{{ __('Ingredients', 'rolling-donut') }}</span>
                                <div class="w-full mt-4">
                                    <div class="w-full flex flex-wrap flex-row">
                                        @foreach($product_allergens as $allergen)
                                            @php
                                                $allergen_id = $allergen->ID;
                                            @endphp
                                            @if(has_post_thumbnail($allergen_id))
                                                <div class="flex row items-center pb-4 w-1/2">
                                                    <img src="{{ get_the_post_thumbnail_url($allergen_id, 'thumbnail') }}" alt="{{ $allergen->post_title }}" class="mr-1 h-6 w-6">
                                                    <span class="font-laca text-mob-xs-font font-regular">{{ $allergen->post_title }}
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div x-data="{ isHovered: false, isLargeScreen: window.innerWidth > 1084 }" 
                            x-init="() => { 
                                window.addEventListener('resize', () => { 
                                    isLargeScreen = window.innerWidth > 1084; 
                                }) 
                            }" 
                            x-bind:style="(isLargeScreen && isHovered) ? 'background-color: transparent;' : (isLargeScreen ? 'background-color: white;' : 'background-color: transparent;')"
                            class="relative px-12 lg:px-0 w-full lg:rounded-sm-10 bg-transparent">
                            <a href="<?php echo get_permalink($product->ID); ?>">
                                <div class="absolute inset-0 light-black-gradient opacity-50 z-10 h-[408px] rounded-sm-10"></div>
                                <img class="bestseller_image object-cover border-3 border-solid border-black-full rounded-sm-8 relative w-full h-[408px]" src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" alt="<?php echo $product->post_title; ?>">
                        
                                <div id="productContentOne" class="z-40 h-[408px] absolute inset-0 flex flex-col items-center justify-center lg:items-start lg:justify-end p-4" @mouseenter="isLargeScreen && (isHovered = true)" @mouseleave="isLargeScreen && (isHovered = false)">
                                    <h4 class="z-10 text-white text-mob-lg-font font-regular text-center pb-6 lg:font-reg420 lg:md-font lg:text-left"><?php echo $product->post_title; ?></h4>
                                    <button href="{{ get_permalink($product->ID) }}" class="btn btn-primary text-black-full bg-white hover:bg-yellow-primary text-reg-font font-medium text-center w-[257px] h-[56px] flex justify-center items-center rounded-lg-x mb-10 lg:hidden">Select and Customise</button>
                                    <div id="productInfo" class="flex justify-between items-end w-full" x-show="isHovered">
                                        <p class="text-white text-left font-laca font-light text-sm-md-font">
                                            <?php 
                                            if (function_exists('wc_get_product')) {
                                                $wc_product = wc_get_product($product->ID);
                                                echo $wc_product->get_short_description();
                                            }
                                            ?>
                                        </p>
                                        <span class="text-white font-laca font-light text-sm-md-font text-right">€<?php echo number_format(get_post_meta($product->ID, '_price', true), 2, '.', ','); ?></span>
                                    </div>
                                </div>
                        
                                <div id="productContentTwo" class="flex flex-col pt-4" @mouseenter="isLargeScreen && (isHovered = true)" @mouseleave="isLargeScreen && (isHovered = false)">
                                    <div x-bind:style="isHovered && isLargeScreen ? 'background-color: transparent;' : 'background-color: white;'" class="relative hidden lg:flex p-4 flex-row justify-between w-full py-4 h-[100px] rounded-bl-sm-8 rounded-br-sm-8" x-show="!isHovered">
                                        <p class="font-laca text-black-full text-sm-md-font font-light text-left w-2/3">
                                            <?php 
                                            if (function_exists('wc_get_product')) {
                                                $wc_product = wc_get_product($product->ID);
                                                echo $wc_product->get_short_description();
                                            }
                                            ?>
                                        </p>
                                        <span class="font-edmondsans text-black-full text-sm-md-font font-reg420 text-right w-1/3">€<?php echo number_format(get_post_meta($product->ID, '_price', true), 2, '.', ','); ?></span>
                                    </div>
                                    <div class="mt-2 relative" x-show="isHovered">
                                        <a href="<?php the_permalink(); ?>" class="button w-full sm-md-font font-reg420 h-[58px] flex justify-center items-center rounded-large border-black-full border-solid border-2 bg-white hover:bg-yellow-primary">Select and Customise</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
