<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 12:34:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-05 11:15:17
 */
?>
@php
$bannerLeft = get_field('banner_left');
$banner_top_mobile = get_field('banner_top_mobile');
$bannerRight = get_field('banner_right');
$banner_bottom_mobile = get_field('banner_bottom_mobile');
$hazelnut = get_field('hazelnut');
$neon = get_field('neon');
$neonMobile = get_field('neon_mobile');
$hero_text = get_field('hero_text');
$hero_link = get_field('hero_link');
@endphp

@if(is_array($bannerLeft) && isset($bannerLeft['url']) && is_array($bannerRight) && isset($bannerRight['url']))
<section class="home-hero w-full relative mt-32 lg:mt-72">
    <div class="flex flex-col-reverse lg:flex-row">
        <div class="w-full flex items-center justify-center flex-col bg-black-full h-hero-mob lg:w-heroleft lg:h-hero-height"
             x-data="{ isMobile: false, getBackgroundImage() {
                     if (this.isMobile && '{{ $banner_top_mobile['url'] }}') {
                         return 'url({{ $banner_top_mobile['url'] }})';
                     }
                     return 'url({{ $bannerLeft['url'] }})';
                 }
             }"
             x-init="setTimeout(() => { isMobile = window.innerWidth < 1084 }, 0); window.addEventListener('resize', () => { isMobile = window.innerWidth < 1084 })"
             :style="{ backgroundImage: getBackgroundImage() }">
             <div class="w-full h-full bg-[#000000b5] flex justify-center items-center">
                <div class="flex flex-col relative xxl:mr-48 xl:mx-auto xxl:right-8">
                    <div class="hidden lg:block">
                        @if($neon['url'])
                            <img src="{{ $neon['url'] }}" alt="{{ $neon['alt'] ?? 'Rolling Donut Signature' }}" class="w-auto object-contain mx-auto">
                        @endif
                    </div>
                    <div class="lg:hidden">
                        @if($neonMobile['url'])
                            <img src="{{ $neonMobile['url'] }}" alt="{{ $neonMobile['alt'] ?? 'Rolling Donut Signature' }}" class="w-auto object-contain mx-auto -mt-34">
                        @endif
                    </div>
                    @if($hero_text)
                    <div class="w-full max-w-max-529 px-12 mx-auto lg:px-0 block">
                      <p class="text-white text-base-font font-laca text-center font-lighter mx-auto max-w-max-529">{{ $hero_text }}</p>
                    </div>
                   @endif
                   @if($hero_link)
                    <div class="w-full px-12 lg:px-0 pt-12 z-10">
                        <a class="mx-auto btn-width btn-icon-yellow rounded-btn-72 border-3 border-color-yellow-primary bg-black-full text-yellow-primary text-sm-md-font font-reg420 w-full md:w-[322px] h-[64px] flex flex-row items-center justify-center hover:bg-yellow-primary hover:text-black-full lg:bg-white lg:text-black-full lg:border-none" href="{{ $hero_link['url'] }}">
                            <svg class="yellow-donut mr-4 fill-yellow-primary lg:fill-black-full hover:fill-black-full" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <path d="M32 17C32 25.2843 25.2843 32 17 32V34C26.3888 34 34 26.3888 34 17H32ZM17 2C25.2843 2 32 8.71573 32 17H34C34 7.61116 26.3888 0 17 0V2ZM2 17C2 8.71573 8.71573 2 17 2V0C7.61116 0 0 7.61116 0 17H2ZM17 32C8.71573 32 2 25.2843 2 17H0C0 26.3888 7.61116 34 17 34V32ZM21.3333 17C21.3333 19.3932 19.3932 21.3333 17 21.3333V23.3333C20.4978 23.3333 23.3333 20.4978 23.3333 17H21.3333ZM17 12.6667C19.3932 12.6667 21.3333 14.6068 21.3333 17H23.3333C23.3333 13.5022 20.4978 10.6667 17 10.6667V12.6667ZM12.6667 17C12.6667 14.6068 14.6068 12.6667 17 12.6667V10.6667C13.5022 10.6667 10.6667 13.5022 10.6667 17H12.6667ZM17 21.3333C14.6068 21.3333 12.6667 19.3932 12.6667 17H10.6667C10.6667 20.4978 13.5022 23.3333 17 23.3333V21.3333Z" fill="fill-yellow-primary hover:fill-black-full"/>
                                <path d="M27.5096 14.7855L27.5095 14.7881C27.4734 15.629 27.6744 16.3322 28.0488 16.8697C28.4217 17.405 28.9875 17.8065 29.7373 18.0132C29.9445 18.0683 30.1528 18.1231 30.3582 18.1752L27.5096 14.7855ZM27.5096 14.7855C27.5189 14.5391 27.5375 14.2911 27.557 14.0322L27.5571 14.0317L27.5598 13.9953C27.6164 13.2362 27.6817 12.3607 27.4741 11.5077C26.7838 8.64063 25.0424 6.7799 22.3239 6.05299L22.3221 6.05251C22.1362 6.00355 21.9485 5.95733 21.7653 5.91224L21.7633 5.91175L21.7633 5.91174L21.7611 5.9112C21.7256 5.90264 21.6903 5.89416 21.6552 5.88574C21.4143 5.8279 21.1831 5.77239 20.959 5.70434L20.9579 5.70402C19.6097 5.29799 18.7931 4.15317 18.8356 2.66202L18.8356 2.66115C18.8392 2.52667 18.85 2.39525 18.8623 2.24692C18.865 2.21395 18.8678 2.18013 18.8706 2.14527C18.8722 2.12502 18.8739 2.10441 18.8756 2.08348C18.8897 1.9094 18.9057 1.71265 18.9082 1.51652C21.4246 1.88478 23.6525 2.77875 25.539 4.16582C30.4025 7.7431 32.7356 12.6734 32.482 18.873M27.5096 14.7855L32.482 18.873M32.482 18.873C31.7807 18.5354 31.046 18.3493 30.3819 18.1812L30.3585 18.1753L32.482 18.873Z" fill="fill-yellow-primary hover:fill-black-full" stroke="stroke-yellow-primary hover:stroke-black-full"/>
                            </svg>
                            {{ $hero_link['title'] }}
                        </a>
                   </div>
                   @endif
                </div>
            </div>
        </div>

        <div class="w-full hero-28 bg-black-full lg:bg-no-repeat lg:bg-cover lg:w-heroright lg:h-hero-height lg:flex lg:items-end"
             x-data="{ isMobile: false, getBackgroundImage() {
                     if (this.isMobile && '{{ $banner_bottom_mobile['url'] }}') {
                         return 'url({{ $banner_bottom_mobile['url'] }})';
                     }
                     return 'url({{ $bannerRight['url'] }})';
                 }
             }"
             x-init="setTimeout(() => { isMobile = window.innerWidth < 1084 }, 0); window.addEventListener('resize', () => { isMobile = window.innerWidth < 1084 })"
             :style="{ backgroundImage: getBackgroundImage() }">
             @if($hazelnut['url'])
               <img src="{{ $hazelnut['url'] }}" alt="{{ $hazelnut['alt'] ?? 'Rolling Donut' }}" class="relative inset-0 mx-auto -mb-10 lg:mb-8 px-4 lg:px-0 lg:mr-auto lg:-ml-20">
              @endif
        </div>
    </div>
    <div>
        <svg class="mb-[-1px] section-divider fill-white w-full bottom-0 absolute left-0 right-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 79.5">
            <path class="fill-white" d="M0 79.5h1440V0c-220.2 51-459.9 79.5-720 79.5C465.1 79.5 216.8 49.1 0 0v79.5z"/>
            <path class="section-divider-border" fill="none" d="M0 0s319.7 79.5 720 79.5c412.7 0 720-79.5 720-79.5"/>
        </svg>
    </div>
</section>
@endif

