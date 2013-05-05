<?php

namespace Kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kadeke\WebsiteBundle\Form\HomePageAdminType;
use Kadeke\WebsiteBundle\PagePartAdmin\HomePagePagePartAdminConfigurator;

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
                'name' => 'Page',
                'class'=> "Kadeke\WebsiteBundle\Entity\ContentPage"
            ),
            array(
                'name' => 'Form',
                'class'=> "Kadeke\WebsiteBundle\Entity\FormPage"
            ),
            array(
                'name' => 'Blog',
                'class'=> "Kadeke\BlogBundle\Entity\Blog"
            ),
            array(
                'name' => 'Search',
                'class'=> "Kadeke\WebsiteBundle\Entity\Pages\Search\SearchPage"
            ),
            array(
                'name' => 'About',
                'class'=> "Kadeke\WebsiteBundle\Entity\Pages\AboutPage"
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
        return "KadekeWebsiteBundle:HomePage:view.html.twig";
    }


}