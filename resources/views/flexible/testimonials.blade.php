@php
$kudosTitle = get_sub_field('kudos_title');
$kudosHeadingTag = get_sub_field('kudos_heading_tag') ?: 'h2';
$kudosText = get_sub_field('kudos_text') ?: 'Thousands of customers have taken weddings to the next level with The Rolling Donuts';
$selectedKudos = get_sub_field('selected_kudos');
$kudosMainImage = get_sub_field('kudos_main_image');
@endphp
<section class="w-full kudos-flexi">
    <svg class="relative z-0 block mobile:hidden -bottom-40" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 390 367" fill="none">
        <path d="M-141 37.5225C-141 37.5225 -77.4426 0 11.4498 0C141.326 0 211.171 76.1981 317.958 76.1981H320.04C426.829 76.1981 496.674 0 626.55 0C715.443 0 779 37.5225 779 37.5225V367L-141 354.403V37.5225Z" fill="black" />
    </svg>
    <svg class="relative z-0 hidden mobile:block -bottom-10 md:-bottom-20 laptop:-bottom-40" width="100%" viewBox="0 0 1728 367" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M-582 37.5225C-582 37.5225 -462.623 0 -295.659 0C-51.7174 0 79.4694 76.1981 280.043 76.1981H283.953C484.531 76.1981 615.717 0 859.659 0C1026.62 0 1146 37.5225 1146 37.5225V367H-582V37.5225Z" fill="black" />
        <path d="M2300 37.5225C2300 37.5225 2180.62 0 2013.66 0C1769.72 0 1638.53 76.1981 1437.96 76.1981H1434.05C1233.47 76.1981 1102.28 0 858.341 0C691.377 0 572 37.5225 572 37.5225V367H2300V37.5225Z" fill="black" />
    </svg>
    <div class="flex justify-center w-full px-4 mx-auto text-center bg-black-full">
        @if(is_array($kudosMainImage) && !empty($kudosMainImage['url']))
        <img class="w-full object-contain bg-black-full relative -top-10 max-w-[852.196px] h-[92px] mobile:h-[129px] laptop:h-[219px]" src="{{ $kudosMainImage['url'] }}" alt="{{ $kudosMainImage['alt'] ?? 'Testimonials Image' }}">
        @elseif(is_string($kudosMainImage) && !empty($kudosMainImage))
        <img class="w-full object-contain bg-black-full relative -top-10 text-center max-w-[852.196px] h-[92px] mobile:h-[129px] laptop:h-[219px]" src="{{ $kudosMainImage }}" alt="Testimonials Image">
        @endif
    </div>
    <div class="relative z-10 w-full bg-black-full">
        <div class="flex flex-col w-full max-w-[1368px] mx-auto px-4">
            @if($kudosTitle)
            <{{ $kudosHeadingTag }} class="leading-10 text-white text-md-font lg:text-lg-font font-reg420">{{ $kudosTitle }}</{{ $kudosHeadingTag }}>
            @endif
            @if($kudosText)
            <div class="pb-5 font-light text-white font-laca text-sm-font mobile:text-sm-md-font">{{ $kudosText }}
            </div>
            @endif
        </div>
        <div id="testimonial-slider" class="relative z-50 flex flex-row justify-start w-full mx-auto splide flex-flow flex-nowrap">
            <div class="splide__track w-full max-w-[1530px] ml-auto">
                <div class="splide__list flex justify-start max-w-[1530px] cursor-pointer">
                    @if($selectedKudos)
                    @foreach($selectedKudos as $testimonial)
                    <div class="splide__slide item p-6 border-3 border-white border-solid rounded-md-32 w-full mobile:w-[497px] mobile:min-w-[497px] h-auto mobile:h-[497px] flex justify-between flex-col">
                        <div class="pb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="116" height="91" viewBox="0 0 116 91" fill="none">
                                <path
                                    d="M37.8974 3.83038L36.9937 2.57693L35.5527 3.13498C26.3029 6.71719 18.6393 13.1057 12.5572 22.191L12.5464 22.2072L12.5358 22.2236C6.73513 31.2653 3.31594 40.9628 2.30361 51.2961C1.29403 61.6013 2.7919 70.4631 6.97054 77.7454L6.98376 77.7684L6.99759 77.7911C11.5807 85.3085 18.9009 89 28.5555 89C31.499 89 34.3238 88.4658 37.0151 87.3937L37.0579 87.3767L37.0998 87.3577C39.9984 86.0457 42.529 84.3267 44.6706 82.1939C46.7928 80.0806 48.4088 77.6843 49.4952 75.0102C50.8331 72.3183 51.5085 69.4741 51.5085 66.5C51.5085 63.3235 50.85 60.3635 49.5096 57.6528C48.4322 54.7476 46.819 52.2133 44.6706 50.0739C42.5222 47.9344 39.9783 46.3288 37.0634 45.2569C34.3708 43.9348 31.5276 43.2679 28.5555 43.2679H28.4829C29.1015 40.8154 29.8435 38.7475 30.6945 37.0453C32.0618 34.5567 34.023 31.902 36.6141 29.0831C39.3978 26.3177 43.0359 23.6216 47.5667 21.0094L49.4851 19.9034L48.1901 18.1072L37.8974 3.83038ZM100.389 3.83038L99.4852 2.57693L98.0442 3.13498C88.7944 6.71719 81.1308 13.1057 75.0487 22.191L75.0379 22.2072L75.0273 22.2236C69.2266 31.2653 65.8074 40.9628 64.7951 51.2961C63.7855 61.6013 65.2834 70.4631 69.462 77.7454L69.4753 77.7684L69.4891 77.7911C74.0722 85.3085 81.3924 89 91.047 89C93.9905 89 96.8153 88.4658 99.5066 87.3937L99.5494 87.3767L99.5913 87.3577C102.49 86.0457 105.02 84.3267 107.162 82.1939C109.284 80.0806 110.9 77.6843 111.987 75.0102C113.325 72.3183 114 69.4741 114 66.5C114 63.3234 113.341 60.3635 112.001 57.6528C110.924 54.7476 109.31 52.2133 107.162 50.0739C105.014 47.9344 102.47 46.3289 99.5549 45.2569C96.8623 43.9348 94.0191 43.2679 91.047 43.2679H90.9743C91.593 40.8154 92.335 38.7475 93.186 37.0453C94.5533 34.5567 96.5145 31.902 99.1056 29.0831C101.889 26.3177 105.527 23.6216 110.058 21.0094L111.977 19.9034L110.682 18.1072L100.389 3.83038Z"
                                    fill="#FFED56" stroke="white" stroke-width="4" />
                            </svg>
                            <div class="pt-8 text-white text-base-font mobile:text-reg-font">
                                {!! get_post_field('post_content', $testimonial->ID) !!}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-white text-xs-font font-laca">{{ get_the_title($testimonial->ID) }}</span>
                            @php
                            $kudosJob = get_field('kudos_job', $testimonial->ID);
                            $kudosImage = get_field('kudos_image', $testimonial->ID);
                            @endphp
                            <span class="pb-6 text-white text-xs-font mobile:text-xs-font font-laca">{{ $kudosJob }}</span>
                            @if($kudosImage)
                            <img class="w-[40px] h-[40px]" width="40" height="40" src="{{ $kudosImage['url'] }}" alt="{{ $kudosImage['alt'] ?? 'Kudos Image' }}">
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <svg class="relative z-0 hidden mobile:block -top-10 laptop:-top-40" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 1728 367" fill="none">
        <path d="M0 329.477C0 329.477 119.377 367 286.341 367C530.283 367 661.469 290.802 862.043 290.802H865.953C1066.53 290.802 1197.72 367 1441.66 367C1608.62 367 1728 329.477 1728 329.477V0H0V329.477Z" fill="black" />
    </svg>
    <svg class="relative z-0 block mobile:hidden -top-40" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 390 366" fill="none">
        <path d="M537 328.58C537 328.58 473.374 366 384.384 366C254.367 366 184.446 290.009 77.5428 290.009L75.4593 290.009C-31.446 290.009 -101.367 366 -231.384 366C-320.374 366 -384 328.58 -384 328.58L-384 1.10364e-05L537 12.563L537 328.58Z" fill="black" />
    </svg>
</section>
