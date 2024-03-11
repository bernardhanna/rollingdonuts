<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:10:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-18 17:13:58
 */
?>
@php
$mobile_menu_bg = get_field('mobile_menu_bg', 'option');
@endphp
<div @resize.window="if (window.innerWidth > 1085) open = false" x-cloak x-show="open"
    x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-full"
    class="fixed z-1 h-screen w-full top-0 left-0 flex items-center justify-center bg-black-full text-white"
    style="background-image: url('{{ $mobile_menu_bg }}'); background-repeat: no-repeat; background-size: cover; background-position: center; z-index: 99;">
    <div class="text-center">
        <ul>
            @foreach ($navigation as $item)
                <li x-data="{ isOpen: false }" class="my-8">
                    <a @click="if ({{ count($item->children) }} > 0) { isOpen = !isOpen; $event.preventDefault(); }"
                    href="{{ $item->url }}"
                    class="text-sm-md-font font-medium text-white flex items-center justify-center {{ $item->classes ?? '' }}"
                    role="menuitem"
                    aria-haspopup="{{ count($item->children) ? 'true' : 'false' }}"
                    :aria-expanded="isOpen.toString()">
                        {{ $item->label }}
                        @if (count($item->children))
                            <span x-show="!isOpen" class="iconify ml-2 text-white"
                                data-icon="mdi:menu-down" data-width="32" data-height="32"></span>
                            <span x-show="isOpen" class="iconify ml-2 text-white"
                                data-icon="mdi:menu-up" data-width="32" data-height="32"></span>
                        @endif
                    </a>
                    @if (count($item->children))
                        <ul x-show="isOpen" x-transition:enter="transition ease-in-out duration-500"
                            x-transition:enter-start="opacity-0 transform translate-y-1"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in-out duration-500"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform translate-y-full" class="submenu">
                            @foreach ($item->children as $child)
                                <li class="my-4">
                                    <a class="text-sm-md-font font-medium text-white flex items-center justify-center {{ $child->classes ?? '' }}"
                                    href="{{ $child->url }}" role="menuitem">
                                        {{ $child->label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
