<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Faqs;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Delivery extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $deliveryPage = new FieldsBuilder('DeliveryPage');

        $deliveryPage
            ->setLocation('page_template', '==', 'templates/template-delivery.blade.php');

        $deliveryPage
            ->addTab('Faqs')
            ->addFields($this->get(Faqs::class));

        return $deliveryPage->build();
    }
}
