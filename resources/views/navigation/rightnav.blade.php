<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:09:31
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-19 10:45:29
 */
?>
<ul class="nav-right w-100 hidden lg:relative laptop:-left-4 lg:hidden laptop:flex lg:justify-end one-xl:justify-start items-center lg:mr-4 one-xl:mr-0" role="menubar">
    @php
        $counter = 0;
    @endphp
    @foreach ($navigation_right as $item)
        @if ($counter < 4)
<li x-data="{ open: false }" class="lg:pl-2 laptop:pl-12 one-xl:pl-12 relative group" role="none">
                <div @mouseenter="open = true" @mouseleave="open = false">
                    <a class="text-reg-font font-reg420 text-black-full whitespace-nowrap flex items-center hover:underline {{ $item->classes ?? '' }}"
                        href="{{ $item->url }}" role="menuitem" aria-haspopup="{{ $item->children ? 'true' : 'false' }}">
                        {{ $item->label }}
                        @if ($item->children)
<span class="iconify laptop:ml-2 group-hover:hidden"
                                data-icon="basil:caret-down-outline"></span>
<span class="iconify laptop:ml-2 hidden group-hover:block"
                                data-icon="basil:caret-up-solid"></span>
                        @endif
                    </a>
                    @if ($item->children)
<div x-cloak x-show.transition.opacity="open" class="submenu flex flex-col absolute left-0 one-xl:left-10 mt-0 bg-white pt-2 z-500 w-[200px]" role="menu" aria-expanded="false">
                        @foreach ($item->children as $child)
                        <a class="{{ !$loop->first ? 'border-t border-black' : '' }} {{ !$loop->last ? 'border-b border-black' : '' }} py-4 px-4 w-full text-reg-font font-reg420 text-black-full {{ $child->classes ?? '' }}  hover:bg-yellow-primary hover:text-black-full" href="{{ $child->url }}" role="menuitem">
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
