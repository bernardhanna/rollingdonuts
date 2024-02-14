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
use App\Fields\Partials\OurStory;
use StoutLogic\AcfBuilder\FieldsBuilder;

class About extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $aboutPage = new FieldsBuilder('aboutPage');

        $aboutPage
        ->setLocation('page_template', '==', 'templates/template-about.blade.php');

        $aboutPage
        ->addTab('Our Story')
            ->addFields($this->get(OurStory::class))

        ->addTab('Faqs')
            ->addFields($this->get(Faqs::class));

        return $aboutPage->build();
    }
}
