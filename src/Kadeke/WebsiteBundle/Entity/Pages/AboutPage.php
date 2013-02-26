<?php

namespace Kadeke\WebsiteBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use Kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kadeke\WebsiteBundle\Form\Pages\AboutPageAdminType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_about_page")
 */
class AboutPage extends AbstractPage implements HasPagePartsInterface
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

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
    }
}
