<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-13 09:33:48
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-01 12:02:20
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Faqs;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $contactPage = new FieldsBuilder('contactPage');

        $contactPage
        ->setLocation('page_template', '==', 'templates/template-contact.blade.php');


        $contactPage
        ->addTab('Faqs')
            ->addFields($this->get(Faqs::class));

        return $contactPage->build();
    }
}
