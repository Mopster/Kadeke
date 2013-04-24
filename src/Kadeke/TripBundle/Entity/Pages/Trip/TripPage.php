<?php

namespace Kadeke\TripBundle\Entity\Pages\Trip;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractArticlePage;
use Kadeke\TripBundle\Form\Pages\Trip\TripPageAdminType;
use Kadeke\TripBundle\PagePartAdmin\Trip\TripPagePagePartAdminConfigurator;
use Symfony\Component\Form\AbstractType;

/**
 * @ORM\Entity(repositoryClass="Kadeke\TripBundle\Repository\Pages\Trip\TripPageRepository")
 * @ORM\Table(name="kd_trippages")
 */
class TripPage extends AbstractArticlePage
{

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new TripPageAdminType();
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new TripPagePagePartAdminConfigurator());
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KadekeTripBundle:Pages/Trip/TripPage:view.html.twig";
    }
}
