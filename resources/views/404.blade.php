@extends('layouts.app')
@php
$bg_404 = get_field('bg_404', 'option');
@endphp
@section('content')
<div class="bg-cover bg-no-repeat py-24 h-full bg-black-full" style="{{ $bg_404 ? 'background-image: url(' . $bg_404 . ');' : '' }}">
    <div class="relative flex flex-col-reverse lg:flex-row justify-end lg:justify-between m-auto max-w-[1222px] h-full px-8">
        <div class="text-center w-full lg:w-1/2 flex flex-col justify-center items-center">
            <h1 class="hidden mobile:block text-[96px] font-reg420 text-white">{{ __('Oops!') }}</h1>
            <p class="text-sm-md-font font-reg420 mobile:font-lighter text-white font-laca">{{ __('Page not found.') }}</p>
            <p class="text-sm-md-font font-lighter text-white font-laca">{{ __('Can’t find what you’re looking for?') }}</p>
            <a href="{{ url('/') }}" class="rounded-btn-72 inline-flex justify-center items-center mt-8 h-[64px] text-sm-md-font text-black-full font-reg420 bg-yellow-primary hover:bg-white w-full max-w-[356px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.4139 26.688C20.6779 26.952 21.1059 26.952 21.3699 26.688L22.951 25.107C23.2148 24.8432 23.215 24.4155 22.9515 24.1514L15.1891 16.3721L22.9515 8.59286C23.215 8.32876 23.2148 7.90111 22.9509 7.6373L21.3699 6.0563C21.1059 5.79228 20.6779 5.79229 20.4139 6.0563L10.098 16.3721L20.4139 26.688Z" fill="black" />
                </svg>
                {{ __('Back to home') }}
            </a>
        </div>
        <div class="flex justify-center items-center flex-col w-full lg:w-1/2">
            @php
            $img_404_url = get_field('img_404', 'option');
            @endphp
            @if($img_404_url)
            <img src="{{ $img_404_url }}" alt="404" class="w-full h-full object-contain max-w-[268px]
            mobile:max-w-[384.457px] max-h-[232px] mobile:max-h-[332.813px]">
            @endif
</div>
</div>
</div>
@endsection
