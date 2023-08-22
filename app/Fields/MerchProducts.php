<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:33:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-21 11:12:56
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\MerchProduct;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MerchProducts extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $merchProducts = new FieldsBuilder('merch_product');

        $merchProducts
        ->setGroupConfig('hide_on_screen', ['the_content'])
        ->setLocation('page_template', '==', 'template-merch-products.php')
        ->or('post_type', '==', 'page')
        ->and('page', '==', get_page_by_path('merch')->ID);

        $merchProducts
            ->addFields($this->get(merchProduct::class));

        return $merchProducts->build();
    }
}
