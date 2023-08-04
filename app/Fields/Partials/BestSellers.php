<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 14:09:34
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-12 13:19:56
 */


namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BestSellers extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $bestsellers = new FieldsBuilder('bestsellers');

        $bestsellers
            ->addImage('bg_image', [
                'label' => 'Background Image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addImage('text_image', [
                'label' => 'Text Image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addText('heading', [
                'label' => 'Heading',
            ])
            ->addPostObject('product', [
                'label' => 'Product',
                'post_type' => ['product'], // Adjust the post type to 'product'
                'multiple' => true, // Allow multiple products per row
                'return_format' => 'object',
                'ui' => 1,
            ]);

        return $bestsellers;
    }
}
