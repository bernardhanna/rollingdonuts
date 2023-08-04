<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 15:14:06
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 15:15:16
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentImageRight extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $contentImageLeft = new FieldsBuilder('content_image_right');

        $contentImageLeft
            ->addImage('giftcard_image', [
                'label' => 'Image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addText('giftcard_heading', [
                'label' => 'Heading',
            ])
            ->addTextarea('giftcard_text', [
                'label' => 'Text',
                'rows' => 4,
            ])
            ->addLink('giftcard_button', [
                'label' => 'Button',
            ]);

        return $contentImageLeft;
    }
}
