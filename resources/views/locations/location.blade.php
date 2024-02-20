<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-08 11:00:29
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-09 17:15:40
 */
?>
<style>
.leaflet-tile-container {
  filter: saturate(0.8)!important;
}
</style>
<section x-data="{ windowWidth: window.innerWidth }"
         x-init="window.addEventListener('resize', () => windowWidth = window.innerWidth)"
         class="tablet-sm:max-w-max-1341 mx-auto p-0 mobile:px-4 pt-4">
    @php
    $args = array(
        'post_type' => 'location', // Replace 'location' with your actual post type name if different
        'posts_per_page' => -1, // Fetch all posts
    );

    $query = new WP_Query($args);
@endphp

@if($query->have_posts())
    @while($query->have_posts()) @php $query->the_post(); @endphp
        @php
            $post_id = get_the_ID();  // Get the current post ID
$fields = get_fields();
        @endphp
        <div class="location-item pt-10 mobile:pt-0 mb-4 relative mobile:border-black mobile:border-4 mobile:border-solid mobile:rounded-md-32 flex flex-col mobile:flex-row bg-white tablet-sm:pt-6 tablet-sm:pb-3">
            <div class="mobile:p-4 lg:p-0 flex flex-col tablet-sm:mr-auto tablet-sm:ml-auto lg:w-30">
                <h4 class="pb-8 max-mobile:block hidden pt-3 leading-normal text-font-28 tablet-sm:text-md-font font-reg420 text-black-full w-full">{{ get_the_title() }}</h4>
                    @if(has_post_thumbnail())
                        @php
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full', true);
                        @endphp

                        <img class="max-mobile:border-black-full max-mobile:border-4 tablet-sm:pr-2 rounded-one object-cover w-full h-[270px]  md:h-auto tablet-sm:h-[381px]" src="{{ $thumbnail_url[0] }}" alt="{{ get_the_title() }}"> <!-- Featured Image -->
                    @endif
                </div>
            <div class="w-full mobile:w-3/5 lg:w-2/3 flex flex-col pr-4 lg:-top-4 lg:right-2 relative">
                <div class="flex flex-col pt-10 mobile:pt-0">
                    <h4 class="max-mobile:order-1 max-mobile:hidden pt-3 leading-normal text-font-28 tablet-sm:text-md-font font-reg420 text-black-full w-full">{{ get_the_title() }}</h4> <!-- Title -->
                    @php
$fields = get_fields(); // This will return all ACF fields for the post
                    @endphp
<div class="max-mobile:order-2 flex pt-0 tablet-sm:pt-5 max-mobile:flex-wrap tablet-sm:justify-between flex-col notebook:flex-row tablet-sm:flex-row w-full">
                        <span class="flex items-start tablet-sm:items-center font-laca text-reg-font tablet-sm:text-sm-md-font text-black-primary font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.2" d="M12 3C10.0109 3 8.10322 3.79018 6.6967 5.1967C5.29018 6.60322 4.5 8.51088 4.5 10.5C4.5 17.25 12 22.5 12 22.5C12 22.5 19.5 17.25 19.5 10.5C19.5 9.51509 19.306 8.53982 18.9291 7.62987C18.5522 6.71993 17.9997 5.89314 17.3033 5.1967C16.6069 4.50026 15.7801 3.94781 14.8701 3.5709C13.9602 3.19399 12.9849 3 12 3ZM12 13.5C11.4067 13.5 10.8266 13.3241 10.3333 12.9944C9.83994 12.6648 9.45542 12.1962 9.22836 11.6481C9.0013 11.0999 8.94189 10.4967 9.05764 9.91473C9.1734 9.33279 9.45912 8.79824 9.87868 8.37868C10.2982 7.95912 10.8328 7.6734 11.4147 7.55764C11.9967 7.44189 12.5999 7.5013 13.1481 7.72836C13.6962 7.95542 14.1648 8.33994 14.4944 8.83329C14.8241 9.32664 15 9.90666 15 10.5C15 11.2956 14.6839 12.0587 14.1213 12.6213C13.5587 13.1839 12.7957 13.5 12 13.5Z" fill="black"/>
                            <path d="M12.0098 6C11.2681 6 10.5431 6.21993 9.92638 6.63199C9.30969 7.04404 8.82905 7.62971 8.54522 8.31494C8.26139 9.00016 8.18713 9.75416 8.33182 10.4816C8.47652 11.209 8.83367 11.8772 9.35812 12.4017C9.88256 12.9261 10.5507 13.2833 11.2782 13.4279C12.0056 13.5726 12.7596 13.4984 13.4448 13.2145C14.1301 12.9307 14.7157 12.4501 15.1278 11.8334C15.5398 11.2167 15.7598 10.4917 15.7598 9.75C15.7573 8.7562 15.3614 7.80381 14.6587 7.10108C13.956 6.39836 13.0036 6.00248 12.0098 6ZM12.0098 12C11.5648 12 11.1297 11.868 10.7597 11.6208C10.3897 11.3736 10.1013 11.0222 9.93104 10.611C9.76074 10.1999 9.71618 9.7475 9.803 9.31105C9.88982 8.87459 10.1041 8.47368 10.4188 8.15901C10.7334 7.84434 11.1344 7.63005 11.5708 7.54323C12.0073 7.45642 12.4597 7.50097 12.8708 7.67127C13.2819 7.84157 13.6333 8.12996 13.8806 8.49997C14.1278 8.86998 14.2598 9.30499 14.2598 9.75C14.2573 10.346 14.0195 10.9168 13.598 11.3383C13.1766 11.7597 12.6057 11.9975 12.0098 12Z" fill="black"/>
                            <path d="M12.0098 1.5C9.82249 1.50248 7.72551 2.37247 6.17888 3.91911C4.63224 5.46575 3.76225 7.56273 3.75977 9.75C3.75977 12.6937 5.11914 15.8156 7.69727 18.7687C8.85616 20.1064 10.1576 21.3136 11.5785 22.3687C11.7063 22.4538 11.8563 22.4992 12.0098 22.4992C12.1632 22.4992 12.3133 22.4538 12.441 22.3687C13.8661 21.3151 15.1708 20.1079 16.3316 18.7687C18.9004 15.8156 20.2598 12.6937 20.2598 9.75C20.2573 7.56273 19.3873 5.46575 17.8407 3.91911C16.294 2.37247 14.197 1.50248 12.0098 1.5ZM12.0098 20.8125C10.4629 19.5937 5.25977 15.1125 5.25977 9.75C5.25977 7.95979 5.97092 6.2429 7.23679 4.97703C8.50267 3.71116 10.2196 3 12.0098 3C13.8 3 15.5169 3.71116 16.7827 4.97703C18.0486 6.2429 18.7598 7.95979 18.7598 9.75C18.7598 15.1125 13.5566 19.5937 12.0098 20.8125Z" fill="black"/>
                            </svg> {{ $fields['address'] }}
                            </span>
                            <a href="tel:{{ $fields['phone_number'] }}" class="flex items-center font-laca text-reg-font tablet-sm:text-sm-md-font text-black-primary font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20.999 16.4207V19.9569C20.9991 20.2101 20.9032 20.4539 20.7306 20.6392C20.558 20.8244 20.3216 20.9373 20.0691 20.955C19.6321 20.985 19.2751 21.001 18.9991 21.001C10.1626 21.001 3 13.8376 3 5.00011C3 4.7241 3.015 4.36708 3.046 3.93005C3.06372 3.67748 3.17657 3.44104 3.36178 3.26842C3.547 3.09581 3.79078 2.99989 4.04394 3H7.57975C7.70378 2.99987 7.82343 3.04586 7.91546 3.12903C8.00748 3.21219 8.06531 3.3266 8.07772 3.45003C8.10072 3.68004 8.12172 3.86305 8.14171 4.00206C8.34044 5.38906 8.74768 6.73804 9.34965 8.00328C9.44464 8.20329 9.38265 8.4423 9.20266 8.57031L7.04478 10.1124C8.36416 13.187 10.8141 15.6372 13.8884 16.9568L15.4283 14.8027C15.4913 14.7146 15.5831 14.6515 15.6878 14.6243C15.7925 14.5971 15.9034 14.6075 16.0013 14.6536C17.2662 15.2545 18.6147 15.6608 20.0011 15.8587C20.14 15.8787 20.323 15.9007 20.551 15.9227C20.6743 15.9354 20.7884 15.9933 20.8714 16.0853C20.9543 16.1773 21.0002 16.2969 21 16.4207H20.999Z" fill="black" fill-opacity="0.2" stroke="black"/>
                            </svg> {{ $fields['phone_number'] }}
                        </a>
                    </div>
                </div>

            <div x-data="{ openPanel: null } bg-white" class="max-mobile:order-4 border-2 border-solid border-black rounded-sm-12 boxshadow mt-[10px] pt-2 pb-2 pl-0 mobile:pr-4">
                <div class="flex flex-col" id="accordion-collapse-{{ $post_id }}" x-data="{ isOpen: window.innerWidth >= 1024 }" x-init="window.addEventListener('resize', () => { isOpen = window.innerWidth >= 993 })">
                    <span class="text-reg-font tablet-sm:text-md-font" id="accordion-collapse-heading-{{ $post_id }}">
                    <button @click="isOpen = !isOpen" type="button" class="flex items-center justify-between w-full pl-5 pr-5 font-medium text-left text-gray-500 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 tablet-sm:pb-4">
                        <span class="text-black-primary text-sm-md-font font-reg420 relative ">Opening Hours</span>
                        <!-- SVG when open -->
                        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.6167 10.557C15.8807 10.8211 15.8807 11.2491 15.6167 11.5131L14.6698 12.46C14.406 12.7238 13.9784 12.724 13.7143 12.4605L7.99932 6.75801L2.28437 12.4605C2.02027 12.724 1.59262 12.7238 1.32881 12.46L0.381948 11.5131C0.117935 11.2491 0.117935 10.8211 0.381948 10.557L7.99932 2.93967L15.6167 10.557Z" fill="black"/>
                        </svg>
                        <!-- SVG when closed -->
                        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.6167 2.93967C15.8807 2.67567 15.8807 2.24767 15.6167 1.98367L14.6698 1.0368C14.406 0.773001 13.9784 0.773001 13.7143 1.0365L7.99932 6.73901L2.28437 1.0365C2.02027 0.773001 1.59262 0.773001 1.32881 1.0368L0.381948 1.98367C0.117935 2.24767 0.117935 2.67567 0.381948 2.93967L7.99932 10.557L15.6167 2.93967Z" fill="black"/>
                        </svg>
                    </button>
                    </span>
                    <div x-show="isOpen" id="accordion-collapse-body-{{ $post_id }}" aria-labelledby="accordion-collapse-heading-{{ $post_id }}">
<div class="pl-5 pr-5 pt-1 dark:bg-gray-900">
                        <div class="bg-grey-background rounded-sm-8 flex items-center justify-between p-2"><span class="text-base-font font-medium text-black-full">Monday - Friday</span><span class="text-grey-font text-base-font font-regular">{{ $fields['mon_fri_opening_hours'] }}</span></div>
                        <div class="bg-white rounded-sm-8 flex items-center justify-between  p-2"><span class="text-base-font font-medium text-black-full">Saturday</span> <span class="text-grey-font text-base-font font-regular">{{ $fields['sat_opening_hours'] }}</span></div>
                        <div class="bg-grey-background rounded-sm-8 flex items-center justify-between p-2"><span class="text-base-font font-medium text-black-full">Sunday</span><span x-bind:class="{'text-white': $fields['sun_opening_hours'] !== 'Closed', 'text-red-500': $fields['sun_opening_hours'] === 'Closed'}" class="text-red-critical text-base-font font-bold">{{ $fields['sun_opening_hours'] }}</span></div>
                    </div>
                    </div>
                </div>
            </div>
                <div class="max-mobile:order-3 flex mt-4 tablet-sm:flex-row flex-col justify-between max-w-max-691">
<div x-data="{ isHovered: false }">
<a target="_blank" class="max-tablet-sm:mb-4 w-full tablet-sm:w-[340px] h-[48px] tablet-sm:h-[56px] justify-center rounded-btn-72 bg-black-full hover:bg-yellow-primary flex items-center border-black border-solid border-2 text-base-font text-white hover:text-black-full font-medium btn-icon-fill" href="{{ $fields['get_directions_link'] }}" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
        <span>Get Directions</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
<path :fill="isHovered ? 'black' : 'white'"
    d="M13.5837 15.668H13.2503V16.0013V19.668H11.2503L11.2503 14.668L11.2503 14.6672C11.2496 14.3749 11.3449 14.1448 11.5354 13.9543C11.7259 13.7638 11.9567 13.668 12.2503 13.668H18.2503H18.5837V13.3346V10.806L22.4456 14.668L18.5837 18.5299V16.0013V15.668H18.2503H13.5837ZM14.6198 28.2993L14.6194 28.2989L3.95269 17.6323C3.71454 17.3941 3.54034 17.1356 3.42506 16.8567L3.11699 16.984L3.42506 16.8567C3.30756 16.5723 3.25033 16.2879 3.25033 16.0013C3.25033 15.7137 3.3076 15.4288 3.42506 15.1446C3.54029 14.8658 3.71437 14.6079 3.9523 14.3707L3.95269 14.3703L14.6194 3.70367C14.8575 3.46551 15.116 3.29131 15.395 3.17604C15.6793 3.05853 15.9637 3.0013 16.2503 3.0013C16.5379 3.0013 16.8228 3.05858 17.107 3.17604L17.2343 2.86797L17.107 3.17604C17.3859 3.29126 17.6438 3.46534 17.8809 3.70328L17.8813 3.70367L28.548 14.3703C28.7861 14.6085 28.9603 14.867 29.0756 15.1459C29.1931 15.4303 29.2503 15.7147 29.2503 16.0013C29.2503 16.2889 29.193 16.5738 29.0756 16.858C28.9604 17.1368 28.7863 17.3947 28.5483 17.6319L28.548 17.6323L17.8813 28.2989C17.6431 28.5371 17.3847 28.7113 17.1057 28.8266C16.8213 28.9441 16.5369 29.0013 16.2503 29.0013C15.9627 29.0013 15.6779 28.944 15.3936 28.8266C15.1148 28.7113 14.8569 28.5373 14.6198 28.2993ZM16.0146 26.9037L16.2503 27.1394L16.486 26.9037L27.1527 16.237L27.3884 16.0013L27.1527 15.7656L16.486 5.09893L16.2503 4.86323L16.0146 5.09893L5.34796 15.7656L5.11225 16.0013L5.34796 16.237L10.6813 21.5703L16.0146 26.9037Z"
    stroke="white" stroke-width="0.666667" />
</svg>
</a>
</div>
<a class="max-tablet-sm:mb-4 w-full tablet-sm:w-[340px] h-[48px] tablet-sm:h-[56px] flex justify-center rounded-btn-72 bg-yellow-primary hover:bg-white border-black border-solid border-3 items-center" href="{{ $fields['order_for_collection_link']['url'] }}" target="{{ $fields['order_for_collection_link']['target'] }}">
                        <span class="text-black-full text-base-font font-medium">Order for Collection</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                            <path d="M8.74967 25.3346H12.7497V17.3346H20.7497V25.3346H24.7497V13.3346L16.7497 7.33464L8.74967 13.3346V25.3346ZM8.74967 28.0013C8.01634 28.0013 7.38879 27.7404 6.86701 27.2186C6.34434 26.696 6.08301 26.068 6.08301 25.3346V13.3346C6.08301 12.9124 6.17767 12.5124 6.36701 12.1346C6.55545 11.7569 6.81634 11.4457 7.14967 11.2013L15.1497 5.2013C15.3941 5.02352 15.6497 4.89019 15.9163 4.8013C16.183 4.71241 16.4608 4.66797 16.7497 4.66797C17.0386 4.66797 17.3163 4.71241 17.583 4.8013C17.8497 4.89019 18.1052 5.02352 18.3497 5.2013L26.3497 11.2013C26.683 11.4457 26.9443 11.7569 27.1337 12.1346C27.3221 12.5124 27.4163 12.9124 27.4163 13.3346V25.3346C27.4163 26.068 27.1555 26.696 26.6337 27.2186C26.111 27.7404 25.483 28.0013 24.7497 28.0013H18.083V20.0013H15.4163V28.0013H8.74967Z" fill="#291F19"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>

    @endwhile
    @php wp_reset_postdata(); @endphp
@endif
@php
@include('forms.contact-us')
@endphp
</section>
