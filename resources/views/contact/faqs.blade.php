<section class="faq-section w-full my-8">
    <div class="flex flex-col lg:flex-row lg:max-w-max-1514 mx-auto">
        @php
            $faqButton = get_field('faq_button');
        @endphp

        <div class="content boxshadow-two rounded-3xs border-2 border-black-full border-solid flex flex-col justify-between lg:bg-white w-full p-12 lg:w-full">
            <div class="top">
            <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-sm-md-font font-reg420 lg:text-leading-10">{{ get_field('faq_title') }}</h4>

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
                                <div class="w-4 h-4 bg-yellow-primary border-solid border-2 border-black-full rounded-full flex justify-center items-center" x-data="{ isRotated: false }" x-bind:class="{ 'rotate-180': isRotated }" x-on:click="isRotated = !isRotated">
                                  <span class="iconify h-full text-black text-md-font" data-icon="pajamas:chevron-down"></span>
                                </div>
                              </button>
                        </div>
                        <div id="accordion-open-body-{{ $index }}" class="hidden" aria-labelledby="accordion-open-heading-{{ $index }}">
                            <div class="pt-5 pb-5 leading-tight text-sm-font font-light font-laca">
                                {!! $faq['faq']->post_content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="bottom pt-4">
            @if ($faqButton)
                <a href="{{ $faqButton['url'] }}" class="faq-button py-4 border-radius-large flex justify-center w-auto max-w-max-368 text-sm-md-font font-reg420 bg-black-full text-white hover:bg-yellow-primary hover:text-black-full">{{ $faqButton['title'] }}</a>
            @endif
            </div>
        </div>
    </div>
</section>