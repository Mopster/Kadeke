<?php

namespace Kadeke\WebsiteBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeSearchBundle\Entity\AbstractSearchPage;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_search_page")
 */
class SearchPage extends AbstractSearchPage {

    /*
     * return string
     */
    public function getDefaultView()
    {
        return "KadekeWebsiteBundle:Pages\SearchPage:view.html.twig";
    }

}