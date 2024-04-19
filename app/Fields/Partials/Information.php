<?php

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

        // Main repeater for general information sections
        $information->addRepeater('selected_information', [
            'label' => 'Select Information to display',
            'button_label' => 'Add Info',
            'layout' => 'block', // Layout type for repeater fields
        ])
            ->addImage('info_icon', [
                'label' => 'Icon',
            'return_format' => 'array', // Returns an array with image details
            'preview_size' => 'thumbnail', // Size of the admin preview
            ])
            ->addText('info_title', [
            'label' => 'Title', // Simple label for text field
            ])
            // Nested repeater for detailed sub-information
            ->addRepeater('add_info', [
                'label' => 'Add Sub Information',
                'button_label' => 'Add',
            'layout' => 'row', // Layout type for nested repeater fields
            ])
            ->addImage('subinfo_icon', [
                'label' => 'Icon',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addText('subinfo_text', [
            'label' => 'Text', // Added a label for clarity
            ])
            ->endRepeater() // Ends the nested repeater
            ->endRepeater(); // Ends the main repeater

        return $information;
    }
}
