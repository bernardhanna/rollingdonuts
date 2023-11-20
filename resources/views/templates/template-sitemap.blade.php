<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-18 11:56:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 14:38:05
 */
?>
{{--
Template Name: Sitemap
--}}
@extends('layouts.app')

@section('content')
@include('partials.space')
<div class="mx-auto px-4 lg:max-w-max-1549">
    <h1>Sitemap</h1>

    @php
        use Log1x\Navi\Navi;

        if ($navi = (new Navi())->build('sitemap_navigation')) {
            $navigation = $navi->toArray();
        }
    @endphp

    @if (isset($navigation) && !empty($navigation))
        <ul class="sitemap-menu">
            @foreach ($navigation as $item)
                <li class="sitemap-menu-item {{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }}">
                    <a href="{{ $item->url }}">
                        {{ $item->label }}
                    </a>

                    @if ($item->children)
                        <ul class="sitemap-sub-menu">
                            @foreach ($item->children as $child)
                                <li class="sitemap-sub-menu-item {{ $child->classes ?? '' }} {{ $child->active ? 'active' : '' }}">
                                    <a href="{{ $child->url }}">
                                        {{ $child->label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection