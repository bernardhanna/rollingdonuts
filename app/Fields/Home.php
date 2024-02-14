<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-06 13:17:04
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-12 16:16:13
 */
namespace App\Fields;

use Log1x\AcfComposer\Field;
use App\Fields\Partials\HomeHero;
use App\Fields\Partials\Services;
use App\Fields\Partials\FeaturedDonuts;
use App\Fields\Partials\BestSellers;
use App\Fields\Partials\ContentImageLeft;
use App\Fields\Partials\ContentImageRight;
use App\Fields\Partials\OurStory;
use App\Fields\Partials\Heading;
use App\Fields\Partials\Faqs;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Home extends Field
{
    /**
     * The field group.
     *
     * @return array
     */

    public function fields()
    {
        $homePage = new FieldsBuilder('homePage');

        $homePage
        ->setLocation('post_type', '==', 'page')
        ->and('page_type', '==', 'front_page');

        $homePage
        ->addTab('Hero')
            ->addFields($this->get(HomeHero::class))
        ->addTab('Services')
            ->addFields($this->get(Services::class))
        ->addTab('Featured Donuts')
            ->addFields($this->get(FeaturedDonuts::class))
        ->addTab('Bestsellers')
            ->addFields($this->get(BestSellers::class))
        ->addTab('Events')
            ->addFields($this->get(ContentImageLeft::class))
        ->addTab('Gift Card')
            ->addFields($this->get(ContentImageRight::class))
        ->addTab('Our Story')
            ->addFields($this->get(OurStory::class))
        ->addTab('Trust Pilot')
            ->addFields($this->get(Heading::class))
        ->addTab('Faqs')
            ->addFields($this->get(Faqs::class));

        return $homePage->build();
    }
}
