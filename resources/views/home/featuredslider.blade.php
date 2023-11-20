<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-12 16:09:36
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-05 10:32:33
 */
?>
@php
$featuredDonuts = get_field('donuts');
@endphp
<section class="featured-donuts relative bg-black" id="featured-section">
    <div class="splide" id="featured-slider">
        <div class="splide__track">
            <div class="splide__list">
                @foreach($featuredDonuts as $donut)
                    @php
                        $bgColor = get_field('featured_donut_bg_color', $donut->ID);
                        $allergens = get_field('product_allergens', $donut->ID);
                    @endphp
                    <div class="splide__slide" style="background-color: {{ $bgColor }}">
                        <div class="lg:max-w-sitewidth mx-auto featured-slide w-full flex flex-col lg:flex-row">
                            <div class="w-full lg:w-1/2 left-feature">
                                 <img
                                    id="featuredImage"
                                    class="w-full h-full max-h-max-300 lg:max-h-max-800 object-cover xyz-in xyz-n10"
                                    xyz="fade up big"
                                    src="{{ get_the_post_thumbnail_url($donut->ID) }}"
                                    sizes="(max-width: 640px) 309px, 800px"
                                    alt="{{ $donut->post_title }}">
                            </div>
                            <div class="w-full lg:w-1/2 lg:h-[800px]" style="background-color: {{ $bgColor }}">
                                <div class="h-full flex flex-col items-start px-12 py-12 lg:mx-16">
                                    <p class="slide-count text-md-font"><span id="current-slide" class="start-count font-reg420">1</span>/{{ count($featuredDonuts) }}</p>
                                    <h3 class="text-lg-font font-reg420">{{ $donut->post_title }}</h3>
                                    <p class="text-sm-font text-left w-full max-w-max-573">{{ get_the_excerpt($donut->ID) }}</p>
                                    <span class="text-md-font font-reg420 py-4">Allergens</span>
                                    @if ($allergens)
                                        <ul class="allergen-list">
                                            @foreach ($allergens as $allergen)
                                                <li class="flex items-center pb-4">
                                                    <img src="{{ get_the_post_thumbnail_url($allergen->ID) }}" alt="{{ $allergen->post_title }}" class="allergen-img mr-4">
                                                    <span class="allergen-title text-base-font font-medium text-black-full">{{ $allergen->post_title }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a class="mt-6 btn-width rounded-btn-72 border-3 border-color-yellow-primary bg-black-full text-yellow-primary text-sm-md-font font-reg420 w-full md:w-[322px] h-[64px] flex flex-row items-center justify-center hover:bg-yellow-primary hover:text-black-full" href="{{ get_permalink($donut->ID) }}" class="btn btn-primary">View Options</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="lg:w-[100px] lg:mx-auto lg:h-full lg:absolute top-0 left-0 right-0 splide hidden lg:flex lg:items-center lg:justify-center lg:flex-col" id="donut-thumb-slider">
            <div class="splide__track">
                <div class="splide__list flex flex-col">
                    @foreach($featuredDonuts as $donut)
                        <div class="splide__slide border-4 border-solid border-black-full rounded-full mt-3 mb-3 p-2.5 bg-white">
                            <img src="{{ get_field('thumb_image', $donut->ID) }}" alt="{{ $donut->post_title }} Thumbnail" height="48px" width="48px">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="splide__arrows flex flex-row justify-between w-full lg:flex-col-reverse lg:absolute lg:right-24 lg:-mt-48 lg:justify-end lg:items-end">
            <!-- Previous Button -->
            <button class="splide__arrow splide__arrow--prev lg:left-auto lg:right-auto lg:flex lg:items-start lg:h-full relative">
                <!-- Large Device Icon -->
                <span class="iconify hidden lg:inline text-black-full lg:mb-4" data-icon="teenyicons:arrow-down-outline" width="32" height="32"></span>
                <!-- Smaller Device Icon -->
                <span class="iconify lg:hidden text-black-full absolute" data-icon="ant-design:arrow-left-outlined" height="62px"></span>
            </button>

            <!-- Next Button -->
            <button class="splide__arrow splide__arrow--next lg:left-auto lg:right-auto lg:flex lg:items-end lg:h-full">
                <!-- Large Device Icon -->
                <span class="iconify hidden lg:inline text-black-full" data-icon="teenyicons:arrow-up-outline" width="32" height="32"></span>
                <!-- Smaller Device Icon -->
                <span class="iconify lg:hidden text-black-full absolute" data-icon="ant-design:arrow-right-outlined" height="62px"></span>
            </button>
        </div>
    </div>
</section>


