<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    @include('utils.styles')
</head>

<body <?php body_class('p-0 w-full'); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>

<div id="app">
    <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content') }}
    </a>

@include('sections.header')

{{-- Determine if it's the WooCommerce "Thank You" (Order Received) page --}}
@php
$is_thank_you_page = function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-received');
$ty_bg = get_field('ty_bg', 'option');
@endphp

{{-- Apply conditional classes and styles --}}
<div class="{{ $is_thank_you_page ? 'w-full bg-cover bg-no-repeat bg-black-full' : 'mx-auto min-h-full' }}" style="{{ $is_thank_you_page && $ty_bg ? ' background-image: url('.$ty_bg.');' : '' }}">
    @yield('content')
</div>

@include('sections.footer')
        </div>

<?php do_action('get_footer'); ?>
<?php wp_footer(); ?>
@include('utils.scripts')
    </body>

</html>
