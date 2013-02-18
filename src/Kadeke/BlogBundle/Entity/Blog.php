<?php

namespace Kadeke\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\BlogBundle\Form\BlogAdminType;
use Kadeke\WebsiteBundle\Entity\AbstractContentPage;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_blog_blog")
 */
class Blog extends AbstractContentPage
{

    /**
     * The blog will have BlogEntry's as its children
     *
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name' => 'BlogEntry',
                'class'=> "Kadeke\BlogBundle\Entity\BlogEntry"
            )
        );
    }

    public function getDefaultAdminType()
    {
        return new BlogAdminType();
    }

    public function getDefaultView()
    {
        return "KadekeBlogBundle:Blog:view.html.twig";
    }

}
