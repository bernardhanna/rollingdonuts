<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-10 16:07:04
 */
?>
@extends('layouts.app')
@section('content')
@include('partials.space')
    @while(have_posts()) @php(the_post())
        @if (is_account_page())
            @include('woocommerce.custom.woocommerce-header')
        @else
            @include('partials.page-header')
        @endif
        <div class="mx-auto px-4 lg:max-w-max-1549 pt-12 pb-20">
            @includeFirst(['partials.content-page', 'partials.content'])
        </div>
    @endwhile
@endsection
