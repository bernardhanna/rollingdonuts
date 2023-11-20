<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 12:40:11
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 12:43:39
 */

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Services extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $services = new FieldsBuilder('services');

        $services
            ->addRepeater('services_list', [
                'label' => 'Services List',
                'layout' => 'block',
                'button_label' => 'Add Service',
            ])
                ->addImage('image', [
                    'label' => 'Image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ])
                ->addFile('video', [
                    'label' => 'Video Animation',
                    'return_format' => 'url',
                    'library' => 'all',
                    'mime_types' => 'mp4',
                ])
                ->addText('title', [
                    'label' => 'Title',
                ])
                ->addTextarea('description', [
                    'label' => 'Description',
                ])
            ->endRepeater();

        return $services;
    }
}
