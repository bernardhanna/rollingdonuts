<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 15:12:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 11:14:38
 */
?>
<section class="w-full bg-white bg-cover bg-no-repeat bg-top bg-[url('/images/home/white-bg-donuts.png')]">
    <div class="py-16 lg:py-28">
        <div class="flex flex-col md:flex-row lg:max-w-max-1584 mx-auto px-4">
            <div class="md:w-1/2 text-left">
            @php
                $eventImage = get_field('event_image');
            @endphp

            @if ($eventImage)
                <img class="h-[325px] lg:max-w-max-95 lg:max-h-max-645 lg:h-full lg:w-full object-cover border-4 border-black-full lg:border-none rounded-20px w-auto mx-auto shadow-small lg:shadow-none" src="{{ $eventImage['url'] }}" alt="{{ $eventImage['alt'] }}">
            @endif
            </div>
            <div class="content md:w-1/2 desktop:pt-24 lg:flex lg:flex-col lg:pl-8 xxl:pr-37">
                <h4 class="text-lg-font mt-6 font-reg420 pb-5 leading-3xl">{{ get_field('event_heading') }}</h4>
                <p class="text-reg-font text-black-font leading-none lg:w-5/6">{{ get_field('event_text') }}</p>
                @php
                $eventButton = get_field('event_button');
                @endphp

                @if ($eventButton)
                    <a class="btn mt-16 w-full max-w-[318px] text-white text-sm-md-font lg:text-md-font font-420 bg-black-full border-radius-large py-4 font-reg420 hover:bg-yellow-primary hover:text-black-full lg:w-full" href="{{ $eventButton['url'] }}" class="button">{{ $eventButton['title'] }}<svg class="ml-2 lg:hidden" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <path class="fill-white" d="M32.5 17C32.5 25.5604 25.5604 32.5 17 32.5V33.5C26.1127 33.5 33.5 26.1127 33.5 17H32.5ZM17 1.5C25.5604 1.5 32.5 8.43959 32.5 17H33.5C33.5 7.8873 26.1127 0.5 17 0.5V1.5ZM1.5 17C1.5 8.43959 8.43959 1.5 17 1.5V0.5C7.8873 0.5 0.5 7.8873 0.5 17H1.5ZM17 32.5C8.43959 32.5 1.5 25.5604 1.5 17H0.5C0.5 26.1127 7.8873 33.5 17 33.5V32.5ZM21.8333 17C21.8333 19.6694 19.6694 21.8333 17 21.8333V22.8333C20.2217 22.8333 22.8333 20.2217 22.8333 17H21.8333ZM17 12.1667C19.6694 12.1667 21.8333 14.3306 21.8333 17H22.8333C22.8333 13.7783 20.2217 11.1667 17 11.1667V12.1667ZM12.1667 17C12.1667 14.3306 14.3306 12.1667 17 12.1667V11.1667C13.7783 11.1667 11.1667 13.7783 11.1667 17H12.1667ZM17 21.8333C14.3306 21.8333 12.1667 19.6694 12.1667 17H11.1667C11.1667 20.2217 13.7783 22.8333 17 22.8333V21.8333Z"/>
                        <path class="fill-white hover:fill-black-full" d="M32.961 19.3084C32.9585 19.3513 32.9488 19.3866 32.9367 19.4295C32.9294 19.4497 32.9221 19.4749 32.9149 19.5052L32.8736 19.6667L32.7353 19.5809C31.9562 19.0964 31.0825 18.8744 30.2354 18.6599C30.0267 18.6069 29.8156 18.5514 29.6068 18.4959C27.9006 18.0266 26.9298 16.6338 27.0099 14.7666C27.0196 14.5093 27.039 14.2519 27.0585 13.9945C27.1167 13.2124 27.1774 12.4024 26.9881 11.6253C26.3376 8.92295 24.7237 7.21224 22.1947 6.53602C22.0127 6.48808 21.8282 6.44267 21.6438 6.39725C21.372 6.33165 21.088 6.26604 20.8137 6.18278C19.2386 5.70842 18.2872 4.35347 18.3358 2.6478C18.3406 2.46613 18.3576 2.28698 18.3722 2.10531C18.3892 1.89337 18.4086 1.67637 18.4086 1.46443C18.4086 1.32565 18.4231 1.17174 18.5251 1.07838C18.627 0.985022 18.775 0.992591 18.9182 1.01278C21.5346 1.38621 23.8621 2.31222 25.8352 3.76305C30.9465 7.52259 33.3444 12.7557 32.961 19.3084V19.3084Z"/>
                        </svg></a>
                @endif
            </div>
        </div>
    </div>
    <div class="pt-8 lg:pb-24 lg:pt-0 px-4">
        <div class="flex flex-col md:flex-row-reverse lg:max-w-max-1552 mx-auto px-0 lg:px-4">
            <div class="md:w-1/2">
            @php
                $giftcardImage = get_field('giftcard_image');
            @endphp

            @if ($giftcardImage)
                <img class="mx-auto w-full max-lg:max-w-max-358 max-w-max-750" src="{{ $giftcardImage['url'] }}" alt="{{ $giftcardImage['alt'] }}">
            @endif
            </div>
            <div class="content md:w-1/2 lg:flex lg:flex-col lg:justify-center lg:pl-0 xxl:pr-44">
                <h4 class="text-lg-font mt-6 font-reg420 pb-5 leading-3xl">{{ get_field('giftcard_heading') }}</h4>
                <p class="text-reg-font text-black-font leading-none">{{ get_field('giftcard_text') }}</p>
                @php
                $giftcardButton = get_field('giftcard_button');
                @endphp

                @if ($giftcardButton)
                    <a class="btn mt-16 w-full max-w-[346px] text-white text-sm-md-font lg:text-md-font font-420 bg-black-full border-radius-large py-4 font-reg420 hover:bg-yellow-primary hover:text-black-full lg:w-full" href="{{ $giftcardButton['url'] }}" class="button">{{ $giftcardButton['title'] }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
