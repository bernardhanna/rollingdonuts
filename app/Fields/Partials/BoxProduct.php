<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:22:51
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-21 10:50:34
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BoxProduct extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $boxProduct = new FieldsBuilder('box_product');

        $boxProduct
        ->addTaxonomy('ordered_categories', [
            'label' => 'Add Box Product Type Categories',
            'taxonomy' => 'product_cat',
            'field_type' => 'multi_select',
            'return_format' => 'object',
            'parent' => 175, // Fetch child categories of the term with ID 175
        ]);

        return $boxProduct;
    }
}
