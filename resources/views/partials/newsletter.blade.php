<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-11 10:08:36
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-24 11:33:53
 */
?>
<section class="newsletter relative">
@php
    $newsletterImage = get_field('newsletter_image', 'option');
    $newsletterAlt = ''; // Set default alt text to an empty string
    $newsletterMobileImage = get_field('newsletter_mobile_image', 'option');
    $newsletterMobileAlt = ''; // Set default alt text to an empty string
@endphp
<img class="object-cover h-[300px] w-full hidden lg:block" src="{{ $newsletterImage }}" alt="{{ $newsletterAlt }}">
<img class="flex object-cover object-top w-full h-full max-h-max-504 lg:hidden" src="{{ $newsletterMobileImage }}" alt="{{ $newsletterMobileAlt }}">
    <div class="absolute flex flex-col items-center justify-between h-full left-0 right-0 top-0 containermax-md: max-lg:py-4 pt-4 px-4
    w-full max-w-full lg:flex-row lg:mx-auto lg:max-w-max-1504">
        <div class="newsletter-content rounded-t-lg flex flex-col w-full lg:w-22pc">
            <div class="flex flex-col highlighted items-start content-start justify-start px-1 pt-1">
                <span class= "highlighted-first bg-white text-black-full text-mob-xl-font lg:text-1lg-font font-reg420 inline-flex pl-3 pr-10 pt-3 lg:rounded-t-lg">{{ get_field('footer_newsletter_title_one', 'option') }}</span>
                <span class="highlighted-second bg-white text-black-full text-mob-xl-font lg:text-1lg-font font-reg420 px-3 pb-2">{{ get_field('footer_newsletter_title_two', 'option') }}</span>
            </div>
            <p class="top-[12px] relative newsletter-text text-white text-sm-font font-lighter font-laca leading-none">{{ get_field('footer_newsletter_text', 'option') }}</p>
        </div>

        <div class="newsletter-form w-full lg:w-72-5pc">
            @include('forms.newsletter')
        </div>
    </div>
</section>
