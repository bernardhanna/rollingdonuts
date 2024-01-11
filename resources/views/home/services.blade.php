<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 12:16:10
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-04 12:24:50
 */
?>
<!-- Services Section -->
<section class="services">
    <!-- Service Splide Slider Container -->
    <div class="service-splide splide w-full relative pt-16 pb-20 lg:visible">
        <!-- Splide Track for Slides -->
        <div class="splide__track lg:flex lg:justify-center lg:w-full" data-splide-el="track">
            <!-- Container for Service Items -->
            <div class="w-full lg:flex lg:justify-center lg:flex-row lg:max-w-max-1514 mx-auto items-center splide__list">
                <!-- Fetching the services list from ACF (Advanced Custom Fields) -->
                @php
                $servicesList = get_field('services_list');
                @endphp
                <!-- Check if there are services to display -->
                @if ($servicesList)
                <!-- Loop through each service and display its content -->
                @foreach ($servicesList as $service)
                <!-- Individual Service Container -->
                <!-- AlpineJS: Initialize 'isHovered' state to track hover effect -->
                <div
                    class="relative splide__slide flex flex-col lg:flex-row items-center justify-center lg:justify-start h-auto max-w-750 w-auto lg:w-1/2"
                    x-data="{ isHovered: false }"
                >
                    <!-- Service Image and Video Container -->
                    <!-- AlpineJS: On mouse over, set 'isHovered' to true and play the video -->
                    <!-- AlpineJS: On mouse out, set 'isHovered' to false and pause the video -->
                    <div
                        class="relative w-[200] h-[200] cursor-pointer"
                        @mouseover="isHovered = true; $refs.videoElement.play()"
                        @mouseout="isHovered = false; $refs.videoElement.pause()"
                    >
                        <!-- Service Image -->
                        <!-- AlpineJS: Conditional class to control image opacity based on hover state -->
                        <img
                            class="absolute top-0 left-0 w-full h-full z-10 transition-opacity duration-300"
                            :class="{ 'opacity-0': isHovered, 'opacity-100': !isHovered }"
                            src="{{ $service['image']['url'] }}"
                            alt="{{ $service['image']['alt'] }}"
                        >
                        <!-- Service Video -->
                        <!-- AlpineJS: Conditional class to control video opacity based on hover state -->
                        <!-- AlpineJS: Reference to the video element for play/pause functionality -->
                        <video
                            class="absolute top-0 left-0 w-full h-full z-50 transition-opacity duration-300"

                            :class="{ 'opacity-0': !isHovered, 'opacity-100': isHovered }"
                            preload="none"
                            x-ref="videoElement"
                            muted
                        >
                            <source src="{{ $service['video'] }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <!-- Service Text Content Container -->
                    <div class="flex flex-col items-center lg:items-start justify-center lg:flex-start text-center lg:text-right px-4 lg:h-full">
                        <!-- Service Title -->
                         <!-- AlpineJS: Conditional class to change text color and shadow based on hover state -->
                        <span
                            class="relative top-2 text-font-28 font-reg420 text-black-full text-center lg:text-start"
                            :class="{ 'text-yellow-primary': isHovered, 'shadow-hover': isHovered }"
                        >
                            {{ $service['title'] }}
                        </span>
                        <!-- Underline for Service Title (appears on hover) -->
                        <!-- AlpineJS: Conditional class to control underline visibility based on hover state -->
                        <div
                            class="w-[8.1875rem] h-[0.1875rem] transition-opacity duration-300"
                            :class="{ 'bg-black-full': isHovered, 'opacity-0': !isHovered }"
                        ></div>
                        <!-- Service Description -->
                        <p class="mt-4 lg:mt-6 reg-font font-lighter font-laca text-center md:text-start w-full max-w-max-478">{{ $service['description'] }}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
