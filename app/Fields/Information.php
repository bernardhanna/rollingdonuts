<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Faqs;
use App\Fields\Partials\Info;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Information extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $infoPage = new FieldsBuilder('InfoPage');
        $infoPage->setLocation('page_template', '==', 'templates/template-delivery.blade.php');

        $infoPage
        ->addTab('Information')
        ->addFields($this->get(Info::class))
        ->addTab('Faqs')
        ->addFields($this->get(Faqs::class));

        return $infoPage->build();
    }
}
