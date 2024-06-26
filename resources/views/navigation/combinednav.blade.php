<ul class="hidden w-full nav-combined lg:flex laptop:hidden lg:justify-between lg:items-center lg:ml-4 lg:relative laptop:-left-4 one-xl:ml-0 one-xl:mr-0" role="menubar">
    @php
        $allNavigationItems = array_merge($navigation_left, $navigation_right);
    @endphp
    @foreach ($allNavigationItems as $item)
        <li x-data="{ open: false }" class="relative lg:px-2 laptop:px-6 one-xl:px-12 group" role="none">
            <div @mouseenter="open = true" @mouseleave="open = false">
                <a class="{{ $loop->last ? 'btn-menu' : '' }} text-reg-font font-reg420 text-black-full whitespace-nowrap flex items-center hover:underline {{ (home_url($_SERVER['REQUEST_URI']) == $item->url) ? 'active' : '' }}"
                   href="{{ $item->url }}" role="menuitem" aria-haspopup="{{ $item->children ? 'true' : 'false' }}" aria-expanded="false">
                    {{ $item->label }}
                    @if ($item->children)
                        <span class="iconify laptop:ml-2 group-hover:hidden" data-icon="basil:caret-down-outline"></span>
                        <span class="hidden iconify laptop:ml-2 group-hover:block" data-icon="basil:caret-up-solid"></span>
                    @endif
                </a>
                @if ($item->children)
                    <div x-cloak x-show.transition.opacity="open" class="submenu absolute flex flex-col left-0 mt-0 bg-white pt-2 z-50 w-[200px]" role="menu">
                        @foreach ($item->children as $child)
                            <a class="{{ !$loop->first ? 'border-t border-black' : '' }} {{ !$loop->last ? 'border-b border-black' : '' }} py-4 px-4 w-full text-reg-font font-reg420 text-black-full hover:bg-yellow-primary hover:text-black-full" href="{{ $child->url }}" role="menuitem">
                                {{ $child->label }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
