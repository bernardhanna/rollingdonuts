<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 20:18:21
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-12 17:00:14
 */


namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ThemeOptions extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Theme Options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Rolling Donut Settings';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $themeOptions = new FieldsBuilder('theme_options', [
            'style' => 'seamless',
        ]);

        $themeOptions
        ->addTab('General Options')
            ->setConfig('placement', 'left')
        ->addImage('main_logo', [
            'label' => 'Main Logo',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('mobile_logo', [
            'label' => 'Mobile Logo',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('mobile_logo_open', [
            'label' => 'Mobile Logo Hamburger Open',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('mobile_menu_bg', [
            'label' => 'Mobile Menu Open Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('page_header_bg', [
            'label' => 'Page Header Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('page_header_mobile_bg', [
            'label' => 'Mobile Page Header Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('notice_bg', [
            'label' => 'WooCommerce Notice Background',
            'return_format' => 'url', // Return image URL
        ])

        ->addTab('Header')
        ->addImage('icon_image', [
            'label' => 'Icon Image',
            'return_format' => 'url', // Return image URL
        ])
        ->addText('topbar_text', [
            'label' => 'Topbar Text'
        ])
        ->addLink('signup_link', [
            'label' => 'Sign Up Link'
        ])
        ->addText('discount_text', [
            'label' => 'Discount Text'
        ])
        ->addText('office_telephone', [
            'label' =>'Telephone Number'
        ])

        ->addTab('Footer')
        ->addImage('newsletter_image', [
            'label' => 'Newsletter Image Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('newsletter_mobile_image', [
            'label' => 'Newsletter Mobile Image Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addText('footer_newsletter_title_one', [
            'label' => 'Footer Newsletter Title Line 1'
        ])
        ->addText('footer_newsletter_title_two', [
            'label' => 'Footer Newsletter Title Line 2'
        ])
        ->addText('footer_newsletter_text', [
            'label' => 'Footer Newsletter Text'
        ])
        ->addImage('footer_logo', [
            'label' => 'Footer Logo',
            'return_format' => 'url', // Return image URL
        ])
        ->addText('footer_about_text', [
            'label' => 'Footer about Text'
        ])
        ->addUrl('twitter_profile_url', ['label' => 'Twitter Profile Url'])
        ->addUrl('facebook_profile_url', ['label' => 'Facebook Profile Url'])
        ->addUrl('tiktok_profile_url', ['label' => 'TikTok Profile Url'])
        ->addUrl('instagram_profile_url', ['label' => 'Instagram Profile Url'])

        ->addRepeater('footer_menu_one', ['label' => 'Footer Menu One', 'layout' => 'block'])
            ->addLink('footer_menu_one_link', [
                'label' => 'Add Link'
            ])
        ->endRepeater()

        ->addRepeater('footer_menu_two', ['label' => 'Footer Menu Two', 'layout' => 'block'])
            ->addLink('footer_menu_two_link', [
                'label' => 'Add Link'
            ])
        ->endRepeater()

        ->addRepeater('footer_menu_three', ['label' => 'Footer Menu Three', 'layout' => 'block'])
          ->addLink('footer_menu_three_link', [
            'label' => 'Add Link'
         ])
        ->endRepeater()

        ->addRepeater('footer_menu_four', ['label' => 'Footer Menu Four', 'layout' => 'block'])
            ->addLink('footer_menu_four_link', [
            'label' => 'Add Link'
        ])
        ->endRepeater()

        ->addTab('Copyright')
        ->addText('copyright_text', [
            'label' => 'Copyright Text Left'
        ])
        ->addRepeater('copyright_menu_four', ['label' => 'copyright Menu', 'layout' => 'block'])
            ->addLink('copyright_menu_link', [
            'label' => 'Add Link'
        ])
        ->endRepeater()
        ->addImage('copyright_logo', [
            'label' => 'copyright Logo',
            'return_format' => 'url', // Return image URL
        ])
        ->addText('copyright_text_area', [
            'label' => 'Copyright Text Right',
        ])

        ->addTab('Site Links')
        ->addRepeater('site_links', ['label' => 'Site Links', 'layout' => 'block'])
            ->addLink('site_links', [
            'label' => 'Add Link'
        ])
        ->endRepeater()

        ->addTab('WooCommerce')
        ->addImage('woo_header_bg', [
            'label' => 'Header Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('woo_mobile_bg', [
            'label' => 'Header Mobile Background',
            'return_format' => 'url', // Return image URL
        ])
        ->addImage('shop_bg', [
            'label' => 'Shop Background',
            'return_format' => 'url', // Return image URL
        ]);

        return $themeOptions->build();
    }
}
