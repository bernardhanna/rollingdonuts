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
            ->addLayout('text_block')
                ->addTextarea('text_content', [
                    'label' => 'Text Content',
                    'new_lines' => 'wpautop', // Automatically add paragraphs
                ])
            ->addLayout('image_block')
                ->addImage('image_content', [
                    'label' => 'Image Content',
                    'return_format' => 'url',
                ])

            ->addLayout('imagewithtext_block')
                ->addTrueFalse('reverse_layout', [
                    'label' => 'Reverse Layout',
                    'instructions' => 'Check this to reverse the layout.',
                    'ui' => 1,
                ])
                ->addImage('event_image', [
                    'label' => 'Event Image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ])
                ->addText('event_heading', [
                    'label' => 'Event Heading',
                ])
                ->addTextarea('event_text', [
                    'label' => 'Event Text',
                    'new_lines' => 'wpautop',
                ])
                ->addLink('event_button', [
                    'label' => 'Event Button',
                ])

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
                ]);

        return $flexiblocks;
    }
}
