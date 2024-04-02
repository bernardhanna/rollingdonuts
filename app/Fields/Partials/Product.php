<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:22:51
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 17:03:04
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Product extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $product = new FieldsBuilder('product');

        $product
            ->addText('box_number', [
                'label' => 'Number of Products in Box',
                'instructions' => 'Enter a number to represent the quantity of products in the box.',
            ])
            ->addColorPicker('featured_donut_bg_color', [
                'label' => 'Featured Donut Background Color',
                'instructions' => 'Select the background color for the featured donut.',
                'default_value' => '#FFFFFF', // Default color value (optional)
            ])
            ->addImage('thumb_image', [
                'label' => 'Thumbnail Image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
            ])
            ->addPostObject('product_allergens', [
                'label' => 'Allergens',
                'post_type' => ['allergen'],
                'multiple' => true,
                'return_format' => 'object',
            ]);

        return $product;
    }
}
