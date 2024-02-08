<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 14:54:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-02 12:20:21
 */
namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class FlexiBlocks
{
    /**
     * Initialize the FlexiBlocks fields.
     *
     * @return FieldsBuilder
     */
    public static function fields()
    {
        $flexiBlocks = new FieldsBuilder('flexi_blocks');

        $flexiBlocks
            ->addImage('video_thumbnail', [
                'label' => 'Video Thumbnail',
                'instructions' => 'Upload the thumbnail image for the video.',
                'return_format' => 'array', // or 'url' or 'id', depending on your needs
                'preview_size' => 'medium', // Adjust according to your needs
                'library' => 'all',
            ])
            ->addText('youtube_video_id', [
                'label' => 'YouTube Video ID',
                'instructions' => 'Enter the YouTube video ID.',
                'placeholder' => 'e.g., nAkD44-velk',
            ]);

        return $flexiBlocks;
    }
}
