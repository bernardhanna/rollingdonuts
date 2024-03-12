<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-11 15:05:25
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-27 10:09:35
 */
?>
<div class="w-full bg-black-full">
  <div class="mx-auto pt-10 px-4">
    <div class="lg:max-w-max-1549 m-auto relative flex flex-col items-center w-full justify-center lg:flex-row lg:justify-between lg:items-start">
        <div class="w-full lg:w-35 flex flex-col max-lg:items-center lg:flex-row justify-between">
            <a class="w-full max-w-max-40" href="{{ home_url('/') }}">
            @php
$footerLogoImage = get_field('footer_logo', 'option');
              $footerLogoAlt = '';
            @endphp
            <img class="h-[139px] w-[149px] mb-6 lg:mb-2" src="{{ $footerLogoImage }}" alt="{{ $footerLogoAlt }}">
            </a>
            <div class="flex flex-col">
              <p class="text-white text-xs-font font-lighter max-tablet-sm:text-center font-laca pr-4 lg:px-0 lg:text-left lg:max-w-max-358">
{{ get_field('footer_about_text', 'option') }}
              </p>
              @php
$twitterProfileUrl = get_field('twitter_profile_url', 'option');
                $facebookProfileUrl = get_field('facebook_profile_url', 'option');
                $tiktokProfileUrl = get_field('tiktok_profile_url', 'option');
                $instagramProfileUrl = get_field('instagram_profile_url', 'option');
            @endphp
                <div class="space-x-8 my-6 text-center flex max-lg:justify-center lg:text-left">
                    @if ($twitterProfileUrl)
                        <a href="{{ $twitterProfileUrl }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" class="text-white h-8 leading-none hover:text-yellow-primary" viewBox="0 0 512 512"><path class="fill-white hover:fill-yellow-primary" d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>
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
             </div></div>
<div class="w-full mt-8 lg:mt-0 lg:w-60 flex flex-col justify-around mobile:flex-row mobile:flex-wrap mobile:justify-around lg:flex lg:flex-row lg:justify-around lg:items-start">
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
    <div class="px-4 h-[2px] bg-white ml-auto mr-auto my-4 lg:max-w-max-1552"></div>
<div class="px-4 copyright flex-col xl:flex-row flex items-center justify-items-center laptop:justify-between pl-4 pr-4 macbook:max-w-max-1549 macbook:mx-auto desktop:pl-0 desktop:pr-0 lg:pb-6">
    <div class="order-last laptop:order-first mb-[10px] lg:mb-0 flex items-center flex-col xl:flex-row my-4 xl:my-0">
<span class="text-white text-mob-xs-font font-lighter">&copy; {{ date('Y') }} {{ get_field('copyright_text', 'option') }}</span>
            @php
$copyrightMenu = get_field('copyright_menu_four', 'option');
        @endphp
        @if ($copyrightMenu)
            <div class="copyright-menu">
                <ul class="flex flex-wrap justify-center items-center text-white">
                    @foreach ($copyrightMenu as $item)
                        <li class="pl-2 pr-2"><a class="text-white text-mob-xs-font font-lighter font-laca hover:text-yellow-primary
                             hover:underline" href="{{ $item['copyright_menu_link']['url'] }}">{{ $item['copyright_menu_link']['title'] }}</a></li>|
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
        <div class="w-full laptop:w-40 macbook:1/2 flex flex-col items-center lg:flex-row max-md:items-center justify-between">
<div class="my-4 xl:my-0">
                @php
$copyrightLogoImage = get_field('copyright_logo', 'option');
                $copyrightLogoAlt = '';
                @endphp
                <img src="{{ $copyrightLogoImage }}" alt="{{ $copyrightLogoAlt }}">
            </div>

<div class="text-white text-mob-xs-font font-lighter font-laca text-center mb-2 lg:mb-0 my-4 xl:my-0">
            @php
$copyrightTextArea = get_field('copyright_text_area', 'option');
            @endphp
                {{ $copyrightTextArea }}
            </div>
      </div>
    </div>
  </div>
</div>
