<?php

namespace Kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\WebsiteBundle\Form\ContentPageAdminType;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_content_pages")
 */
class ContentPage extends AbstractContentPage
{

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ContentPageAdminType();
    }

}