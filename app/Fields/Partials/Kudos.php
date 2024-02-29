<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 16:56:26
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-31 16:01:44
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Kudos extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $kudos = new FieldsBuilder('kudos');

        $kudos->addImage('kudos_image', [
            'label' => 'Image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ]);


        $kudos
            ->addText('kudos_job', [
                'label' => 'Postition',
            ]);

        return $kudos;
    }
}
