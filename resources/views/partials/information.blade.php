<section class="info-section w-full md:mt-8 md:mb-20">
    <div class="flex flex-col lg:flex-row lg:max-w-max-1514 mx-auto">
        <div class="content md:boxshadow-two md:rounded-form md:border-3 md:border-black-full md:border-solid flex flex-col justify-between md:bg-white w-full px-4 md:px-12 pt-4 md:pt-12 pb-8 lg:w-full">
            <div class="top">
                <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-lg-font font-reg420 lg:text-leading-10">
                    Information
                </h4>
                <div id="accordion-open" data-accordion="open">
                    @php
                    $informationData = get_field('selected_information');
                    $index = 0;
                    @endphp
                    @foreach ($informationData as $info)
                        @include('components.information-accordion', ['info' => $info, 'index' => $index])
                        @php $index++; @endphp
                    @endforeach
                </div>
            </div>
            <div class="bottom pt-6 flex justify-center w-full">
                @include('components.accordion-button')
            </div>
        </div>
    </div>
</section>
