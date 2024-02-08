<?php
// File: app/Fields/Partials/EventBlock.php

namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class EventBlock
{
    public static function fields()
    {
        $eventBlockLayout = new FieldsBuilder('event_block');

        $eventBlockLayout
            ->addFlexibleContent('event_content_blocks', [
                'label' => 'Event Content Blocks',
                'button_label' => 'Add Event Block',
            ])
                ->addLayout('event_block_layout', [
                    'label' => 'Event Block',
                ])
                    ->addImage('event_image', [
                        'label' => 'Event Image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ])
                    ->addText('event_heading', [
                        'label' => 'Event Heading',
                    ])
                    ->addTextarea('event_text', [
                        'label' => 'Event Text',
                    ])
                    ->addLink('event_button', [
                        'label' => 'Event Button',
                        'return_format' => 'array',
                    ])
                    ->addTrueFalse('reverse_layout', [
                        'label' => 'Reverse Layout',
                        'instructions' => 'Check this box to reverse the layout of the image and text.',
                        'ui' => 1,
                        'ui_on_text' => 'Reversed',
                        'ui_off_text' => 'Default',
                    ]);

        return $eventBlockLayout->getLayout();
    }
}
