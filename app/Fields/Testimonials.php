<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-07 15:41:19
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-07 16:19:27
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Kudos;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Testimonials extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $testimonials = new FieldsBuilder('testimonials');

        $testimonials
            ->setLocation('post_type', '==', 'testimonial');

        $testimonials
             ->addFields($this->get(Kudos::class));

        return $testimonials->build();
    }
}