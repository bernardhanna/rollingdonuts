@php
$weddingTitle = get_sub_field('wedding_title') ?: 'Your dream party, Perfect wedding';
$weddingText = get_sub_field('wedding_text') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
$weddingPaddingTop = get_sub_field('wedding_padding_top') ?: '0';
$weddingPaddingBottom = get_sub_field('wedding_padding_bottom') ?: '0';
@endphp
@php
$index = 0; // Initialize index
@endphp
<div class="px-4 w-full flex flex-col justify-center items-center" style="padding-top: {{ $weddingPaddingTop }}rem;">
    <span class="text-black text-center text-md-font lg:text-lg-font font-reg420 leading-10">{{ $weddingTitle }}</span>
    <p class="text-black font-laca text-center text-sm-font mobile:text-sm-md-font font-light py-6">{{ $weddingText }}</p>
</div>
<div class="wedding-flexi" style="padding-bottom: {{ $weddingPaddingBottom }}rem;">
    <div class="flex flex-col w-full overflow-auto lg:overflow-visible scrollbar-hide lg:max-w-max-1300 mx-auto justify-start lg:justify-center items-start lg:items-center pl-4 lg:px-4">
        <div id="weddingSlider" class="flex flex-row flex-start lg:justify-between items-start lg:items-center gap-4 lg:w-full  flex-flow flex-nowrap overflow-x-auto  scrollbar-hide">
            @if(have_rows('wedding_products'))
            @php($index = 1)
            @while(have_rows('wedding_products')) @php(the_row())
            @php($productImage = get_sub_field('wedding_image'))
            @php($productLink = get_sub_field('wedding_link'))
            @php($productTitle = get_sub_field('product_title'))
            @php($productDescription = get_sub_field('product_desc'))
            <a href="{{ $productLink }}" class="rounded-sm-12 z-10 relative {{ $index == 2 ? 'h-[376px] mobile:h-[500px] lg:h-[600px] w-[276px] mobile:w-[435px] border-4 border-black product-shadow flex-col-reverse flex' : 'h-[376px] mobile:h-[500px] lg:h-[376px] w-[276px] mobile:w-[435px] lg:w-[276px] max-lg:border-4 max-lg:border-black' }} flex-col-reverse flex overflow-hidden">
                <div class="{{ $index == 2 ? '' : 'lg:overlay' }} absolute inset-0">
                    <img class="object-fit {{ $index == 2 ? 'h-[294px] mobile:h-[468px] w-full' : 'max-lg:w-full h-[294px] mobile:h-[468px] lg:h-[376px]' }}" src="{{ $productImage['url'] }}" alt="{{ $productImage['alt'] }}" class="w-full h-full object-cover">
                    @if($index !== 2)
                    <div class="absolute inset-0 lg:bg-black-full lg:opacity-40"></div>
                    @endif
                </div>
                <div class="w-full p-5 flex flex-col {{ $index == 2 ? 'bg-white justify-between relative' : 'lg:bottom-0 lg:left-0 z-10 relative lg:absolute bg-white lg:bg-transparent justify-between lg:justify-end' }}">
                    <span class="{{ $index == 2 ? 'text-black text-mob-md-font lg:text-lg-font' : 'text-black-full lg:text-white text-mob-md-font' }} font-reg420 leading-10">{{ $productTitle }}</span>
                    <p class="{{ $index == 2 ? 'text-mob-md-font text-black' : 'text-black-full lg:text-white text-mob-sm-font' }} font-lighter font-laca leading-7">{{ $productDescription }}</p>
                </div>
            </a>
            @php($index++)
            @endwhile
            @endif
        </div>
    </div>
</div>