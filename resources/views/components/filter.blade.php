<div class="mt-4" x-data="{ showFilter: false, isSmallScreen: window.innerWidth <= 1084 }">
    <button @click="showFilter = !showFilter"
            :class="{
                'bg-yellow-primary': showFilter,
                'lg:bg-white': !showFilter,
                'border-black': showFilter,
                'max-lg:border-white': !showFilter,
            }"
            class="max-lg:w-[100px] max-lg:h-[36px] max-lg:rounded-[4px] border-1 max-lg:border-solid max-lg:px-2 flex items-center justify-between lg:px-10 lg:py-4">
        <span :class="{
                'text-black-full': showFilter,
                'max-lg:text-white': !showFilter && !isSmallScreen,
                'lg:text-black': !showFilter && isSmallScreen
            }"
            class="lg:text-sm-md-font font-reg420">Sort by</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none" class="hidden lg:block">
            <path d="M12.9089 23.4414C12.5998 23.4414 12.3409 23.3364 12.1321 23.1264C11.9227 22.9171 11.8179 22.6576 11.8179 22.3477L11.8179 15.7852L5.49046 7.69141C5.21772 7.32682 5.177 6.94401 5.36827 6.54297C5.55883 6.14193 5.89047 5.94141 6.36321 5.94141L21.6364 5.94141C22.1092 5.94141 22.4412 6.14193 22.6324 6.54297C22.823 6.94401 22.7819 7.32682 22.5092 7.69141L16.1817 15.7852V22.3477C16.1817 22.6576 16.0773 22.9171 15.8686 23.1264C15.6591 23.3364 15.3999 23.4414 15.0908 23.4414H12.9089Z" fill="black" fill-opacity="0.2" stroke="black"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none" class="block lg:hidden">
            <path :fill="showFilter ? 'black' : 'white'" fill-opacity="0.2" :stroke="showFilter ? 'black' : 'white'" d="M12.9089 23.0957C12.5998 23.0957 12.3409 22.9907 12.1321 22.7807C11.9227 22.5714 11.8179 22.3118 11.8179 22.002L11.8179 15.4395L5.49046 7.3457C5.21772 6.98112 5.177 6.59831 5.36827 6.19727C5.55883 5.79622 5.89047 5.5957 6.36321 5.5957L21.6364 5.5957C22.1092 5.5957 22.4412 5.79622 22.6324 6.19727C22.823 6.59831 22.7819 6.98112 22.5092 7.3457L16.1817 15.4395V22.002C16.1817 22.3118 16.0773 22.5714 15.8686 22.7807C15.6591 22.9907 15.3999 23.0957 15.0908 23.0957H12.9089Z"/>
        </svg>
    </button>
    <div id="filter-slider-container h-full" x-cloak x-show="showFilter">
        <div x-show="showFilter" class="absolute h-full w-full text-black-full flex justify-center items-center top-full left-0 right-0 my-4">
            <ul id="custom-filter" class="ml-4 lg:pl-0 flex flex-nowrap overflow-x-auto flex-row justify-start h-full items-center gap-2 max-mobile:h-[90px]">
                <li><a class="rounded-113xl border-solid border-3 border-black-full bg-white text-mob-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary" href="#" data-filter="all">All</a></li>
                @if ($ordered_categories && (is_array($ordered_categories) || is_object($ordered_categories)))
                    @foreach ($ordered_categories as $product_category)
                        <li><a class="rounded-113xl whitespace-nowrap border-solid border-3 border-black-full bg-white text-mob-md-font py-4 px-8 text-black-full font-reg420 hover:bg-yellow-primary focus:outline-none focus:ring focus:ring-violet-300 focus:bg-yellow-primary active:bg-yellow-primary" href="#" data-filter="{{ $product_category->term_id }}">{{ $product_category->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
