<div class="border-b border-black-full lg:bg-white">
    <div id="accordion-open-heading-{{ $index }}">
        <button id="accordionButton" type="button" class="flex items-center justify-between w-full font-medium text-left py-3" data-accordion-target="#accordion-open-body-{{ $index }}" aria-expanded="false" aria-controls="accordion-open-body-{{ $index }}" x-data="{ isRotated: false }" x-on:click="isRotated = !isRotated">
            <span class="flex items-center text-black-full text-sm-font lg:text-reg-font font-medium">{{ $info['info_title'] }}</span>
            <div class="w-6 h-6 bg-yellow-primary border-solid border-1 border-black-full rounded-full flex justify-center items-center" x-bind:class="{ 'rotate-180': isRotated }">
                <span class="iconify h-full text-black text-md-font" data-icon="pajamas:chevron-down"></span>
            </div>
        </button>
    </div>
    <div id="accordion-open-body-{{ $index }}" class="hidden transition-all duration-500" aria-labelledby="accordion-open-heading-{{ $index }}">
        <div class="lg:pt-5 pb-5 leading-tight max-md:text-sm-font text-sm-font font-light font-laca w-full max-lg:w-11/12 transition-all duration-500">
            @foreach ($info['add_info'] as $subInfo)
            <div>
                <h5>{{ $subInfo['subinfo_text'] }}</h5>
                <img src="{{ $subInfo['subinfo_icon']['url'] }}" alt="{{ $subInfo['subinfo_icon']['alt'] }}" style="width: 100px; height: auto;">
            </div>
            @endforeach
        </div>
    </div>
</div>
