<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:33:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 16:59:04
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Product;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Products extends Field
{
    /**
     * The field group.
     *
     * @return array
     */

    public function fields()
    {
        $wooProduct = new FieldsBuilder('woo_product');

        $wooProduct
        ->setLocation('post_type', '==', 'product');

        $wooProduct
        ->addFields($this->get(Product::class));

        return $wooProduct->build();
    }
}
