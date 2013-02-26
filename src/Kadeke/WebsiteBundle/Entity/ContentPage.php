<?php

namespace Kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kadeke\WebsiteBundle\Form\ContentPageAdminType;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_content_pages")
 */
class ContentPage extends AbstractPage implements HasPagePartsInterface
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

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
    }

    /**
     * return string
     */
    public function getDefaultView()
    {
        return "KadekeWebsiteBundle:ContentPage:view.html.twig";
    }

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