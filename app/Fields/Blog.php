<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 13:17:04
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-12 16:16:13
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\BlogFeatured;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Blog extends Field
{
    /**
     * The field group.
     *
     * @return array
     */

    public function fields()
    {
        $blogPage = new FieldsBuilder('blogPage');

        $blogPage
        ->setLocation('page_type', '==', 'posts_page');

        $blogPage
        ->addTab('Featured Posts')
            ->addFields($this->get(BlogFeatured::class));

        return $blogPage->build();
    }
}
