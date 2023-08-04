<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 12:16:10
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-02 12:10:24
 */
?>
<section class="services"
x-data="{
    isMobile: window.innerWidth <= 1084,
    glide: null,
    initializeGlide() {
        this.$nextTick(() => {
            if (this.isMobile && !this.glide) {
                this.glide = new Glide('.service-glide', {
                    type: 'carousel',
                    perView: 1,
                    bound: true,
                });
                this.glide.mount();
            } else if (!this.isMobile && this.glide) {
                this.glide.destroy();
                this.glide = null;
            }
        });
    }
}"
x-init="initializeGlide">
<div :class="isMobile ? 'service-glide' : ''" class="w-full relative py-20">
    <div :class="isMobile ? 'glide__track' : ''" data-glide-el="track">
        <div :class="isMobile ? 'glide__slides' : ''" class="w-full lg:flex lg:flex-row lg:max-w-max-1514 mx-auto items-center">
            @php
            $servicesList = get_field('services_list');
            @endphp
            @if ($servicesList)
            @foreach ($servicesList as $service)
            <div :class="isMobile ? 'glide__slide' : ''" class="glide__slide flex flex-col lg:flex-row items-center justify-center lg:justify-start h-auto max-w-750 px-6 w-auto lg:w-1/2">
                <img class="w-[200]" src="{{ $service['image']['url'] }}" alt="{{ $service['image']['alt'] }}">
                <div class="flex flex-col items-center lg:items-start justify-center lg:flex-start text-center lg:text-right px-4 lg:h-full">
                    <span class="text-font-28 font-reg420 text-black-full mb-4 lg:mb-6 text-center lg:text-start">{{ $service['title'] }}</span>
                    <p class="reg-font font-lighter font-laca text-center md:text-start w-full max-w-max-478">{{ $service['description'] }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        </div>
        <div x-show="isMobile" class="glide__arrows" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left flex justify-center items-center w-[47px] h-[47px] rounded-full bg-black-full" data-glide-dir="<">
            <span class="iconify h-full text-white text-md-font" data-icon="ic:round-chevron-left"></span>
        </button>
        <button class="glide__arrow glide__arrow--right flex justify-center items-center w-[47px] h-[47px] rounded-full bg-black-full" data-glide-dir=">">
            <span class="iconify h-full text-white text-md-font" data-icon="ic:round-chevron-right"></span>
        </button>
        </div>
    </div>
</section>
