<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:47:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-01 16:57:23
 */
?>
@php
$topbar_text = get_field('topbar_text', 'option');
$discount_text = get_field('discount_text', 'option');
@endphp

@if($topbar_text || $discount_text)
<section class="topbar bg-black-full hidden lg:flex">
    <div class="{{ $containerClasses }}">
        <div class="relative mx-auto p-2.5 flex justify-center items-center gap-2.5">
            <img class="icon" src="{{ get_field('icon_image', 'option') }}" alt="Rolling Donuts Dublin" width="28" height="28">
            <span class="text-yellow-primary text-xs-font font-light leading-tight tracking-widest font-laca">
                @if($topbar_text)
                    {{ $topbar_text }}
                    @php
                        $signup_link = get_field('signup_link', 'option');
                    @endphp
                    @if($signup_link)
                        <a href="{{ $signup_link['url'] }}" class="text-yellow-primary hover:text-white underline">{{ $signup_link['title'] }}</a>
                    @endif
                @endif

                @if($discount_text)
                    {{ $discount_text }}
                @endif
            </span>
        </div>
    </div>
</section>
@endif
