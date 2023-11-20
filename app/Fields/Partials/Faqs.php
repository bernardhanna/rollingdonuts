<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 16:56:26
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-31 16:01:44
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Faqs extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $faqs = new FieldsBuilder('faqs');

        $faqs->addImage('faq_image', [
            'label' => 'Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ]);


        $faqs
            ->addText('faq_title', [
                'label' => 'Title',
            ])
            ->addLink('faq_button', [
                'label' => 'Link',
            ])
            ->addRepeater('selected_faqs', [
                'label' => 'Select FAQ Posts',
                'button_label' => 'Add FAQ',
                'layout' => 'block',
            ])
                ->addPostObject('faq', [
                    'label' => 'FAQ',
                    'post_type' => 'faq',
                    'return_format' => 'object',
                ])
            ->endRepeater();

        return $faqs;
    }
}
