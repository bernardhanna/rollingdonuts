@php
$paddingTop = get_sub_field('padding_top') ?? '0';
$paddingBottom = get_sub_field('padding_bottom') ?? '0';
@endphp
<section class="donut-flexi w-full px-4 lg:px-4 xl:px-12">
    <div class="flex flex-col tablet-sm:flex-row justify-between mx-auto w-full" style="
    padding-top: {{ get_sub_field('padding_top') ?? '0' }};
    padding-bottom: {{ get_sub_field('padding_bottom') ?? '0' }};
">
        @if(have_rows('donuts'))
        @while(have_rows('donuts')) @php(the_row())
        @php($image = get_sub_field('donut_image'))
        @php($link = get_sub_field('donut_link'))
        <div class="flex w-full tablet-sm:w-31-5 border-4 border-black relative overflow-hidden h-[400px] lg:h-[345px] rounded-sm-12 mx-auto justify-center mb-6 lg:mb-0">
            <img src="{{ $image }}" class="absolute w-full h-full object-cover" alt="Donut Image">
            <a href="{{ $link['url'] }}" class="flex rounded-lg-x flex-row absolute bottom-5 cursor-pointer bg-white hover:bg-yellow-primary w-90 macbook:w-[348.18px] h-[40px] lg:h-[77px] text-sm-font lg:text-1lg-font font-medium text-black-full items-center justify-center lg:justify-start" target="{{ $link['target'] }}">
                <svg class="hidden lg:block mx-4" xmlns="http://www.w3.org/2000/svg" width="54" height="53" viewBox="0 0 54 53" fill="none">
                    <path
                        d="M51.8394 26.6878C51.8394 40.2977 40.8065 51.3306 27.1966 51.3306V52.9205C41.6845 52.9205 53.4293 41.1757 53.4293 26.6878H51.8394ZM27.1966 2.04493C40.8065 2.04493 51.8394 13.0779 51.8394 26.6878H53.4293C53.4293 12.1999 41.6845 0.455069 27.1966 0.455069V2.04493ZM2.55372 26.6878C2.55372 13.0779 13.5867 2.04493 27.1966 2.04493V0.455069C12.7086 0.455069 0.963858 12.1999 0.963858 26.6878H2.55372ZM27.1966 51.3306C13.5867 51.3306 2.55372 40.2977 2.55372 26.6878H0.963858C0.963858 41.1757 12.7086 52.9205 27.1966 52.9205V51.3306ZM34.8814 26.6868C34.8814 30.9307 31.441 34.3711 27.1971 34.3711V35.9609C32.3191 35.9609 36.4713 31.8088 36.4713 26.6868H34.8814ZM27.1971 19.0024C31.441 19.0024 34.8814 22.4428 34.8814 26.6868H36.4713C36.4713 21.5648 32.3191 17.4126 27.1971 17.4126V19.0024ZM19.5128 26.6868C19.5128 22.4428 22.9532 19.0024 27.1971 19.0024V17.4126C22.0751 17.4126 17.9229 21.5648 17.9229 26.6868H19.5128ZM27.1971 34.3711C22.9532 34.3711 19.5128 30.9307 19.5128 26.6868H17.9229C17.9229 31.8088 22.0751 35.9609 27.1971 35.9609V34.3711Z"
                        fill="#362E2A" />
                    <path
                        d="M52.5713 30.3558C52.5674 30.424 52.552 30.4802 52.5327 30.5484C52.5211 30.5805 52.5096 30.6206 52.498 30.6687L52.4324 30.9255L52.2124 30.7891C50.9738 30.0189 49.5847 29.6658 48.2381 29.3249C47.9062 29.2406 47.5705 29.1524 47.2387 29.0641C44.5261 28.318 42.9826 26.1036 43.11 23.1351C43.1254 22.7259 43.1563 22.3168 43.1871 21.9076C43.2797 20.664 43.3762 19.3763 43.0752 18.1408C42.0411 13.8444 39.4751 11.1246 35.4544 10.0496C35.165 9.97334 34.8718 9.90113 34.5785 9.82893C34.1464 9.72463 33.6949 9.62033 33.2589 9.48795C30.7546 8.73378 29.2421 6.5796 29.3192 3.86782C29.3269 3.57899 29.354 3.29417 29.3771 3.00534C29.4041 2.66838 29.435 2.32339 29.435 1.98642C29.435 1.76579 29.4581 1.52109 29.6202 1.37266C29.7823 1.22423 30.0176 1.23627 30.2453 1.26836C34.4049 1.86206 38.1053 3.33429 41.2424 5.64091C49.3686 11.6181 53.181 19.9379 52.5713 30.3558V30.3558Z"
                        fill="#362E2A" />
                </svg>
                {{ $link['title'] }}
            </a>
        </div>
        @endwhile
        @endif
    </div>
</section>