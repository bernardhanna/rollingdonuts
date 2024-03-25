<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-08 12:35:29
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-19 16:38:15
 */
?>
@if(!is_checkout() && !is_account_page())
@if(function_exists('do_shortcode') && get_field('instagram_username', 'option'))
<section class="w-full instagram-posts relative lg:overflow-hidden">
<div class="lg:max-w-max-1571 mx-auto pb-20 overflow-hidden max-mobile:px-4 tablet-sm:px-4">
    <div class="py-8 px-4 tablet-sm:px-0 flex flex-col justify-start items-start">
        <span class="text-reg-font font-medium text-black-full leading-none">{{ get_field('instagram_feed_title', 'option') }}</span>
        <span class="text-1lg-font font-reg420 text-black-full leading-none py-4">{{ get_field('instagram_feed_subtitle', 'option') }}</span>
        @php
        $instagramProfileUrl = get_field('instagram_profile_url_option', 'option');
                $instagramUsername = get_field('instagram_username', 'option');
@endphp
<style>
    @media (width <= 768px) {
     .instagram-posts .swiper-button-next::after{
     content: "";
    background-image: unset;
    background-size: contain;
    background-repeat: no-repeat;
    width: 1.5rem;
    height: 1.5rem;
    vertical-align: -0.125em;
    background-image: none !important;
    content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M10.707 17.707L16.414 12l-5.707-5.707l-1.414 1.414L13.586 12l-4.293 4.293z'/%3E%3C/svg%3E") !important;
  }
}
  </style>
@if($instagramUsername)
<a href="{{ get_field('instagram_profile_url_option', 'option') }}" target="_blank" class="flex items-center pb-2 hover:underline">
<span class="text-mob-md-font tracking-widest font-regular text-black-secondary leading-none mr-2">{{ get_field('instagram_username', 'option') }}</span>
<span class="iconify text-black-secondary" data-icon="bi:instagram" data-width="32" data-height="32"></span>
</a>
@endif
</div>
{!! do_shortcode('[insta-gallery id="0"]') !!}
    </div>
</section>
@endif
@endif
