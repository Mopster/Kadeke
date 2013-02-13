<?php

namespace kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use kadeke\WebsiteBundle\Form\HomePageAdminType;
use kadeke\WebsiteBundle\PagePartAdmin\HomePagePagePartAdminConfigurator;

/**
 * HomePage
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_home_pages")
 */
class HomePage extends AbstractPage implements HasPagePartsInterface
{

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new HomePageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name' => 'ContentPage',
                'class'=> "kadeke\WebsiteBundle\Entity\ContentPage"
            ),
            array(
                'name' => 'FormPage',
                'class'=> "kadeke\WebsiteBundle\Entity\FormPage"
            )
        );
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new HomePagePagePartAdminConfigurator());
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "kadekeWebsiteBundle:HomePage:view.html.twig";
    }
}