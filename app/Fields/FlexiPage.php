<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:33:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-01 12:02:20
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\FlexiBlocks;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FlexiPage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $flexiPage = new FieldsBuilder('flexiPage');

        $flexiPage
        ->setLocation('page_template', '==', 'templates/template-flexi.blade.php');

        $flexiPage
        ->addFields($this->get(FlexiBlocks::class));

        return $flexiPage->build();
    }
}