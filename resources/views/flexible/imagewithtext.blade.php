@php
// Assuming this partial is included within a loop of flexible content fields
$reverseLayout = get_sub_field('reverse_layout');
$flexDirectionClass = $reverseLayout ? 'flex-col md:flex-row-reverse' : 'flex-col md:flex-row';

// Retrieve the sub fields for the current layout
$eventImage = get_sub_field('event_image');
$eventHeading = get_sub_field('event_heading');
$eventText = get_sub_field('event_text');
$eventButton = get_sub_field('event_button');
@endphp

<section class="event-flexi">
    <div class="flex {{ $flexDirectionClass }} lg:max-w-max-1584 mx-auto px-4">
        <div class="md:w-1/2 text-left">
            @if ($eventImage)
                <img class="h-[325px] lg:max-w-max-95 lg:max-h-max-645 lg:h-full lg:w-full object-cover border-4 border-black-full lg:border-none rounded-20px w-auto mx-auto shadow-small lg:shadow-none" src="{{ $eventImage['url'] }}" alt="{{ $eventImage['alt'] }}">
            @endif
        </div>
        <div class="content md:w-1/2 desktop:pt-24 lg:flex lg:flex-col lg:pl-8 xxl:pr-37">
            <h4 class="text-lg-font mt-6 font-reg420 pb-5 leading-3xl">{{ $eventHeading }}</h4>
            <p class="text-reg-font text-black-font leading-none lg:w-5/6">{!! $eventText !!}</p>
            @if ($eventButton)
                <a class="btn mt-16 w-full h-[56px] max-w-[318px] text-white text-sm-md-font lg:mob-lg-font font-420 bg-black-full border-radius-large py-4 font-reg420 hover:bg-yellow-primary hover:text-black-full lg:w-full" href="{{ $eventButton['url'] }}" class="button">{{ $eventButton['title'] }}</a>
            @endif
        </div>
    </div>
</section>
