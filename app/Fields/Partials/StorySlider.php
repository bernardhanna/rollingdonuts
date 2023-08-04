<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 15:22:31
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 15:24:58
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class StorySlider extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $storySlider = new FieldsBuilder('story_slider');

        $storySlider
            ->addRepeater('slides', [
                'label' => 'Slides',
                'layout' => 'block',
                'button_label' => 'Add Slide',
                'collapsed' => 'image',
                'min' => 0,
                'max' => 0,
                'instructions' => 'Add slides to the Story Slider.',
            ])
            ->addImage('image', [
                'label' => 'Image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addWysiwyg('text', [
                'label' => 'Text',
                'media_upload' => 0, // Disable media upload in the editor
            ])
            ->endRepeater();

        return $storySlider;
    }
}
