<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 15:05:14
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 15:05:35
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentImageLeft extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $contentImageLeft = new FieldsBuilder('content_image_left');

        $contentImageLeft
            ->addImage('event_image', [
                'label' => 'Image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addText('event_heading', [
                'label' => 'Heading',
            ])
            ->addWysiwyg('event_text', [
                'label' => 'Wysiwyg',
            ])
            ->addLink('event_button', [
                'label' => 'Button',
            ]);

        return $contentImageLeft;
    }
}

