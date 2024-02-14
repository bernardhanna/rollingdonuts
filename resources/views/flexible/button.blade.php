@php
    $buttonLink = get_sub_field('button_link');
    $justifyStart = get_sub_field('justify_start');
    $justifyCenter = get_sub_field('justify_center');
    $justifyEnd = get_sub_field('justify_end');

    // Determine the alignment class based on ACF fields.
    $alignmentClass = 'justify-center'; // Default alignment.
    if ($justifyStart) {
        $alignmentClass = 'justify-start';
    } elseif ($justifyCenter) {
        $alignmentClass = 'justify-center';
    } elseif ($justifyEnd) {
        $alignmentClass = 'justify-end';
    }
@endphp

<section class="button-flexi py-4 m-auto max-w-max-1359 px-4 flex {{ $alignmentClass }}">
    <a href="{{ $buttonLink['url'] ?? '#' }}" class="single_add_to_cart_button button alt h-[70px] text-sm-md-font lg:text-md-font font-medium text-yellow-primary hover:text-black-full bg-black-full hover:bg-yellow-primary rounded-lg-x border-2 border-yellow-primary w-full flex items-center justify-center max-w-max-368">
        {{ $buttonLink['title'] ?? 'Default Text' }}
    </a>
</section>
