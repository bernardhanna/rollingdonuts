<?php
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Faqs;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Faqq extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $faqPage = new FieldsBuilder('faqPage');

        $faqPage
            ->setLocation('page_template', '==', 'templates/template-faqs.blade.php');

        $faqPage
            ->addTab('Faqs')
            ->addFields($this->get(Faqs::class));

        return $faqPage->build();
    }
}
