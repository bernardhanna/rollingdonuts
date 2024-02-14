@php
    $background_image = get_sub_field('background_image');
    $section_title = get_sub_field('section_title');
    $title_heading_tag = get_sub_field('title_heading_tag');
    $icons = get_sub_field('icons');
@endphp

<section style="background-image: url('{{ $background_image }}');" class="bg-center bg-no-repeat h-[1103px] flex flex-col justify-center items-center overflow-hidden">
    <div class="w-full max-w-max-1370 max-xxl:px-4">
        <{{ $title_heading_tag }} class="text-white font-[Edmondsans] text-lg-font font-[420] relative  lg:-mt-28  max-lg:px-4 max-lg:mb-10">{{ $section_title }}</{{ $title_heading_tag }}>
    </div>
    <div class="w-full max-w-[1432px]">
        <div class="flex flex-wrap text-center gap-y-10 justify-between">
            @if($icons)
                @foreach($icons as $icon)
                    <div class="icon-container text-center flex flex-col items-center w-[33%] lg:w-[15%]">
                        <img class="object-contain h-full w-[33px] max-h-[33px] mobile:max-h-[100px]  mobile:w-full" src="{{ $icon['icon_image']['url'] }}" alt="{{ $icon['icon_image']['alt'] }}">
                        <p class="text-white text-base-font mobile:text-sm-md-font font-regular">{{ $icon['icon_text'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
