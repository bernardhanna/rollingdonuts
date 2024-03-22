<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 14:54:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-02 12:20:21
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FlexiBlocks extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $flexiblocks = new FieldsBuilder('flexi_blocks');

        $flexiblocks
            ->addFlexibleContent('flexible_content')
            ->addLayout('padding_block', [
                'label' => 'Spacing Block',
            ])
            ->addRepeater('spacing_settings', [
                'label' => 'Spacing Settings',
                'min' => 1,
                'layout' => 'block',
                'button_label' => 'Add Breakpoint',
            ])
                ->addSelect('breakpoint', [
                    'label' => 'Breakpoint',
                    'choices' => [
                        'default' => 'Default',
                        'xs' => '320px',
                        'sm-mob' => '480px',
                        'mobile' => '575px',
                        'sm' => '640px',
                        'md' => '768px',
                        'tablet-sm' => '993px',
                        'lg' => '1084px',
                        'notebook' => '1180px',
                        'laptop' => '1250px',
                        'xl' => '1280px',
                        'macbook' => '1300px',
                        'xxl' => '1440px',
                        'insta-flow' => '1590px',
                        'one-xl' => '1600px',
                        'desktop' => '1628px',
                        'site' => '1726px',
                        'xxxl' => '1920px',
                        'xxxxl' => '2500px',
                        'xxxxxl' => '2750px',
                    ],
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'return_format' => 'value',
                ])
                ->addNumber('padding_top', [
                    'label' => 'Padding Top (rem)',
                    'instructions' => 'Specify the top padding in rem (e.g., 2 for 2rem).',
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '0.1',
                ])
                ->addNumber('padding_bottom', [
                    'label' => 'Padding Bottom (rem)',
                    'instructions' => 'Specify the bottom padding in rem (e.g., 2 for 2rem).',
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '0.1',
                ])
            ->endRepeater()

            ->addLayout('editor_block')
                ->addWysiwyg('editor_content', [
                    'label' => 'WYSIWYG Editor',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ])
                ->addText('padding_top', [
                    'label' => 'Padding Top',
                    'instructions' => 'Specify the top padding (e.g., 2rem, 20px).',
                    'default_value' => '',
                ])
                ->addText('padding_bottom', [
                    'label' => 'Padding Bottom',
                    'instructions' => 'Specify the bottom padding (e.g., 2rem, 20px).',
                    'default_value' => '',
                ])

             ->addLayout('image_block')
                ->addImage('image_content', [
                    'label' => 'Image Content',
                    'return_format' => 'array',
                ])

            ->addLayout('button_block')
                ->addLink('button_link', [
                    'label' => 'Button Link',
                ])
                ->addTrueFalse('justify_start', [
                    'label' => 'Left Align',
                    'instructions' => 'Check this to start align the button.',
                    'ui' => 1,
                ])
                ->addTrueFalse('justify_center', [
                    'label' => 'Center Align',
                    'instructions' => 'Check this to center align the button.',
                    'ui' => 1,
                ])
                ->addTrueFalse('justify_end', [
                    'label' => 'Right Align',
                    'instructions' => 'Check this to end align the button.',
                    'ui' => 1,
                ])

            ->addLayout('list_block')
                ->addText('list_heading', [
                    'label' => 'List Heading',
                ])
                ->addSelect('heading_level', [
                    'label' => 'Heading Level',
                    'choices' => [
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default_value' => 'h2',
                ])

                ->addText('padding_top', [
                    'label' => 'Padding Top',
                    'instructions' => 'Specify the top padding (include unit, e.g., 2rem, 20px).',
                    'default_value' => '',
                ])
                ->addText('padding_bottom', [
                    'label' => 'Padding Bottom',
                    'instructions' => 'Specify the bottom padding (include unit, e.g., 2rem, 20px).',
                    'default_value' => '',
                ])

                ->addRepeater('list_items', [
                    'label' => 'List Items',
                    'layout' => 'block',
                    'button_label' => 'Add Item',
                ])
                    ->addText('list_item', [
                        'label' => 'List Item',
                    ])
                    ->addTextarea('list_item_content', [
                        'label' => 'List Item Content',
                        'new_lines' => 'wpautop',
                    ])
                ->endRepeater()


            ->addLayout('imagewithtext_block', [
                'label' => 'Image with Text',
            ])
                ->addTrueFalse('reverse_layout_imgtxt', [
                    'label' => 'Reverse Layout',
                    'instructions' => 'Check this to reverse the layout.',
                    'ui' => 1,
                ])
                ->addSelect('content_justification_imgtxt', [
                    'label' => 'Content Justification',
                    'instructions' => 'Select how to justify the content within the section.',
                    'choices' => [
                        'justify-start' => 'Top',
                        'justify-center' => 'Middle',
                        'justify-end' => 'Bottom',
                    ],
                    'default_value' => 'justify-center',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                ])
                ->addImage('event_image_imgtxt', [
                    'label' => 'Event Image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ])
            ->addSelect('event_heading_tag', [
                'label' => 'Title Heading Tag',
                'choices' => [
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default_value' => 'h2',
                'allow_null' => 0,
                'multiple' => 0,
            ])
                ->addText('event_heading_imgtxt', [
                    'label' => 'Event Heading',
                ])
            ->addWysiwyg('event_text_imgtxt', [
                'label' => 'Event Text',
                ])
                ->addLink('event_button_imgtxt', [
                    'label' => 'Event Button',
                ])
            ->addTrueFalse('image_border', [
                'label' => 'Add Border to Image on Mobile',
                'instructions' => 'Toggle to add or remove the border from the image.',
                'ui' => 1,
                'ui_on_text' => 'On',
                'ui_off_text' => 'Off',
            ])
                ->addRepeater('image_dimensions', [
                    'label' => 'Image Dimensions',
                    'instructions' => 'Set custom dimensions for the image at different breakpoints.',
                    'layout' => 'block',
                    'button_label' => 'Add Dimension',
                ])
                    ->addSelect('dimension_breakpoint', [
                        'label' => 'Breakpoint',
                        'choices' => [
                            'default' => 'Default',
                            'sm-mob' => '480px',
                            'mobile' => '575px',
                            'md' => '768px',
                            'lg' => '1084px',
                            'xl' => '1280px',
                            'xxl' => '1440px',
                            'desktop' => '1628px',
                        ],
                        'allow_null' => 0,
                        'ui' => 1,
                    ])
                    ->addNumber('image_height', [
                        'label' => 'Image Height (rem)',
                        'instructions' => 'Set the height of the image in rem.',
                        'default_value' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '0.1',
                    ])
                    ->addNumber('image_width', [
                        'label' => 'Image Width (rem)',
                        'instructions' => 'Set the width of the image in rem.',
                        'default_value' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '0.1',
                    ])
                ->endRepeater()

             ->addLayout('allergens_block', [
                    'label' => 'Allergens',
                ])
                ->addImage('background_image', [
                    'label' => 'Background Image',
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                ])
                ->addText('section_title', [
                    'label' => 'Section Title',
                ])
                ->addSelect('title_heading_tag', [
                    'label' => 'Title Heading Tag',
                    'choices' => [
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default_value' => 'h2',
                    'allow_null' => 0,
                    'multiple' => 0,
                ])
                ->addRepeater('icons', [
                    'label' => 'Icons',
                    'min' => 1,
                    'layout' => 'block',
                    'button_label' => 'Add Icon',
                ])
                    ->addImage('icon_image', [
                        'label' => 'Icon Image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                    ])
                    ->addText('icon_text', [
                        'label' => 'Icon Text',
                    ])
                ->endRepeater()

            ->addLayout('video_block')
                ->addImage('video_thumbnail', [
                    'label' => 'Video Thumbnail',
                    'instructions' => 'Upload the thumbnail image for the video.',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ])
                ->addText('youtube_video_id', [
                    'label' => 'YouTube Video ID',
                    'instructions' => 'Enter the YouTube video ID.',
                    'placeholder' => 'e.g., nAkD44-velk',
                ])

            ->addLayout('faq_block', [
                    'label' => 'FAQ Block',
                ])
                    ->addRelationship('selected_faqs', [
                        'label' => 'Select FAQs',
                        'post_type' => ['faq'],
                        'return_format' => 'object',
                        'min' => '',
                        'max' => '',
                        'ui' => 1,
                    ])
                    ->addLink('faq_button', [
                        'label' => 'FAQ Button',
                        'return_format' => 'array',
            ])

            ->addLayout(
                'donut_block',
                [
                    'label' => 'Donut Block'
                ]
            )
            ->addText('padding_top', [
                'label' => 'Padding Top',
                'instructions' => 'Specify the top padding (include unit, e.g., 2rem, 20px).',
                'default_value' => '',
            ])
            ->addText('padding_bottom', [
                'label' => 'Padding Bottom',
                'instructions' => 'Specify the bottom padding (include unit, e.g., 2rem, 20px).',
                'default_value' => '',
            ])
            ->addRepeater('donuts', [
                'label' => 'Donuts',
                'min' => 0,
                'max' => 3,
                'layout' => 'block',
                'button_label' => 'Add Donut',
            ])
            ->addImage('donut_image', [
                'label' => 'Donut Image',
                'return_format' => 'url',
            ])
            ->addLink('donut_link', [
                'label' => 'Donut Link',
            ])
            ->endRepeater()

            ->addLayout(
                'kudos_block',
                [
                    'label' => 'Testimonials Block'
                ]
            )
            ->addImage('kudos_main_image', [
                'label' => 'Top Image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ])
            ->addText('kudos_title', [
                'label' => 'Section Title',
            ])
            ->addSelect('kudos_heading_tag', [
                'label' => 'Title Heading Tag',
                'choices' => [
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default_value' => 'h2',
                'allow_null' => 0,
                'multiple' => 0,
            ])
            ->addText('kudos_text', [
                'label' => 'Kudos Text',
            ])
            ->addRelationship('selected_kudos', [
                'label' => 'Select Testimonials',
                'post_type' => ['testimonial'],
                'return_format' => 'object',
                'min' => '3',
                'max' => '12',
                'ui' => 1,
            ])
            ->addLayout(
                'wedding_block',
                [
                    'label' => 'Wedding Slider'
                ]
            )
            ->addText('wedding_title', [
                'label' => 'Section Title',
            ])
            ->addText('wedding_text', [
                'label' => 'Section Text',
            ])
            ->addNumber('wedding_padding_top', [
                'label' => 'Padding Top (rem)',
                'instructions' => 'Specify the top padding in rem (e.g., 2 for 2rem).',
                'default_value' => '',
                'min' => '',
                'max' => '',
                'step' => '0.1',
            ])
            ->addNumber('wedding_padding_bottom', [
                'label' => 'Padding Bottom (rem)',
                'instructions' => 'Specify the bottom padding in rem (e.g., 2 for 2rem).',
                'default_value' => '',
                'min' => '',
                'max' => '',
                'step' => '0.1',
            ])
            ->addRepeater('wedding_products', [
                'label' => 'Wedding Products',
                'min' => 3,
                'layout' => 'block',
                'button_label' => 'Add Product',
            ])
            ->addImage('wedding_image', [
                'label' => 'Product Image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addText('product_title', [
                'label' => 'Product Title',
            ])
            ->addText('product_desc', [
                'label' => 'Product Description',
            ])
            ->addLink('product_link', [
                'label' => 'Product Link',
            ])
            ->endRepeater();

        return $flexiblocks;
    }
}
