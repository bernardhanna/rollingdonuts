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

class Information extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $information = new FieldsBuilder('information');
        $information
            ->addRepeater('selected_information', [
                'label' => 'Select Information to display',
                'button_label' => 'Add Info',
                'layout' => 'block',
            ])
            ->addImage('info_icon', [
                'label' => 'Icon',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addText('info_title', [
                'label' => 'Title',
            ])
            ->addRepeater('add_info', [
                'label' => 'Add Sub Information',
                'button_label' => 'Add',
                'layout' => 'row',
            ])
            ->addImage('subinfo_icon', [
                'label' => 'Icon',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addText('subinfo_text', [
                'label' => 'Text',
            ])

            ->endRepeater();

        return $information;
    }
}
