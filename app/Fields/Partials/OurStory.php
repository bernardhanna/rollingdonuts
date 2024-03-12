<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OurStory extends Partial
{
    public function fields()
    {
        $our_story = new FieldsBuilder('our_story');

        $our_story
            ->addImage('background_image', [
                'label' => 'Background Image',
                'instructions' => 'Upload the background image for the "Our Story" section.',
                'return_format' => 'url',
            ])
            ->addImage('mobile_background_image', [
            'label' => 'Mobile Background Image',
            'instructions' => 'Upload the background image for the "Our Story" section on Mobile (optional).',
                'return_format' => 'url',
            ])
            ->addText('title_mob', [
                'label' => 'Mobile Title',
            ])
            ->addText('span_one_mob', [
                'label' => 'Mobile Subtitle One',
            ])
            ->addText('span_two_mob', [
                'label' => 'Mobile Subtitle Two',
            ])
            ->addTextarea('description_mob', [
                'label' => 'Mobile Description',
            ])
            ->addRepeater('stories', [
                'label' => 'Stories',
                'instructions' => 'Add up to 3 stories.',
                'layout' => 'block',
                'min' => 1,
                'max' => 3,
            ])
            ->addImage('image', [
                'label' => 'Large Device Image',
                'instructions' => 'Upload the image for the story that will show on Desktop - Recommended size is 658.515 x 426.499px',
                'return_format' => 'url',
            ])
            ->addImage('image_mobile', [
                'label' => 'Smaller Device Image',
                'instructions' => 'Upload the image for the story that will show on Smaller Devices  - Recommended size is 309px x 408px',
                'return_format' => 'url',
            ])
            ->addText('title', [
                'label' => 'Title',
            ])
            ->addText('span_one', [
                'label' => 'Subtitle One',
            ])
            ->addText('span_two', [
                'label' => 'Subtitle Two',
            ])
            ->addTextarea('description', [
                'label' => 'Description',
            ])
            ->addImage('donut_img', [
                'label' => 'Donut Icon',
                'return_format' => 'url',
            ])
            ->addText('timeline_button', [
                'label' => 'Mobile Timeline Date',
            ])
            ->addText('timeline_text', [
                'label' => 'Mobile Timeline Text',
            ])
            ->endRepeater();

        return $our_story;
    }
}
