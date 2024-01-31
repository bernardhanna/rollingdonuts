<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 16:59:46
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-31 18:18:56
 */
?>
<section class="faq-section py-20 w-full bg-grey-background">
    <div class="flex flex-col sm:flex-row lg:max-w-max-1568 mx-auto items-start">
        @php
            $faqImage = get_field('faq_image');
            $faqButton = get_field('faq_button');
        @endphp

        @if ($faqImage)
            <div class="block w-full mx-auto lg:mx-0 pl-4 lg:p-0 pr-4 lg:pr-0 lg:w-45">
                <img class="m-auto lg:m-0 object-cover max-h-max-473 rounded-xl rounded-[15px] border-3 border-black-full" src="{{ $faqImage['url'] }}" alt="{{ $faqImage['alt'] }}">
            </div>
        @endif

        <div class="content flex flex-col justify-between lg:bg-white w-full h-full pl-4 pr-4 py-4 lg:pl-8 lg:pr-10 lg:w-55">
            <div class="top">
            <h4 class="font-reg420 lg:pb-4 lg:pt-0 lg:p-0 lg:text-mob-xxl-font text-sm-md-font lg:text-leading-10">{{ get_field('faq_title') }}</h4>

            <div id="accordion-open" data-accordion="open">
                @php
                    $selectedFaqs = get_field('selected_faqs');
                @endphp
                    @if ($selectedFaqs && is_array($selectedFaqs))
                    @foreach ($selectedFaqs as $index => $faq)
                    <div class="border-b-2 border-black-full lg:bg-white">
                        <div id="accordion-open-heading-{{ $index }}">
                            <button type="button" class="flex items-center justify-between w-full font-medium text-left py-3" data-accordion-target="#accordion-open-body-{{ $index }}" aria-expanded="false" aria-controls="accordion-open-body-{{ $index }}">
                                <span class="flex items-center text-black-full text-sm-font lg:text-reg-font font-medium">{{ $faq['faq']->post_title }}</span>
                                <div class="w-6 h-6 bg-yellow-primary border-solid border-1 border-black-full rounded-full flex justify-center items-center" x-data="{ isRotated: false }" x-bind:class="{ 'rotate-180': isRotated }" x-on:click="isRotated = !isRotated">
                                  <span class="iconify h-full text-black text-md-font" data-icon="pajamas:chevron-down"></span>
                                </div>
                              </button>
                        </div>
                        <div id="accordion-open-body-{{ $index }}" class="hidden" aria-labelledby="accordion-open-heading-{{ $index }}">
                            <div class="lg:pt-5 pb-5 leading-tight max-md:text-sm-font text-sm-font font-light font-laca w-full max-lg:w-11/12">
                                {!! $faq['faq']->post_content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="bottom md:hidden pt-4">
            @if ($faqButton)
                <a href="{{ $faqButton['url'] }}" class="faq-button py-4 border-radius-large flex justify-center w-auto max-w-max-368 text-sm-md-font font-reg420 bg-black-full text-white hover:bg-yellow-primary hover:text-black-full">{{ $faqButton['title'] }}</a>
            @endif
            </div>
        </div>
    </div>
</section>
