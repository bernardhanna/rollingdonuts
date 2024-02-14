@php
    $selectedFaqs = get_sub_field('selected_faqs');
    $faqButton = get_sub_field('faq_button');
@endphp

@if($selectedFaqs)
<section class="faq-section w-full md:mt-8 md:mb-20">
    <div class="flex flex-col lg:flex-row lg:max-w-max-1300 mx-auto">
        <div class="content md:boxshadow-two md:rounded-form md:border-3 md:border-black-full md:border-solid flex flex-col justify-between md:bg-white w-full px-4 md:px-12 pt-4 md:pt-12 pb-8 lg:w-full">
            <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-lg-font font-reg420 lg:text-leading-10">FAQs</h4>
            <div id="accordion-open" data-accordion="open">
                @foreach ($selectedFaqs as $index => $faq)
                    @include('components.accordion', ['faq' => $faq, 'index' => $index])
                @endforeach
            </div>
            @if ($faqButton)
                <div class="bottom pt-6 flex justify-center w-full">
                    <a href="{{ $faqButton['url'] }}" class="faq-button py-4 border-radius-large flex justify-center h-[60px] w-full md:w-[368px] text-sm-md-font font-reg420 bg-black-full text-white hover:bg-yellow-primary hover:text-black-full">{{ $faqButton['title'] }}</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
