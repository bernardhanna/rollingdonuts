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

class FlexiBlocks extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $flexiblocks = new FieldsBuilder('flexi_blocks');

        $flexiblocks
        ->addImage('banner_left_test', [
            'label' => 'Banner Left Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ]);

        return $flexiblocks;
    }
}