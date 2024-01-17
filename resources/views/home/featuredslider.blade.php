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
                        <div class="lg:max-w-sitewidth mx-auto featured-slide w-full flex flex-col lg:flex-row pb-8 lg:pb-0 h-full">
                            <div class="w-full lg:w-45 left-feature">
                                 <img
                                    id="featuredImage"
                                    class="w-full h-[300px] mobile:h-full object-cover xyz-in xyz-n10"
                                    xyz="fade up big"
                                    src="{{ get_the_post_thumbnail_url($donut->ID) }}"
                                    sizes="(max-width: 640px) 309px, 800px"
                                    alt="{{ $donut->post_title }}">
                            </div>
                            <div class="w-full lg:w-1/2 h-auto laptop:h-[800px]" style="background-color: {{ $bgColor }}">
                                <div class="h-full flex flex-col items-center">
                                    <div class="relative max-lg:p-8 w-full lg:px-24 mt-12 xxl:mt-32 flex items-start flex-col">
                                    <p class="slide-count text-md-font lg:text-mob-xxl-font"><span id="current-slide" class="start-count font-reg420">1</span>/{{ count($featuredDonuts) }}</p>
                                    <h3 class="text-lg-font lg:text-xl-font font-reg420">{{ $donut->post_title }}</h3>
                                    <p class="text-sm-font lg:text-base-font text-left w-full max-w-max-573">{{ get_the_excerpt($donut->ID) }}</p>
                                    <span class="text-lg-font lg:text-xl-font font-reg420 pt-8 pb-4">Allergens</span>
                                    @if ($allergens)
                                        <ul class="allergen-list">
                                            @foreach ($allergens as $allergen)
                                                <li class="flex items-center pb-[12px]">
                                                    <img src="{{ get_the_post_thumbnail_url($allergen->ID) }}" alt="{{ $allergen->post_title }}" class="allergen-img mr-[10px]">
                                                    <span class="allergen-title text-base-font font-medium text-black-full">{{ $allergen->post_title }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a class="mt-6 btn-width rounded-btn-72 border-3 border-color-yellow-primary bg-black-full text-yellow-primary text-sm-md-font lg:text-md-font font-reg420 w-full md:w-[322px] h-[64px] lg:w-[362px] lg:h-[72px] flex flex-row items-center justify-center hover:bg-yellow-primary hover:text-black-full" href="{{ get_permalink($donut->ID) }}" class="btn btn-primary">View Options</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> 
        <div class="lg:w-[100px] lg:mx-auto laptop:h-[700px] lg:absolute top-0 max-laptop:left-12 left-0 laptop:right-38 lg:right-[11.5rem] splide hidden lg:flex lg:items-center lg:justify-center lg:flex-col h-full" id="donut-thumb-slider">
            <div class="splide__track lg:h-full lg:justify-between lg:items-center flex">
                <div class="splide__list flex flex-col">
                    @foreach($featuredDonuts as $donut)
                        <div class="splide__slide donut-indicator border-4 border-solid border-black-full rounded-full p-2.5 bg-white">
                            <img src="{{ get_field('thumb_image', $donut->ID) }}" alt="{{ $donut->post_title }} Thumbnail" height="48px" width="48px">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="splide__arrows flex flex-row justify-between w-full lg:flex-col-reverse lg:absolute lg:right-24 lg:-mt-40 lg:justify-end lg:items-end">
            <!-- Previous Button -->
            <button class="splide__arrow splide__arrow--prev lg:left-auto lg:right-auto lg:flex lg:items-start lg:h-full relative lg:top-4">
                <!-- Large Device Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="67" viewBox="0 0 40 67" fill="none">
                    <mask id="path-1-outside-1_1917_7034" maskUnits="userSpaceOnUse" x="0.5" y="0.433594" width="40" height="66" fill="black">
                    <rect fill="white" x="0.5" y="0.433594" width="40" height="66"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 60.3415L35.8454 43.0427C36.3742 42.405 37.3199 42.3167 37.9575 42.8455C38.5952 43.3743 38.6835 44.32 38.1547 44.9577L21.9244 64.5294C20.9247 65.735 19.0754 65.735 18.0756 64.5294L1.8454 44.9577C1.31659 44.32 1.40485 43.3743 2.04254 42.8455C2.68022 42.3167 3.62586 42.405 4.15468 43.0427L18.5 60.3415V3.00017C18.5 2.17174 19.1716 1.50017 20 1.50017C20.8285 1.50017 21.5 2.17174 21.5 3.00017V60.3415Z"/>
                    </mask>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 60.3415L35.8454 43.0427C36.3742 42.405 37.3199 42.3167 37.9575 42.8455C38.5952 43.3743 38.6835 44.32 38.1547 44.9577L21.9244 64.5294C20.9247 65.735 19.0754 65.735 18.0756 64.5294L1.8454 44.9577C1.31659 44.32 1.40485 43.3743 2.04254 42.8455C2.68022 42.3167 3.62586 42.405 4.15468 43.0427L18.5 60.3415V3.00017C18.5 2.17174 19.1716 1.50017 20 1.50017C20.8285 1.50017 21.5 2.17174 21.5 3.00017V60.3415Z" fill="black"/>
                    <path d="M21.5 60.3415L22.2698 60.9798L20.5 63.1139V60.3415H21.5ZM35.8454 43.0427L36.6152 43.681L36.6152 43.681L35.8454 43.0427ZM37.9575 42.8455L37.3192 43.6153V43.6153L37.9575 42.8455ZM38.1547 44.9577L38.9244 45.596L38.9244 45.596L38.1547 44.9577ZM21.9244 64.5294L22.6942 65.1678V65.1678L21.9244 64.5294ZM18.0756 64.5294L17.3059 65.1678V65.1678L18.0756 64.5294ZM1.8454 44.9577L1.07564 45.596L1.07564 45.596L1.8454 44.9577ZM2.04254 42.8455L2.68087 43.6153L2.68087 43.6153L2.04254 42.8455ZM4.15468 43.0427L4.92443 42.4043H4.92443L4.15468 43.0427ZM18.5 60.3415H19.5V63.1139L17.7303 60.9798L18.5 60.3415ZM20.7303 59.7031L35.0756 42.4043L36.6152 43.681L22.2698 60.9798L20.7303 59.7031ZM35.0756 42.4043C35.957 41.3415 37.5331 41.1944 38.5959 42.0758L37.3192 43.6153C37.1066 43.439 36.7914 43.4684 36.6152 43.681L35.0756 42.4043ZM38.5959 42.0758C39.6587 42.9571 39.8058 44.5332 38.9244 45.596L37.3849 44.3193C37.5612 44.1068 37.5318 43.7916 37.3192 43.6153L38.5959 42.0758ZM38.9244 45.596L22.6942 65.1678L21.1547 63.8911L37.3849 44.3193L38.9244 45.596ZM22.6942 65.1678C21.2946 66.8555 18.7055 66.8555 17.3059 65.1678L18.8454 63.8911C19.4452 64.6144 20.5548 64.6144 21.1547 63.8911L22.6942 65.1678ZM17.3059 65.1678L1.07564 45.596L2.61516 44.3193L18.8454 63.8911L17.3059 65.1678ZM1.07564 45.596C0.194289 44.5332 0.341384 42.9571 1.4042 42.0758L2.68087 43.6153C2.46831 43.7916 2.43889 44.1068 2.61516 44.3193L1.07564 45.596ZM1.4042 42.0758C2.46701 41.1944 4.04308 41.3415 4.92443 42.4043L3.38492 43.681C3.20865 43.4684 2.89343 43.439 2.68087 43.6153L1.4042 42.0758ZM4.92443 42.4043L19.2698 59.7031L17.7303 60.9798L3.38492 43.681L4.92443 42.4043ZM19.5 3.00017V60.3415H17.5V3.00017H19.5ZM20 2.50017C19.7239 2.50017 19.5 2.72403 19.5 3.00017H17.5C17.5 1.61945 18.6193 0.500168 20 0.500168V2.50017ZM20.5 3.00017C20.5 2.72403 20.2762 2.50017 20 2.50017V0.500168C21.3807 0.500168 22.5 1.61945 22.5 3.00017H20.5ZM20.5 60.3415V3.00017H22.5V60.3415H20.5Z" fill="black" mask="url(#path-1-outside-1_1917_7034)"/>
                    </svg>
                <!-- Smaller Device Icon -->
                <span class="iconify lg:hidden text-black-full absolute" data-icon="ant-design:arrow-left-outlined" height="62px"></span>
            </button>

            <!-- Next Button -->
            <button class="splide__arrow splide__arrow--next lg:left-auto lg:right-auto lg:flex lg:items-end lg:h-full">
                <!-- Large Device Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="67" viewBox="0 0 40 67" fill="none">
                    <mask id="path-1-outside-1_1917_7030" maskUnits="userSpaceOnUse" x="0.5" y="0.566406" width="40" height="66" fill="black">
                    <rect fill="white" x="0.5" y="0.566406" width="40" height="66"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 6.65852L35.8454 23.9573C36.3742 24.595 37.3199 24.6833 37.9575 24.1545C38.5952 23.6257 38.6835 22.68 38.1547 22.0423L21.9244 2.47057C20.9247 1.26502 19.0754 1.26502 18.0756 2.47057L1.8454 22.0423C1.31659 22.68 1.40485 23.6257 2.04254 24.1545C2.68022 24.6833 3.62586 24.595 4.15468 23.9573L18.5 6.65852V63.9998C18.5 64.8283 19.1716 65.4998 20 65.4998C20.8285 65.4998 21.5 64.8283 21.5 63.9998V6.65852Z"/>
                    </mask>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 6.65852L35.8454 23.9573C36.3742 24.595 37.3199 24.6833 37.9575 24.1545C38.5952 23.6257 38.6835 22.68 38.1547 22.0423L21.9244 2.47057C20.9247 1.26502 19.0754 1.26502 18.0756 2.47057L1.8454 22.0423C1.31659 22.68 1.40485 23.6257 2.04254 24.1545C2.68022 24.6833 3.62586 24.595 4.15468 23.9573L18.5 6.65852V63.9998C18.5 64.8283 19.1716 65.4998 20 65.4998C20.8285 65.4998 21.5 64.8283 21.5 63.9998V6.65852Z" fill="black"/>
                    <path d="M21.5 6.65852L22.2698 6.02018L20.5 3.88606V6.65852H21.5ZM35.8454 23.9573L36.6152 23.319L36.6152 23.319L35.8454 23.9573ZM37.9575 24.1545L37.3192 23.3847V23.3847L37.9575 24.1545ZM38.1547 22.0423L38.9244 21.404L38.9244 21.404L38.1547 22.0423ZM21.9244 2.47057L22.6942 1.83223V1.83223L21.9244 2.47057ZM18.0756 2.47057L17.3059 1.83223V1.83223L18.0756 2.47057ZM1.8454 22.0423L1.07564 21.404L1.07564 21.404L1.8454 22.0423ZM2.04254 24.1545L2.68087 23.3847L2.68087 23.3847L2.04254 24.1545ZM4.15468 23.9573L4.92443 24.5957H4.92443L4.15468 23.9573ZM18.5 6.65852H19.5V3.88606L17.7303 6.02018L18.5 6.65852ZM20.7303 7.29685L35.0756 24.5957L36.6152 23.319L22.2698 6.02018L20.7303 7.29685ZM35.0756 24.5957C35.957 25.6585 37.5331 25.8056 38.5959 24.9242L37.3192 23.3847C37.1066 23.561 36.7914 23.5316 36.6152 23.319L35.0756 24.5957ZM38.5959 24.9242C39.6587 24.0429 39.8058 22.4668 38.9244 21.404L37.3849 22.6807C37.5612 22.8932 37.5318 23.2084 37.3192 23.3847L38.5959 24.9242ZM38.9244 21.404L22.6942 1.83223L21.1547 3.1089L37.3849 22.6807L38.9244 21.404ZM22.6942 1.83223C21.2946 0.144466 18.7055 0.144463 17.3059 1.83223L18.8454 3.1089C19.4452 2.38557 20.5548 2.38557 21.1547 3.1089L22.6942 1.83223ZM17.3059 1.83223L1.07564 21.404L2.61516 22.6807L18.8454 3.1089L17.3059 1.83223ZM1.07564 21.404C0.194289 22.4668 0.341384 24.0429 1.4042 24.9242L2.68087 23.3847C2.46831 23.2084 2.43889 22.8932 2.61516 22.6807L1.07564 21.404ZM1.4042 24.9242C2.46701 25.8056 4.04308 25.6585 4.92443 24.5957L3.38492 23.319C3.20865 23.5316 2.89343 23.561 2.68087 23.3847L1.4042 24.9242ZM4.92443 24.5957L19.2698 7.29685L17.7303 6.02018L3.38492 23.319L4.92443 24.5957ZM19.5 63.9998V6.65852H17.5V63.9998H19.5ZM20 64.4998C19.7239 64.4998 19.5 64.276 19.5 63.9998H17.5C17.5 65.3806 18.6193 66.4998 20 66.4998V64.4998ZM20.5 63.9998C20.5 64.276 20.2762 64.4998 20 64.4998V66.4998C21.3807 66.4998 22.5 65.3806 22.5 63.9998H20.5ZM20.5 6.65852V63.9998H22.5V6.65852H20.5Z" fill="black" mask="url(#path-1-outside-1_1917_7030)"/>
                    </svg>
                <!-- Smaller Device Icon -->
                <span class="iconify lg:hidden text-black-full absolute" data-icon="ant-design:arrow-right-outlined" height="62px"></span>
            </button>
        </div>
    </div>
</section>


