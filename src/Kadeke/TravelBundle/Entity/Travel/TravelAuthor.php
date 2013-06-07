<?php

namespace Kadeke\TravelBundle\Entity\Travel;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractAuthor;
use Kadeke\TravelBundle\Form\Travel\TravelAuthorAdminType;
use Symfony\Component\Form\AbstractType;

/**
 * The author for a Travel
 *
 * @ORM\Entity(repositoryClass="Kadeke\TravelBundle\Repository\Travel\TravelAuthorRepository")
 * @ORM\Table(name="kd_travel_authors")
 */
class TravelAuthor extends AbstractAuthor {

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getAdminType()
    {
        return new TravelAuthorAdminType();
    }

}