<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-12 16:11:14
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-12 16:17:25
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FeaturedDonuts extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $featuredDonuts = new FieldsBuilder('featured_donuts');

        $featuredDonuts
            ->addPostObject('donuts', [
                'label' => 'Featured Donuts',
                'post_type' => ['product'],
                'multiple' => true,
                'return_format' => 'object',
            ]);

        return $featuredDonuts;
    }
}
