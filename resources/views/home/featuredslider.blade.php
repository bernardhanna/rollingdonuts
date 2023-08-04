<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-12 16:09:36
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 17:12:08
 */
?>
@php
$featuredDonuts = get_field('donuts');
@endphp

<section class="featured-donuts">
<div class="splide" id="featured-slider">
    <div class="splide__track">
        <div class="splide__list">
            @foreach($featuredDonuts as $donut)
                @php
                    $bgColor = get_field('featured_donut_bg_color', $donut->ID);
                    $allergens = get_field('product_allergens', $donut->ID);
                @endphp
                <div class="splide__slide">
                    <a href="{{ get_permalink($donut->ID) }}" class="w-full flex flex-col">
                        <div class="w-full lg:w-1/2">
                            <img class="w-full h-[309px] object-cover" src="{{ get_the_post_thumbnail_url($donut->ID) }}" alt="{{ $donut->post_title }}">
                        </div>
                        <div class="w-full lg:w-1/2 flex flex-col items-start" style="background-color: {{ $bgColor }}">
                            <p class="slide-count text-md-font"><span class="start-count font-reg420">1</span>/{{ count($featuredDonuts) }}</p>
                            <h3 class="text-font lg-font font-reg420">{{ $donut->post_title }}</h3>
                            <p class="text-sm-font text-left">{{ get_the_excerpt($donut->ID) }}</p>
                            <span>Allergens</span>
                            @if ($allergens)
                                <ul class="allergen-list">
                                    @foreach ($allergens as $allergen)
                                        <li class="flex items-center">
                                            <img src="{{ get_the_post_thumbnail_url($allergen->ID) }}" alt="{{ $allergen->post_title }}" class="allergen-img">
                                            <span class="allergen-title">{{ $allergen->post_title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <button href="{{ get_permalink($donut->ID) }}" class="btn btn-primary">Add to basket</button>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
</section>
