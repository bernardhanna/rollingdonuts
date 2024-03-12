<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 15:24:55
 */
?>
@if (!is_cart() && !is_checkout() && !is_single())
<section class="relative w-full z-20">
    @php
    // DESKTOP
    $image_id = get_field('page_header_bg', 'option', false);
    $image_url = wp_get_attachment_url($image_id);
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    $image_srcset = wp_get_attachment_image_srcset($image_id);
    // MOBILE
    $image_id_mobile = get_field('page_header_mobile_bg', 'option', false);
    $image_url_mobile = wp_get_attachment_url($image_id_mobile);
    $image_alt_mobile = get_post_meta($image_id_mobile, '_wp_attachment_image_alt', true);
    $image_srcset_mobile = wp_get_attachment_image_srcset($image_id_mobile);
    @endphp

@if($image_url || $image_url_mobile)
<div x-data="{
    isMobile: false, // Default state
    init() {
        this.$nextTick(() => {
            // Immediately check and set the correct background
            this.isMobile = window.innerWidth <= 575;
            this.applyBackground();

            // Ensure the element is shown after the background is applied
            this.$el.removeAttribute('x-cloak');
        });

        window.addEventListener('resize', () => {
            // Adjust background on window resize
            this.isMobile = window.innerWidth <= 575;
            this.applyBackground();
        });
    },
    applyBackground() {
        this.$el.style.backgroundImage = this.isMobile ? 'url({{ $image_url_mobile }})' : 'url({{ $image_url }})';
        this.$el.style.minHeight = '200px';
        this.$el.style.backgroundSize = 'cover';
        this.$el.style.backgroundPosition = 'center center';
    }
}" x-cloak x-init="init()">
@endif

<div class="px-4 desktop:p-0 mx-auto lg:max-w-max-1549 absolute h-full left-0 right-0 top-0 w-full">
            <?php
            if ( ! is_woocommerce() ) { ?>
                <div class="w-full flex items-start justify-start">
                    @php
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb();
                    }
                    @endphp
                </div>
             <?php }   ?>
                <div class="flex justify-center flex-col">
                    <div class="text-container relative inline-block width-fit-content mobile:m-auto">
                        <h1 class="z-10 relative text-left mobile:text-center text-white text-mob-xxl-font lg:text-xl-font xl:text-xxxl-font font-reg420">
                            @if (is_home())
                                Blog
                            @else
                              {{ html_entity_decode(get_the_title()) }}
                            @endif
                        </h1>
                    </div>
                    @php
                    $description = get_post_field('post_excerpt', get_the_ID());
                    @endphp
                    @if (!empty($description))
                        <div class="w-auto mobile:m-auto z-50 relative">
                            <span class="text-white font-Laca text-mob-md-font font-normal font-extrabold:350 leading-130 z-50 relative w-fit">
                                    {{ $description }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
    </section>
@endif
