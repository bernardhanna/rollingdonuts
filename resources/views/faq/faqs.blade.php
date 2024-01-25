<section class="faq-section w-full md:mt-8 md:mb-20">
    <div class="flex flex-col lg:flex-row lg:max-w-max-1514 mx-auto">
        <div class="content md:boxshadow-two md:rounded-form md:border-3 md:border-black-full md:border-solid flex flex-col justify-between md:bg-white w-full px-4 md:px-12 pt-4 md:pt-12 pb-8 lg:w-full">
            <div class="top">
                @php
                    $faqButton = get_field('faq_button');
                    $selectedFaqs = get_field('selected_faqs');
                    $bodyClasses = get_body_class();
                    $isContactPage = in_array('contact-us', $bodyClasses); // Check if it's the contact page
                @endphp

                <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-lg-font font-reg420 lg:text-leading-10">
                    @if ($isContactPage)
                        {{ get_field('faq_title') }} <!-- Display contact page title -->
                    @else
                        FAQs<!-- Display FAQs title -->
                    @endif
                </h4>

                <div id="accordion-open" data-accordion="open">
                    @if ($isContactPage)
                        @if ($selectedFaqs && is_array($selectedFaqs))
                            @foreach ($selectedFaqs as $index => $faq)
                                @include('components.accordion', ['faq' => $faq['faq'], 'index' => $index]) <!-- Include the accordion component -->
                            @endforeach
                        @endif
                    @else <!-- For (FAQs page) -->
                    @php
                    $faqs = new WP_Query(['post_type' => 'faq', 'posts_per_page' => -1]);
                    $index = 0; // Initialize the $index variable
                        @endphp

                        @foreach ($faqs->posts as $faq)
                            @include('components.accordion', ['faq' => $faq, 'index' => $index]) <!-- Include the accordion component -->
                            @php $index++; @endphp <!-- Increment the $index variable for each FAQ -->
                        @endforeach

                        @php wp_reset_postdata(); @endphp
                    @endif
                </div>
            </div>
            <div class="bottom pt-6 flex justify-center w-full">
               @include ('components.accordion-button')
            </div>
        </div>
    </div>
</section>
