<?php

/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 14:12:32
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 10:28:20
 */
?>
<section class="bestsellers-slider relative bg-repeat" @if (get_field('bg_image'))style="background-image: url('{{ get_field('bg_image')['url'] }}');"@endif>
    <div class="overlay">
        <div class="content relative top-0 flex flex-col align-center w-full pt-14 pb-20 lg:max-w-max-1514 lg:mx-auto">
            @if (get_field('text_image'))
                <img class="text-image w-full h-[86px] lg:h-full max-w-max-984 mx-auto object-contain" src="{{ get_field('text_image')['url'] }}" alt="{{ get_field('text_image')['alt'] }}" />
            @endif
            @if (get_field('heading'))
                <h2 class="text-lg-font font-regular text-white text-center pb-14 relative lg:-top-8">{{ get_field('heading') }}</h2>
            @endif
            @php
                $bestsellersList = get_field('product');
            @endphp
            <div class="bestseller-glide relative h-full">
                <div class="glide__track w-full"  data-glide-el="track">
                    <div class="glide__slides flex items-center justify-center w-full item px-12 lg:px-0 lg:mx-auto">
                        @foreach($bestsellersList as $product)
                            <a href="{{ get_permalink($product->ID) }}" class="glide__slide ml-0 mr-0S relative px-12 lg:px-0 w-full lg:bg-white lg:rounded-sm-10">
                                <img class="bestseller_image object-cover border-3 border-solid border-black-full rounded-sm-8 relative w-full lg:h-[408px]" src="{{ get_the_post_thumbnail_url($product->ID) }}" alt="{{ $product->post_title }}">
                                <div class="absolute top-0 left-0 right-0  w-full h-full flex flex-col items-center lg:items-start justify-end">
                                    <h3 class="text-white text-mob-lg-font font-regular text-center pb-6 lg:font-reg420 lg:md-font lg:text-left lg:pb-4 lg:pl-4">{{ $product->post_title }}</h3>
                                    <button href="{{ get_permalink($product->ID) }}" class="btn btn-primary text-black-full bg-white hover:bg-yellow-primary text-reg-font font-medium text-center w-[257px] h-[56px] flex justify-center items-center rounded-lg-x mb-10 lg:hidden">Select and Customise</button>
                                </div>
                                <div class="relative hidden lg:flex p-4 flex-row justify-between w-full py-4 h-[100px]">
                                    <p class="font-laca text-black-full text-sm-md-font font-light text-left w-2/3">{{ get_the_excerpt($product->ID) }}</p>
                                    <span class="font-edmondsans text-black-full text-sm-md-font font-reg420 text-right w-1/3">&euro;{{ number_format(get_post_meta($product->ID, '_price', true), 2, '.', ',') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left flex justify-center items-center w-[47px] h-[47px] rounded-full bg-yellow-primary" data-glide-dir="<">
                        <span class="iconify h-full text-black text-md-font" data-icon="ic:round-chevron-left"></span>
                    </button>
                    <button class="glide__arrow glide__arrow--right flex justify-center items-center w-[47px] h-[47px] rounded-full bg-yellow-primary" data-glide-dir=">">
                        <span class="iconify h-full text-black text-md-font" data-icon="ic:round-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
