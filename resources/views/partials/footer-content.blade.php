<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-11 15:05:25
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-27 10:09:35
 */
?>
<div class="w-full bg-black-full">
  <div class="mx-auto pt-10 px-4 lg:max-w-max-1549">
    <div class="relative flex flex-col items-center w-full justify-center lg:flex-row lg:justify-between lg:items-start">
        <a href="{{ home_url('/') }}">
        @php
          $footerLogoImage = get_field('footer_logo', 'option');
          $footerLogoAlt = '';
        @endphp
        <img class="mb-6" src="{{ $footerLogoImage }}" alt="{{ $footerLogoAlt }}">
        </a>
        <div class="flex flex-col lg:w-1/3">
          <p class="text-white text-xs-font font-lighter font-laca pl-4 pr-4 lg:px-0 lg:text-left lg:max-w-max-358">
              {{ get_field('footer_about_text', 'option') }}
          </p>
          @php
            $twitterProfileUrl = get_field('twitter_profile_url', 'option');
            $facebookProfileUrl = get_field('facebook_profile_url', 'option');
            $tiktokProfileUrl = get_field('tiktok_profile_url', 'option');
            $instagramProfileUrl = get_field('instagram_profile_url', 'option');
        @endphp
            <div class="space-x-8 my-6 text-center lg:text-left">
                @if ($twitterProfileUrl)
                    <a href="{{ $twitterProfileUrl }}" target="_blank"><i class="fab fa-twitter text-white fa-2xl leading-none hover:text-yellow-primary"></i></a>
                @endif

                @if ($facebookProfileUrl)
                    <a href="{{ $facebookProfileUrl }}" target="_blank"><i class="fab fa-facebook text-white fa-2xl leading-none hover:text-yellow-primary"></i></a>
                @endif

                @if ($tiktokProfileUrl)
                    <a href="{{ $tiktokProfileUrl }}" target="_blank"><i class="fab fa-tiktok text-white fa-2xl leading-none hover:text-yellow-primary"></i></a>
                @endif

                @if ($instagramProfileUrl)
                    <a href="{{ $instagramProfileUrl }}" target="_blank"><i class="fab fa-instagram text-white fa-2xl leading-none hover:text-yellow-primary"></i></a>
                @endif
            </div>
         </div>
         <div class="mt-8 lg:mt-0 lg:w-1/2 lg:flex lg:flex-row lg:justify-around lg:items-start">
            @php
                $footerMenuOne = get_field('footer_menu_one', 'option');
                $footerMenuTwo = get_field('footer_menu_two', 'option');
                $footerMenuThree = get_field('footer_menu_three', 'option');
                $footerMenuFour = get_field('footer_menu_four', 'option');
            @endphp

            @if ($footerMenuOne)
                <div class="footer-menu">
                    <ul class="text-center lg:text-left">
                        @foreach ($footerMenuOne as $item)
                            <li class="mb-4 text-white hover:text-yellow-primary"><a class="xs-font font-medium text-center hover:underline" href="{{ $item['footer_menu_one_link']['url'] }}">{{ $item['footer_menu_one_link']['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($footerMenuTwo)
                <div class="footer-menu">
                    <ul class="text-center lg:text-left">
                        @foreach ($footerMenuTwo as $item)
                            <li class="mb-4 text-white hover:text-yellow-primary"><a class="xs-font font-medium text-center hover:underline" href="{{ $item['footer_menu_two_link']['url'] }}">{{ $item['footer_menu_two_link']['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($footerMenuThree)
                <div class="footer-menu">
                    <ul class="text-center lg:text-left">
                        @foreach ($footerMenuThree as $item)
                            <li class="mb-4 text-white hover:text-yellow-primary"><a class="xs-font font-medium text-center hover:underline" href="{{ $item['footer_menu_three_link']['url'] }}">{{ $item['footer_menu_three_link']['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($footerMenuFour)
                <div class="footer-menu">
                    <ul class="text-center lg:text-left">
                        @foreach ($footerMenuFour as $item)
                            <li class="mb-4 text-white hover:text-yellow-primary"><a class="xs-font font-medium text-center hover:underline" href="{{ $item['footer_menu_four_link']['url'] }}">{{ $item['footer_menu_four_link']['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
         </div>
        </div>
    </div>
    <div class="h-[2px] bg-white ml-auto mr-auto mt-4 mb-4 w-11/12 lg:max-w-max-1549"></div>
    <div class="copyright flex-col one-xl:flex-row flex items-center justify-items-center one-xl:justify-between pl-4 pr-4 one-xl:max-w-max-1549 one-xl:mx-auto one-xl:pl-0 one-xl:pr-0 lg:pb-6">
        <div class="order-last one-xl:order-first mb-2 lg:mb-0">
            <span class="text-white">&copy; {{ date('Y') }} {{ get_field('copyright_text', 'option') }}</span>
        </div>
    @php
        $copyrightMenu = get_field('copyright_menu_four', 'option');
    @endphp
    @if ($copyrightMenu)
        <div class="copyright-menu">
            <ul class="flex flex-wrap justify-center items-center text-white">
                @foreach ($copyrightMenu as $item)
                    <li class="pl-2 pr-2"><a class="text-white mob-xs-font font-lighter font-laca hover:text-yellow-primary
                         hover:underline" href="{{ $item['copyright_menu_link']['url'] }}">{{ $item['copyright_menu_link']['title'] }}</a></li>|
                @endforeach
            </ul>
        </div>
    @endif
        <div class="my-4 lg:my-0">
            @php
            $copyrightLogoImage = get_field('copyright_logo', 'option');
            $copyrightLogoAlt = '';
            @endphp
            <img src="{{ $copyrightLogoImage }}" alt="{{ $copyrightLogoAlt }}">
        </div>

        <div class="text-white mob-xs-font font-lighter font-laca text-center mb-2 lg:mb-0">
        @php
            $copyrightTextArea = get_field('copyright_text_area', 'option');
        @endphp
            {{ $copyrightTextArea }}
        </div>

    </div>
  </div>
</div>
