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
<div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-full" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-full" class="fixed z-1 h-full w-full top-0 left-0 flex items-center justify-center bg-black-full text-white" style="background-image: url('{{ $mobile_menu_bg }}'); background-repeat: no-repeat; background-size: cover; background-position: center; z-index: 9;">
    <div class="text-center">
        <ul>
            @foreach ($navigation as $item)
                <li class="my-8" x-data="{ open: false }">
                    <a class="text-sm-md-font font-medium text-white flex items-center justify-center {{ $item->classes ?? '' }}" href="{{ $item->url }}" role="menuitem" aria-haspopup="{{ $item->children ? 'true' : 'false' }}" aria-expanded="false">
                        {{ $item->label }}
                        @if ($item->children)
                            <span class="iconify ml-2 text-white" data-icon="basil:caret-right-outline" data-width="32px" data-height="32px" x-show="!open"></span>
                            <span class="iconify ml-2 text-white" data-icon="basil:caret-down-outline"  data-width="32px" data-height="32px" x-show="open"></span>
                        @endif
                    </a>
                    @if ($item->children)
                        <ul class="submenu" x-show="open" x-transition:enter="transition ease-in-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in-out duration-500" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-full">
                            @foreach ($item->children as $child)
                                <li class="my-4">
                                    <a class="text-sm-md-font font-medium text-white flex items-center justify-center {{ $child->classes ?? '' }}" href="{{ $child->url }}" role="menuitem">
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

