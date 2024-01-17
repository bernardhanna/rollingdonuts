<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:06:36
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-19 10:45:19
 */
?>
<ul class="nav-left w-100 hidden laptop:flex laptop:justify-end one-xl:justify-end laptop:items-center laptop:ml-4 laptop:relative laptop:-left-4 one-xl:ml-0" role="menubar">
    @php
        $counter = 0;
    @endphp
    @foreach ($navigation_left as $item)
        @if ($counter < 3)
            <li x-data="{ open: false }" class="lg:pr-6 one-xl:pr-12 relative group" role="none">
                <div @mouseenter="open = true" @mouseleave="open = false">
                    <a class="text-reg-font font-reg420 text-black-full whitespace-nowrap flex items-center hover:underline {{ (home_url($_SERVER['REQUEST_URI']) == $item->url) ? 'active' : '' }}"
                        href="{{ $item->url }}" role="menuitem" aria-haspopup="{{ $item->children ? 'true' : 'false' }}" aria-expanded="false">
                        {{ $item->label }}
                        @if ($item->children)
                            <span class="iconify ml-2 group-hover:hidden"
                                data-icon="basil:caret-down-outline"></span>
                            <span class="iconify ml-2 hidden group-hover:block"
                                data-icon="basil:caret-up-solid"></span>
                        @endif
                    </a>
                    @if ($item->children)
                    <div x-cloak x-show.transition.opacity="open" class="submenu absolute flex flex-col left-0 mt-0 bg-white pt-2 z-50 w-[200px]" role="menu">
                        @foreach ($item->children as $child)
                                <a class="{{ !$loop->first ? 'border-t border-black' : '' }} {{ !$loop->last ? 'border-b border-black' : '' }} py-4 px-4 w-full text-reg-font font-reg420 text-black-full {{ $child->classes ?? '' }}  hover:bg-yellow-primary hover:text-black-full {{ $child->classes ?? '' }}" href="{{ $child->url }}" role="menuitem">
                                    {{ $child->label }}
                                </a>
                        @endforeach
                            </div>
                    @endif
                </div>
            </li>
            @php
                $counter++;
            @endphp
        @endif
    @endforeach
</ul>
