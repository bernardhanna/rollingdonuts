@php
    $listHeading = get_sub_field('list_heading');
    $headingLevel = get_sub_field('heading_level') ?: 'h2'; // Default to h2 if not set
    $listItems = get_sub_field('list_items');
    $paddingTop = get_sub_field('padding_top');
    $paddingBottom = get_sub_field('padding_bottom');
    $paddingStyles = '';
    if (!is_null($paddingTop)) {
        $paddingStyles .= "padding-top: {$paddingTop}; ";
    }
    if (!is_null($paddingBottom)) {
        $paddingStyles .= "padding-bottom: {$paddingBottom}; ";
    }
@endphp

@if($listHeading || $listItems)
<section class="list-flexi w-full mx-auto px-2 laptop:px-4 flex justify-center" style="{{ $paddingStyles }}">
    <div class="lg:rounded-md-40 lg:border lg:border-black bg-white lg:shadow-lg max-w-[1368px] p-4 lg:p-10 boxshadow-four">
        @if($listHeading)
         <{{ $headingLevel }} class="text-mob-xxl-font text-black-full font-reg420 mb-6">{{ $listHeading }}</{{ $headingLevel }}>
        @endif

        @if($listItems)
        <ul class="list-disc pl-8 lg:pl-6">
            @foreach($listItems as $item)
            <li class="text-reg-font lg:text-sm-md-font font-reg420 mb-4 not:last-child:mb-4 lg:mb-10 lg:not:last-child:mb-10">
                {{ $item['list_item'] }}
                @if($item['list_item_content'])
                <span class="text-black-secondary text-mob-md-font font-laca font-light">{!! $item['list_item_content'] !!}</span>
                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</section>
@endif
