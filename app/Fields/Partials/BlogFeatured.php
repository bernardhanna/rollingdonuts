<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 14:54:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-11-01 15:47:06
 */
namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BlogFeatured extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $blogfeatured = new FieldsBuilder('blog_featured');

        $blogfeatured
            ->addRepeater('featured_posts', [
                'label' => 'Featured Posts',
                'max' => 5,
                'layout' => 'block'
            ])
                ->addPostObject('post', [
                    'label' => 'Select Post',
                    'post_type' => ['post'],
                    'return_format' => 'id'
                ])
            ->endRepeater();

        return $blogfeatured;
    }
}





