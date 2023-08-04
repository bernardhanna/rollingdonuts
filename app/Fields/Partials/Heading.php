<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 16:13:25
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 16:19:00
 */


namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Heading extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $heading = new FieldsBuilder('heading');

        $heading
             ->addText('heading_global');

        return $heading;
    }
}
