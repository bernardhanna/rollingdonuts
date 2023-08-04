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

class HomeHero extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $homehero = new FieldsBuilder('home_hero');

        $homehero
        ->addImage('banner_left', [
            'label' => 'Banner Left Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('banner_top_mobile', [
            'label' => 'Banner Top Mobile',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('banner_right', [
            'label' => 'Banner Right Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('banner_bottom_mobile', [
            'label' => 'Banner Bottom Mobile',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('hazelnut', [
            'label' => 'Donut Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('neon', [
            'label' => 'Neon Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addImage('neon_mobile', [
            'label' => 'Neon Mobile Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ])
        ->addText('hero_text', [
            'label' => 'Text',
        ])
        ->addLink('hero_link', [
            'label' => 'Link',
        ]);

        return $homehero;
    }
}
