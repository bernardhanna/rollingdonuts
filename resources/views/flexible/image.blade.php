<section class="image-flexi w-full px-4">
    <div class="max-w-max-1364 m-auto">
        @php
            $image = get_sub_field('image_content');
            $srcset = wp_get_attachment_image_srcset($image['ID']);
            $sizes = '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 25vw';
        @endphp

        @if($image)
        <img class="w-full rounded-img object-cover h-auto lg:min-h-[408px]"
             src="{{ $image['url'] }}"
             alt="{{ $image['alt'] ?? 'Default image description' }}"
             srcset="{{ $srcset }}"
             sizes="{{ $sizes }}">
        @endif
    </div>
</section>
