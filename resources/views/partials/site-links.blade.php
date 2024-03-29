<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:47:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-07 15:07:31
 */
?>

@php
$hideSection = 'lg:hidden';  // Default to hide

// Show on large devices for these templates or WooCommerce archive pages:
if (is_page_template('templates/template-locations.blade.php') ||
    is_page_template('templates/template-faqs.blade.php') ||
    is_page_template('templates/template-flexi.blade.php') ||
    is_page_template('templates/template-contact.blade.php') ||
    is_woocommerce() || // For any WooCommerce page
    is_shop() || // Specifically for the shop page
    is_product_category() || // For product category pages
    is_product_tag()) { // For product tag pages
        $hideSection = '';
}

    $isLocationsTemplate = is_page_template('template-locations.php');
    $paddingClass = $isLocationsTemplate ? 'px-0' : 'px-2';
@endphp

<section class="my-8 lg:max-w-max-1341 lg:mx-auto sitelinks flex flex-col {{ $paddingClass }} md:px-6 lg:p-0 {{ $hideSection }} w-full lg:grid lg:grid-rows-3 grid-flow-col gap-3">
    @php
$site_links = get_field('site_links', 'option');
  @endphp

  @if($site_links && is_array($site_links))
      @foreach($site_links as $link)
          @if(isset($link['site_links']) && $link['site_links']['url'])
              <a target="{{ $link['site_links']['target'] }}" href="{{ esc_url($link['site_links']['url']) }}" class="flex items-center justify-between p-4 pl-4 rounded-[8px] border border-black bg-white hover:bg-yellow-primary shadow-lg text-sm-md-font font-medium boxshadow h-[75px]">
                {{ html_entity_decode(esc_html($link['site_links']['title'])) }}
                  <img src="https://api.iconify.design/ph:caret-right-bold.svg?width=18&height=18" alt="Icon">
              </a>
          @endif
      @endforeach
  @endif
</section>
