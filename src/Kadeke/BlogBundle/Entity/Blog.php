<?php

namespace Kadeke\BlogBundle\Entity;

use Kadeke\WebsiteBundle\Entity\ContentPage;

/**
 * @ORM\Table(name="kd_blog_blog")
 */
class Blog extends ContentPage
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

}
