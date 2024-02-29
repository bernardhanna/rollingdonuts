@php
$reverseLayout = get_sub_field('reverse_layout_imgtxt');
$flexDirectionClass = $reverseLayout ? 'flex-col md:flex-row-reverse' : 'flex-col md:flex-row';
$contentJustification = get_sub_field('content_justification_imgtxt') ?: 'justify-center';
$eventImage = get_sub_field('event_image_imgtxt');
$eventHeading = get_sub_field('event_heading_imgtxt');
$eventText = get_sub_field('event_text_imgtxt');
$eventButton = get_sub_field('event_button_imgtxt');
$imageDimensions = get_sub_field('image_dimensions');
$event_heading_tag = get_sub_field('event_heading_tag');
$imageBorder = get_sub_field('image_border');
$borderClass = $imageBorder ? 'border-4 border-black-full shadow-small lg:border-none lg:shadow-none' : '';
$imageStyle = '';
@endphp

<section class="event-flexi">
    <div class="flex {{ $flexDirectionClass }} max-w-max-1364 mx-auto px-4">
        <div class="md:w-1/2 text-left lg:p-4">
            @if ($eventImage)
<img class="rounded-20px object-cover {{ $borderClass }} w-auto mx-auto {{ $imageStyle }}" src="{{ $eventImage['url'] }}" alt="{{ $eventImage['alt'] }}">
            @endif
        </div>
<div class="{{ $contentJustification }} w-full content md:w-1/2 lg:flex lg:flex-col p-4 lg:pl-8 xxl:pr-37">
    <{{ $event_heading_tag }} class="text-lg-font lg:text-xl-font mt-6 font-reg420 pb-5 leading-3xl">{{ $eventHeading }}</{{ $event_heading_tag }}>
    <div class="text-reg-font lg:text-mob-md-font text-black-font leading-none w-full">{!! $eventText !!}</div>
            @if ($eventButton)
                <a href="{{ $eventButton['url'] }}" class="btn mt-16 w-full h-[56px] max-w-[318px] text-white text-sm-md-font lg:mob-lg-font font-420 bg-black-full border-radius-large py-4 font-reg420 hover:bg-yellow-primary hover:text-black-full lg:w-full">{{ $eventButton['title'] }}</a>
            @endif
        </div>
    </div>
</section>
