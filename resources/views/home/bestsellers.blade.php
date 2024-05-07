<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 14:12:32
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-05 11:57:56
 */
$bestsellersList = get_field('product');

// Check if there are any products
if (!empty($bestsellersList)): ?>
<section class="relative bg-repeat bestsellers-slider"
    @if (get_field('bg_image')) style="background-image: url('{{ get_field('bg_image')['url'] }}');" @endif>
    <div class="overlay">
        <div
            class="relative top-0 flex flex-col w-full pt-4 pb-20 max-desktop:px-6 content align-center lg:max-w-max-1578 lg:mx-auto">
            @if (get_field('text_image'))
                <img class="text-image w-full h-[86px] lg:h-full max-w-max-1000 mx-auto object-contain"
                    src="{{ get_field('text_image')['url'] }}" alt="{{ get_field('text_image')['alt'] }}" />
            @endif
            @if (get_field('heading'))
                <h2
                    class="relative text-center text-white text-mob-xxl-font lg:text-lg-font font-regular md:pb-14 lg:-top-14">
                    {{ get_field('heading') }}</h2>
            @endif
            @php
                $bestsellersList = get_field('product');
            @endphp
            <div class="bestseller-splide splide lg:pt-8">
                <div class="mx-0 splide__track lg:mx-4 xl:mx-4 xxl:mx-0">
                    <div class="splide__list">
                        @foreach ($bestsellersList as $product)
                            <div class="flex splide__slide item lg:p-0" x-data="{ showAllergens: false }">
                                @php
                                    $product_allergens = get_field('product_allergens', $product->ID);
                                    $box_number = get_field('box_number', $product->ID); // Get the box_number value
                                @endphp


                                @if ($product_allergens)
                                    <div class="absolute z-50 cursor-pointer top-6 max-sm:right-10 right-20 lg:top-6 lg:right-6"
                                        @click="showAllergens = !showAllergens">
                                        <div class="z-50" x-show="!showAllergens">
                                            <span class="sr-only">{{ __('info icon', 'rolling-donut') }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30"
                                                viewBox="0 0 31 30" fill="none">
                                                <circle cx="15.678" cy="14.8499" r="14.721" fill="black" />
                                                <path
                                                    d="M15.6767 26.0037C21.8359 26.0037 26.8289 21.0107 26.8289 14.8515C26.8289 8.69226 21.8359 3.69922 15.6767 3.69922C9.51745 3.69922 4.52441 8.69226 4.52441 14.8515C4.52441 21.0107 9.51745 26.0037 15.6767 26.0037Z"
                                                    stroke="white" stroke-width="2.67654" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15.6777 19.3125V14.8516" stroke="white" stroke-width="2.67654"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15.6777 10.3906H15.6889" stroke="white" stroke-width="2.67654"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div x-show="showAllergens"
                                            class="z-50 relative rounded-t-lg top-1.5 right-1.5">
                                            <span class="sr-only">{{ __('close', 'rolling-donut') }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22"
                                                viewBox="0 0 23 22" fill="none">
                                                <rect x="1.5" y="1" width="20" height="20" rx="10"
                                                    fill="black" />
                                                <circle cx="11.5" cy="11" r="11" fill="#FFED56" />
                                                <path
                                                    d="M11.4993 19.3346C16.1017 19.3346 19.8327 15.6037 19.8327 11.0013C19.8327 6.39893 16.1017 2.66797 11.4993 2.66797C6.89698 2.66797 3.16602 6.39893 3.16602 11.0013C3.16602 15.6037 6.89698 19.3346 11.4993 19.3346Z"
                                                    stroke="black" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M14.5 14L8.5 8" stroke="#0E1217" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.5 14L14.5 8" stroke="#0E1217" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div x-show="showAllergens"
                                        class="p-4 rounded-tl-lg z-40 allergen-info absolute top-4 right-4 bg-white text-black w-[220px] -m-[10px]">
                                        <span
                                            class="text-black-full text-sm-font font-reg420">{{ __('Ingredients', 'rolling-donut') }}</span>
                                        <div class="w-full mt-4">
                                            <div class="flex flex-row flex-wrap w-full">
                                                @foreach ($product_allergens as $allergen)
                                                    @php
                                                        $allergen_id = $allergen->ID;
                                                    @endphp
                                                    @if (has_post_thumbnail($allergen_id))
                                                        <div class="flex items-center w-1/2 pb-4 row">
                                                            <img src="{{ get_the_post_thumbnail_url($allergen_id, 'thumbnail') }}"
                                                                alt="{{ $allergen->post_title }}" class="w-6 h-6 mr-1">
                                                            <span
                                                                class="font-laca text-mob-xs-font font-regular">{{ $allergen->post_title }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <a href="<?php echo esc_url(get_permalink($product->ID)); ?>" x-data="{ isHovered: false, isLargeScreen: window.innerWidth > 1084 }" x-init="$nextTick(() => {
                                    isLargeScreen = window.innerWidth > 1084;
                                });
                                window.addEventListener('resize', () => {
                                    isLargeScreen = window.innerWidth > 1084;
                                })"
                                    :style="(isLargeScreen && isHovered) ? 'background-color: transparent;' : (isLargeScreen ?
                                        'background-color: white;' : 'background-color: transparent;')"
                                    class="relative w-full px-12 bg-transparent max-sm:px-6 lg:px-0 lg:rounded-sm-10"
                                    style="background-color: white;">
                                    <div
                                        class="absolute inset-0 light-black-gradient opacity-50 z-10 h-[386px] rounded-sm-10">
                                    </div>
                                    <img class="bestseller_image object-cover border-3 border-solid border-black-full rounded-sm-8 relative w-full h-[386px]"
                                        src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" alt="<?php echo $product->post_title; ?>">
                                    <div id="productContentOne"
                                        class="z-40 h-[386px] absolute inset-0 flex flex-col items-center lg:items-start justify-end p-4"
                                        @mouseenter="isLargeScreen && (isHovered = true)"
                                        @mouseleave="isLargeScreen && (isHovered = false)"
                                        x-transition:enter.duration.500ms.delay.50ms x-transition:leave.duration.400ms>
                                        @if(!empty($box_number))
                                         <div class="absolute z-10 hidden p-2 text-center bg-white border-2 lg:flex left-4 top-4 text-black-full font-laca border-black-full border-normal rounded-normal">Box of {{ $box_number }}</div>
                                        @endif
                                        <h4 class="z-10 pb-0 text-center text-white text-sm-md-font lg:text-md-font font-regular lg:pb-6 lg:font-reg420 lg:md-font lg:text-left"
                                            x-transition.delay.150ms><?php echo $product->post_title; ?></h4>
                                        <button href="{{ get_permalink($product->ID) }}"
                                            class="animate-button btn btn-primary text-black-full bg-white hover:bg-yellow-primary text-mob-md-font lg:text-reg-font font-medium text-center w-[257px] h-[56px] flex justify-center items-center rounded-lg-x mb-4 lg:mb-10 lg:hidden">Select
                                            and Customise</button>
                                        <div id="productInfo" class="flex items-end justify-between w-full"
                                            x-show.transition="isHovered" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            <p class="font-light text-left text-white font-laca text-sm-md-font">
                                                <?php
                                                if (function_exists('wc_get_product')) {
                                                    $wc_product = wc_get_product($product->ID);
                                                    echo $wc_product->get_short_description();
                                                }
                                                ?>
                                            </p>
                                            <span
                                                class="font-light text-right text-white font-laca text-sm-md-font">€<?php echo number_format(get_post_meta($product->ID, '_price', true), 2, '.', ','); ?></span>
                                        </div>
                                    </div>
                                    <div id="productContentTwo" class="flex flex-col animate-fade"
                                        @mouseenter="isLargeScreen && (isHovered = true)"
                                        @mouseleave="isLargeScreen && (isHovered = false)">
                                        <div x-bind:style="isHovered && isLargeScreen ? 'background-color: transparent;' :
                                            'background-color: white;'"
                                            class="relative flex-row justify-between hidden w-full p-4 py-4 lg:flex rounded-bl-sm-8 rounded-br-sm-8"
                                            x-show="!isHovered">
                                            <p
                                                class="w-2/3 font-light text-left font-laca text-black-full text-sm-md-font">
                                                <?php
                                                if (function_exists('wc_get_product')) {
                                                    $wc_product = wc_get_product($product->ID);
                                                    echo $wc_product->get_short_description();
                                                }
                                                ?>
                                            </p>
                                            <span
                                                class="w-1/3 text-right font-edmondsans text-black-full text-sm-md-font font-reg420">€<?php echo number_format(get_post_meta($product->ID, '_price', true), 2, '.', ','); ?></span>
                                        </div>
                                        <div class="relative mt-2">
                                            <button x-show.transition="isHovered"
                                                href="<?php the_permalink(); ?>"
                                                class="button w-full sm-md-font font-reg420 h-[58px] flex justify-center items-center rounded-large border-black-full border-solid border-2 bg-white hover:bg-yellow-primary">View Box</button>
                                        </div>
                                    </div>

                                </a>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<style>
    .test {
        color: red;
    }
    </style>
