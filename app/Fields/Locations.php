<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-09-07 15:41:19
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-07 16:19:27
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\Location;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Locations extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $locations = new FieldsBuilder('locations');

        $locations
            ->setLocation('post_type', '==', 'location');

        $locations
             ->addFields($this->get(Location::class));

        return $locations->build();
    }
}
