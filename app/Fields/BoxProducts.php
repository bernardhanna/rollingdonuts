<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:33:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-18 14:43:31
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\BoxProduct;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BoxProducts extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $boxProducts = new FieldsBuilder('box_product');

        $boxProducts
        ->setGroupConfig('hide_on_screen', ['the_content'])
        ->setLocation('page_template', '==', 'template-box-products.php')
        ->or('post_type', '==', 'page')
        ->and('page', '==', get_page_by_path('orders')->ID);

        $boxProducts
            ->addFields($this->get(BoxProduct::class));

        return $boxProducts->build();
    }
}
