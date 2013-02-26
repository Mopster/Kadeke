<?php

namespace Kadeke\WebsiteBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\WebsiteBundle\Form\Pages\AboutPageAdminType;
use Kadeke\WebsiteBundle\Entity\AbstractContentPage;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_about_page")
 */
class AboutPage extends AbstractContentPage
{
    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name' => 'ContentPage',
                'class'=> "Kadeke\WebsiteBundle\Entity\ContentPage"
            ),
            array(
                'name' => 'FormPage',
                'class'=> "Kadeke\WebsiteBundle\Entity\FormPage"
            )
        );
    }

    public function getDefaultAdminType()
    {
        return new AboutPageAdminType();
    }

    /*
     * return string
     */
    public function getDefaultView()
    {
        return "KadekeWebsiteBundle:Pages\AboutPage:view.html.twig";
    }
}
