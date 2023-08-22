<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:22:51
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-21 10:54:37
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MerchProduct extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $merchProduct = new FieldsBuilder('merch_product');

        $merchProduct
        ->addTaxonomy('merch_ordered_categories', [
            'label' => 'Add Merch Product Type Categories',
            'taxonomy' => 'product_cat',
            'field_type' => 'multi_select',
            'return_format' => 'object',
            'parent' => 176,
        ]);

        return $merchProduct;
    }
}
