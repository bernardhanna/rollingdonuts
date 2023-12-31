<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 14:54:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-07 16:12:20
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Location extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $location = new FieldsBuilder('location');

        $location
        ->addText('address', [
            'label' => 'Address',
        ])
        ->addText('latitude_coordinates', [
            'label' => 'Latitude Coordinates',
        ])
        ->addText('longitude_coordinates', [
            'label' => 'Longitude Coordinates',
        ])
        ->addText('phone_number', [
            'label' => 'Phone Number',
        ])
        ->addText('mon_fri_opening_hours', [
            'label' => 'Monday - Friday Opening Hours',
        ])
        ->addText('sat_opening_hours', [
            'label' => 'Saturday Opening Hours',
        ])
        ->addText('sun_opening_hours', [
            'label' => 'Sunday Opening Hours',
        ])
        ->addUrl('get_directions_link', [
            'label' => 'Get Directions Link',
        ])
        ->addLink('order_for_collection_link', [
            'label' => 'Order for Collection Link',
            'return_format' => 'array',
        ]);

        return $location;
    }
}
