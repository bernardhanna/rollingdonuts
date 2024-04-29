<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-09 13:17:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:23:42
 */
?>
    <section class="relative z-50 w-full mb-0 lg:mb-12"
        x-data="{
            formState: 'login',
            activeTab: 'sign-in',
            isAccountPage: <?php echo is_account_page() ? 'true' : 'false'; ?>,
            isLoggedIn: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>,
            isTemplateBoxProducts: <?php echo is_page_template('templates/template-box-products.blade.php') ? 'true' : 'false'; ?>,
            isProductArchive: <?php echo is_post_type_archive('product') ? 'true' : 'false'; ?>,
            pageTitle: '<?php the_title(); ?>',
            init() {
                window.addEventListener('update-active-tab', (event) => {
                    this.activeTab = event.detail.tab;
                });
            }
        }">
        @php
        //Define Categories
        $args = array(
            'taxonomy'   => "product_cat",
            'hide_empty' => false,
        );
        $categories = get_terms($args);
        // DESKTOP
$image_id = get_field('woo_header_bg', 'option', false);
        $image_url = wp_get_attachment_url($image_id);
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        $image_srcset = wp_get_attachment_image_srcset($image_id);
        // MOBILE
$image_id_mobile = get_field('woo_mobile_bg', 'option', false);
        $image_url_mobile = wp_get_attachment_url($image_id_mobile);
        $image_alt_mobile = get_post_meta($image_id_mobile, '_wp_attachment_image_alt', true);
        $image_srcset_mobile = wp_get_attachment_image_srcset($image_id_mobile);
        @endphp

        @if($image_url || $image_url_mobile )
<div>
    <!-- Desktop Background -->
    <img class="object-cover w-full min-h-[243px] max-site:h-[243px] hidden sm:block" src="{{ $image_url }}" alt="{{ $image_alt }}" srcset="{{ $image_srcset }}" sizes="(min-width: 640px) 100vw">

    <!-- Mobile Background -->
    <img class="block w-full sm:hidden" src="{{ $image_url_mobile }}" alt="{{ $image_alt_mobile }}" srcset="{{ $image_srcset_mobile }}" sizes="(max-width: 639px) 100vw">
</div>
        @endif

        <div class="absolute top-0 left-0 right-0 w-full h-full mx-auto max-w-max-1485">
            <div class="w-full pl-4 lg:max-w-max-1485 desktop:pl-0">
                @php
                    woocommerce_breadcrumb();
                @endphp
            </div>
            <div class="relative flex items-center justify-between px-2 mobile:pt-8 mobile:px-4 desktop:p-0 desktop:pt-6">
                <div x-data="{ content: 'Dynamic content based on conditions' }" class="relative inline-block px-4 text-container width-fit-content desktop:p-0">
                       <h1 :class="pageTitle.length > 15 ? 'xxxs:text-tiny xs:text-base-font sm-mob:text-sm-font mobile:text-md-font sm:text-lg-font md:text-lg-font lg:text-lg-font xl:text-lg-font xxl:text-xxl-font' : 'text-mob-lg-font small:text-mob-xl-font sm:text-mob-xl-font mobile:text-mob-xxl-font md:text-mob-xxl-font tablet-sm:text-lg-font lg:text-xxl-font xl:text-xxl-font xxl:text-xxxl-font'"class="relative left-0 z-10 text-white font-reg420 text-mob-lg-font lg:text-lg-font xl:text-lg-font xxl:text-xxl-font' : 'text-tiny small:text-mob-md-font sm:text-mob-md-font mobile:text-mob-xxl-font md:text-mob-xxl-font tablet-sm:text-md-font lg:text-lg-font xl:text-lg-font xxl:text-xxxl-font" x-text="activeTab === 'register' ? 'Register' : isAccountPage && !isLoggedIn ? 'Sign In' : isTemplateBoxProducts ? 'Choose Your Own' : isProductArchive ? 'Our Donuts' : pageTitle"></h1>
                </div>
                @if(is_page_template('templates/template-box-products.blade.php') || is_page_template('templates/template-merch-products.blade.php'))
                @include('components.filter')
                @elseif(is_singular('product'))
                <div class="text-container">
                    @php
                    global $product;
                    $product = wc_get_product(get_the_ID());
                    if ( is_a( $product, 'WC_Product' ) ) {
                        $price = $product->get_price();
                        $currency = get_woocommerce_currency_symbol();
                    @endphp
                        <div class="font-medium text-white product-price text-sm-md-font xs:text-md-font mobile:text-lg-font">
                            <bdi class="relative z-50">{!! $currency !!}{{ $price }}</bdi>
                        </div>
                    @php
                    } else {
                        echo 'Price not available';
                    }
                     @endphp
                </div>
                @else

                @endif
            </div>
        </div>
    </section>
