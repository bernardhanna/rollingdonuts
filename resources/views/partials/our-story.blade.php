@php
$our_story_bg = get_field('background_image') ?: ''; // Add a fallback empty string
$our_stories = get_field('stories') ?: []; // Add a fallback empty array
@endphp

@if ($our_stories)
<section id="ourstory" class="our-story relative bg-black-full h-auto laptop:h-[900px]" style="background-image: url('{{ $our_story_bg }}'); background-size: cover; background-position: center;">
    <div class="relative h-full mx-auto max-w-max-site flex flex-col-reverse laptop:flex-row items-start justify-center">
      <ul class="cards relative h-full w-full laptop:w-3/5 xxl:w-3/5 insta-flow:w-6/12 list-none laptop:m-auto laptop:flex items-start laptop:items-center inline-flex flex-flow flex-nowrap overflow-x-auto flex-row justify-start laptop:justify-between">
        <svg class="yellow_donut" xmlns="http://www.w3.org/2000/svg" width="123" height="122" viewBox="0 0 123 122" fill="none">
            <path d="M64.7208 0.108263C63.5148 0.0344478 62.3039 0 61.0782 0C27.3658 0 0.0390625 27.2084 0.0390625 60.7748C0.0390625 94.3411 27.3658 121.55 61.0782 121.55C91.1184 121.55 116.088 99.9462 121.168 71.4928C121.791 68.0136 122.117 64.4311 122.117 60.7748C122.117 28.4288 96.7379 1.98318 64.7208 0.108263ZM61.0782 84.1989C48.4503 84.1989 38.2194 74.0074 38.2194 61.4391C38.2194 48.8708 48.4503 38.6793 61.0782 38.6793C73.7062 38.6793 83.937 48.8708 83.937 61.4391C83.937 74.0074 73.7012 84.1989 61.0782 84.1989Z" fill="#FBEF57"/>
            <path d="M122.117 60.7739C122.117 64.4303 121.791 68.0128 121.168 71.4919L117.832 69.5334C115.019 67.8799 112.138 67.2254 109.598 66.6447C105.53 65.7196 102.016 64.9224 98.7193 60.4491C95.4276 55.9808 95.7143 52.3983 96.0455 48.245C96.4112 43.6438 96.8313 38.4226 92.2101 32.163C87.5939 25.9035 82.4636 24.7372 77.9363 23.7087L77.8721 23.6939C73.8341 22.7737 70.3497 21.9814 67.0679 17.5328C63.8059 13.1088 64.0876 9.59025 64.4138 5.51564L64.4237 5.38769C64.483 4.65446 64.5473 3.82772 64.5868 2.97146L64.7202 0.107422C96.7374 1.98234 122.117 28.428 122.117 60.7739Z" fill="white"/>
        </svg>
        @foreach ($our_stories as $index => $story)
          <li class="story-item xl:left-12 relative flex flex-wrap items-center justify-center min-w-[309px] h-auto laptop:h-full z-{{ 30 - $index * 10 }} laptop:opacity-0 laptop:transform laptop:-translate-x-full laptop:rotate-3 laptop:scale-95 laptop:transition-all laptop:duration-700 laptop:ease-in-out laptop:h-full laptop:w-full max-laptop:ml-2 max-laptop:mr-5" title="{{ $story['title'] }}">
            @if(isset($story['image']))
              <img src="{{ $story['image'] }}" class="hidden laptop:flex w-full h-full object-cover rounded-[10px] laptop:border-12 laptop:border-white"/>
            @endif
            @if(isset($story['image_mobile']))
            <div class="relative">
                <img src="{{ $story['image_mobile'] }}" class="block laptop:hidden h-[408px w-full h-full object-cover rounded-[8px]"/>
                <div class="flex laptop:hidden absolute bottom-0 left-0 w-full p-4">
                    <span class="text-white font-laca font-light text-mob-md-font">
                        {{ $story['timeline_text'] }}
                    </span>
                </div>
            </div>
          @endif
            <div class="flex laptop:hidden bg-yellow-primary justify-center items-center text-black-full h-[80px] w-[200px] border-radius-large mt-4 button-dashes">
                <img class="h-[40px] w-[40px]" src="{{ $story['donut_img'] }}"/>
                <span class="text-center font-reg420 text-md-font ml-4">{{ $story['timeline_button'] }}</span>
            </div>
          </li>
        @endforeach
      </ul>
      <div class="text-contents px-4 laptop:px-0 w-full laptop:w-4/12 relative h-full laptop:-left-16 xxl:-left-24 flex items-center justify-center">
        @foreach ($our_stories as $index => $story)
          <div class="text-content{{ $index === 0 ? ' active' : '' }} w-full flex flex-col items-center justify-center h-full laptop:pl-16 laptop:pr-20 relative" data-index="{{ $index }}">
            <h3 class="text-mob-xxl-font text-lg font-reg420 text-white pb- w-full flex">{{ $story['title'] }}</h3>
            <span class="text-white text-sm-md-font font-medium font-laca pb-2 w-full flex">{{ $story['span_one'] }}</span>
            <span class="text-white text-sm-md-font font-bolder laptop:font-medium font-laca pb-4 w-full flex">{{ $story['span_two'] }}</span>
            <p class="text-white text-sm-font font-lighter laptop:font-light font-laca w-full flex">{{ $story['description'] }}</p>
          </div>
        @endforeach
        <div class="absolute w-full hidden laptop:flex justify-between items-center story-arrows">
          <a href="#" class="arrow prev h-[47px] w-[47px] bg-white hover:bg-yellow-primary absolute left-0 top-1/2 transform -translate-y-1/2 text-sm-md-font font-bold z-50 rounded-full cursor-pointer flex items-center justify-center">‹</a>
          <a href="#" class="arrow next h-[47px] w-[47px] bg-white hover:bg-yellow-primary absolute right-0 top-1/2 transform -translate-y-1/2 text-sm-md-font font-bold z-50 rounded-full cursor-pointer flex items-center justify-center">›</a>
        </div>
        <svg class="black_donut" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128" fill="none">
            <g clip-path="url(#clip0_2313_15873)">
            <path d="M-0.5 63.9474C-0.5 28.4882 28.4882 -0.5 64 -0.5C99.5118 -0.5 128.447 28.4882 128.447 64.1578C128.447 99.8275 99.5118 128.553 63.7896 128.553C28.3303 128.5 -0.5 99.5644 -0.5 63.9474ZM5.02406 64.4735C5.02406 66.8409 5.2345 69.6293 5.60277 72.365C11.1794 110.928 51.584 133.656 87.3589 118.136C105.72 110.192 116.978 96.0396 121.661 76.679C121.924 75.5216 121.661 74.8377 120.766 74.1011C118.715 72.5228 116.452 71.5232 114.032 70.8919C111.928 70.3132 109.718 69.9449 107.666 69.2084C101.511 66.9988 97.8809 62.4743 96.5657 56.1611C95.8817 52.8467 96.6709 49.5322 96.6709 46.2178C96.6709 38.3789 91.8834 31.8552 84.4127 29.6982C82.3083 29.1195 80.1513 28.6986 78.0469 28.0673C71.5759 26.0155 67.7353 21.5436 66.2622 15.02C65.6835 12.3895 65.9466 9.65375 66.2622 7.02325C66.4727 5.33972 65.9466 5.02406 64.4209 5.07667C62.0534 5.18189 59.7386 5.2345 57.3711 5.49755C27.5938 8.81199 4.97145 34.0648 5.02406 64.4735ZM121.871 67.9458C121.924 67.6301 122.029 67.5249 122.029 67.367C123.344 45.4286 115.137 27.9621 97.197 15.283C89.9894 10.1799 81.8874 7.2863 73.1542 6.07626C72.1546 5.91843 71.8389 6.18148 71.8389 7.18108C71.8389 8.49633 71.6285 9.86419 71.5759 11.1794C71.418 16.7035 74.6272 21.1228 79.9409 22.7011C81.5192 23.1745 83.1501 23.4902 84.781 23.9111C93.9878 26.2785 99.617 32.2235 101.879 41.3776C102.774 44.9025 102.142 48.5326 101.984 52.1101C101.721 58.2129 104.931 62.7374 110.77 64.263C114.558 65.2626 118.399 65.894 121.871 67.9984V67.9458Z" fill="white"/>
            <path d="M122.081 67.2626C122.081 67.2626 122.081 67.5257 121.976 67.6835C121.976 67.7361 121.976 67.8413 121.924 67.9466L121.766 68.4727L121.292 68.157C118.557 66.5261 115.505 65.7895 112.506 65.053C111.77 64.8952 111.033 64.6847 110.297 64.4743C104.299 62.896 100.932 58.2137 101.195 51.9005C101.195 51.0061 101.3 50.1643 101.353 49.27C101.563 46.6395 101.774 43.9037 101.09 41.2732C98.8277 32.1717 93.1458 26.3846 84.2547 24.1223C83.6234 23.9645 82.9921 23.8067 82.3081 23.6488C81.3612 23.4384 80.3616 23.228 79.4146 22.9123C73.8905 21.334 70.5761 16.7569 70.7339 10.9698C70.7339 10.3385 70.7865 9.75977 70.8391 9.12845C70.8917 8.39191 70.9444 7.65537 70.9444 6.97144C70.9444 6.49794 70.9444 5.97184 71.3652 5.65618C71.7861 5.34052 72.2596 5.34052 72.7331 5.44574C81.8873 6.70838 90.0944 9.81238 96.9864 14.7051C114.926 27.3842 123.344 45.0612 121.976 67.1574L122.081 67.2626Z" fill="white"/>
            <path d="M5.02344 64.4738C5.02344 34.1177 27.5932 8.81227 57.3705 5.44522C59.738 5.18217 62.0528 5.18217 64.4203 5.02434C65.9459 4.91912 66.472 5.28739 66.2616 6.97091C65.8933 9.60142 65.6303 12.3371 66.2616 14.9677C67.7347 21.4913 71.5752 25.9632 78.0463 28.015C80.1507 28.6463 82.3077 29.0672 84.4121 29.6459C91.9353 31.8029 96.7229 38.3265 96.6702 46.1654C96.6702 49.4799 95.8811 52.7943 96.565 56.1088C97.8803 62.4746 101.51 66.9464 107.666 69.1561C109.718 69.8926 111.927 70.3135 114.032 70.8396C116.504 71.4709 118.766 72.5231 120.766 74.0488C121.713 74.7854 121.923 75.5219 121.66 76.6267C116.925 96.0398 105.667 110.139 87.3583 118.083C51.5834 133.603 11.2314 110.876 5.60215 72.3127C5.18127 69.577 5.02344 66.7886 5.02344 64.4212V64.4738ZM38.3256 63.8951C38.3256 78.1524 49.742 89.7266 63.8415 89.7266C78.0989 89.7266 89.7257 78.2576 89.7257 64.0529C89.7257 49.9008 78.2041 38.3265 64.052 38.3265C49.8473 38.3265 38.3256 49.7429 38.273 63.8951H38.3256Z" fill="#0E1217"/>
            <path d="M38.3262 63.9476C38.3262 49.7955 49.9004 38.3265 64.1051 38.3791C78.2572 38.3791 89.7789 50.0059 89.7789 64.1054C89.7789 78.3102 78.152 89.8318 63.8947 89.7792C49.7426 89.7792 38.3262 78.2049 38.3788 63.9476H38.3262ZM84.2022 64.0002C84.2022 52.7943 74.9954 43.7453 63.8421 43.8505C52.7413 43.9558 43.745 53.0047 43.7976 64.1054C43.7976 75.2588 52.9518 84.3603 64.1051 84.2551C75.2059 84.1499 84.2022 75.0483 84.1496 64.0002H84.2022Z" fill="white"/>
            <path d="M64.2638 87.1487C77.0193 87.1487 87.3597 76.8083 87.3597 64.0529C87.3597 51.2974 77.0193 40.957 64.2638 40.957C51.5083 40.957 41.168 51.2974 41.168 64.0529C41.168 76.8083 51.5083 87.1487 64.2638 87.1487Z" stroke="white" stroke-miterlimit="10"/>
            <path d="M64.2637 125.238C98.0555 125.238 125.449 97.8446 125.449 64.0527C125.449 30.2609 98.0555 2.86719 64.2637 2.86719C30.4718 2.86719 3.07812 30.2609 3.07812 64.0527C3.07812 97.8446 30.4718 125.238 64.2637 125.238Z" stroke="white" stroke-miterlimit="10"/>
            </g>
            <defs>
            <clipPath id="clip0_2313_15873">
            <rect width="129" height="129" fill="white" transform="translate(-0.5 -0.5)"/>
            </clipPath>
            </defs>
            </svg>
      </div>
    </div>
</section>
@endif
