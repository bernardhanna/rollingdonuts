<section class="info-section w-full md:mt-8 md:mb-20">
    <div class="flex flex-col lg:flex-row lg:max-w-max-1514 mx-auto">
        <div class="content md:boxshadow-two md:rounded-form md:border-3 md:border-black-full md:border-solid flex flex-col justify-between md:bg-white w-full px-4 md:px-12 pt-4 md:pt-12 pb-8 lg:w-full">
            <div class="top">
                <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-lg-font font-reg420 lg:text-leading-10">
                    Information
                </h4>
                <div class="border border-black border-solid rounded-sm-8" id="info-open" data-accordion="open" x-data="{ open: null }">
                    @php
                    $informationData = get_field('selected_info');
                    @endphp

                    @if (is_array($informationData))
                        @foreach ($informationData as $index => $info)
                        <div class="p-4">
                            <div id="info-open-heading-{{ $index }}">
                                <button id="accordionButton-{{ $index }}" type="button" class="flex justify-between items-center w-full font-medium text-left py-3"
                                        @click="open = open === {{ $index }} ? null : {{ $index }}"
                                        :aria-expanded="open === {{ $index }}"
                                        aria-controls="info-open-body-{{ $index }}">
                                    <div class="flex items-center">
                                        @if (isset($info['info_icon']) && is_array($info['info_icon']))
                                        <img src="{{ $info['info_icon']['url'] }}" alt="{{ $info['info_icon']['alt'] ?? 'Info icon' }}" class="w-12 h-12 flex justify-center items-center mr-2">
                                        @endif
                                        <span class="flex items-start text-black-full text-sm-font lg:text-reg-font font-medium">{{ $info['info_title'] ?? 'No title' }}</span>
                                    </div>
                                    <div class="w-12 h-12 flex justify-center items-center">
                                        <span class="iconify h-full text-black text-md-font"
                                              :data-icon="open === {{ $index }} ? 'icon-park-outline:minus' : 'icon-park-outline:plus'"></span>
                                    </div>
                                </button>
                            </div>
                            <div id="info-open-body-{{ $index }}" class="transition-all duration-500"
                                 x-show="open === {{ $index }}"
                                 style="display: none;"
                                 aria-labelledby="info-open-heading-{{ $index }}">
                                <div class="leading-tight max-md:text-sm-font text-sm-font font-light font-laca w/full max-lg:w-11/12 transition-all duration-500">
                                    @if (isset($info['add_info']) && is_array($info['add_info']))
                                        @foreach ($info['add_info'] as $subInfo)
                                        <div class="flex flex-wrap items-center border-t border-grey-disabled border-solid py-4">
                                            @if (isset($subInfo['subinfo_icon']) && is_array($subInfo['subinfo_icon']))
                                            <img src="{{ $subInfo['subinfo_icon']['url'] }}" alt="{{ $subInfo['subinfo_icon']['alt'] ?? 'Sub-info icon' }}" class="w-8 h-8 flex justify-center items-center mr-2">
                                            @endif
                                            <span class="flex items-start text-black-full text-sm-font lg:text-reg-font font-medium">{{ $subInfo['subinfo_text'] ?? 'No text' }}</span>
                                        </div>
                                        @endforeach
                                    @else
                                        <p>No sub-information available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No information available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
