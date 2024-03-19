<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-09 13:17:27
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 10:23:42
 */
?>
    <section class="relative w-full z-50 lg:mb-12 mb-0"
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
    <img class="w-full block sm:hidden" src="{{ $image_url_mobile }}" alt="{{ $image_alt_mobile }}" srcset="{{ $image_srcset_mobile }}" sizes="(max-width: 639px) 100vw">
</div>
        @endif

        <div class="mx-auto max-w-max-1485 absolute h-full left-0 right-0 top-0 w-full">
            <div class="w-full lg:max-w-max-1485 pl-4 desktop:pl-0">
                @php
                    woocommerce_breadcrumb();
                @endphp
            </div>
            <div class="relative flex items-center justify-between mobile:pt-8 px-2 mobile:px-4 desktop:p-0 desktop:pt-6">
                <div x-data="{ content: 'Dynamic content based on conditions' }" class="text-container relative inline-block width-fit-content px-4 desktop:p-0">
                    <h1 :class="{
                        'text-mob-xxl-font lg:text-lg-font xl:text-lg-font xxl:text-xxxl-font': content.length <= 20,
                        'insta-flow:text-xxl-font': content.length > 20 && content.length <= 154,
                        'xxl:text-xl-font': content.length > 20 && content.length <= 254,
                        'macbook:text-lg-font': content.length > 20 && content.length <= 354,
                        'xl:text-1lg-font': content.length > 20 && content.length <= 454,
                        'laptop:text-lg-font': content.length > 20 && content.length <= 554,
                        'notebook:text-1lg-font': content.length > 20 && content.length <= 654,
                        'lg:text-md-font': content.length > 20 && content.length <= 754,
                        'tablet-sm:text-md-font': content.length > 20 && content.length <= 854,
                        'md:text-md-font': content.length > 20 && content.length <= 954,
                        'sm:text-md-font': content.length > 20 && content.length <= 1054,
                        'mobile:text-sm-md-font': content.length > 20 && content.length <= 1154,
                        'sm-mob:textsm-md-font': content.length > 20 && content.length <= 1254,
                        'small:text-base-font': content.length > 20 && content.length <= 1354,
                        'xs:sm-base-font': content.length > 20 && content.length <= 1354,
                        'xxxs:text-tiny': content.length > 20 && content.length <= 1454,
                    }" class="z-10 relative left-0 text-white font-reg420" x-text="activeTab === 'register' ? 'Register' : isAccountPage && !isLoggedIn ? 'Sign In' : isTemplateBoxProducts ? 'Choose Your Own' : isProductArchive ? 'Our Donuts' : pageTitle">
                        <!-- Dynamic content will be inserted here based on x-text directive -->
                    </h1>
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
                        <div class="product-price text-white text-sm-md-font xs:text-md-font mobile:text-lg-font font-medium">
                            <bdi class="z-50 relative">{!! $currency !!}{{ $price }}</bdi>
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
