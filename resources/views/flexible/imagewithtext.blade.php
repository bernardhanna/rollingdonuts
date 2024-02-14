@php
$reverseLayout = get_sub_field('reverse_layout_imgtxt');
$flexDirectionClass = $reverseLayout ? 'flex-col md:flex-row-reverse' : 'flex-col md:flex-row';
$contentJustification = get_sub_field('content_justification_imgtxt') ?: 'justify-center';
$eventImage = get_sub_field('event_image_imgtxt');
$eventHeading = get_sub_field('event_heading_imgtxt');
$eventText = get_sub_field('event_text_imgtxt');
$eventButton = get_sub_field('event_button_imgtxt');
$imageDimensions = get_sub_field('image_dimensions');
$imageStyle = '';
@endphp

<section class="event-flexi py-8">
    <div class="flex {{ $flexDirectionClass }} lg:max-w-max-1584 mx-auto px-4">
        <div class="md:w-1/2 text-left">
            @if ($eventImage)
                <img class="object-cover border-4 border-black-full lg:border-none rounded-20px w-auto mx-auto shadow-small lg:shadow-none {{ $imageStyle }}" src="{{ $eventImage['url'] }}" alt="{{ $eventImage['alt'] }}">
            @endif
        </div>
        <div class="{{ $contentJustification }} content md:w-1/2 lg:flex lg:flex-col lg:pl-8 xxl:pr-37">
            <h4 class="text-lg-font mt-6 font-reg420 pb-5 leading-3xl">{{ $eventHeading }}</h4>
            <p class="text-reg-font text-black-font leading-none lg:w-5/6">{!! $eventText !!}</p>
            @if ($eventButton)
                <a href="{{ $eventButton['url'] }}" class="btn mt-16 w-full h-[56px] max-w-[318px] text-white text-sm-md-font lg:mob-lg-font font-420 bg-black-full border-radius-large py-4 font-reg420 hover:bg-yellow-primary hover:text-black-full lg:w-full">{{ $eventButton['title'] }}</a>
            @endif
        </div>
    </div>
</section>
