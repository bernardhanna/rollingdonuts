<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 12:47:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-14 11:57:58
 */
?>
<section class="sitelinks flex flex-col lg:hidden p-4">
  @php
      $site_links = get_field('site_links', 'option');
  @endphp

  @if($site_links && is_array($site_links))
      @foreach($site_links as $link)
          @if(isset($link['site_links']) && $link['site_links']['url'])
              <a href="{{ esc_url($link['site_links']['url']) }}" class="flex items-center justify-between p-4 pl-4 rounded border border-black bg-white hover:bg-yellow-primary shadow-lg mb-4 text-sm-md-font font-medium boxshadow">
                  {{ esc_html($link['site_links']['title']) }}
                  <img src="https://api.iconify.design/ph:caret-right-bold.svg?width=18&height=18" alt="Icon">
              </a>
          @endif
      @endforeach
  @endif
</section>