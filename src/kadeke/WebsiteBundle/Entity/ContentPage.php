<?php

namespace kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;
use kadeke\WebsiteBundle\Form\ContentPageAdminType;
use kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_content_pages")
 */
class ContentPage extends AbstractPage implements HasPagePartsInterface
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

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
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
        return "kadekeWebsiteBundle:ContentPage:view.html.twig";
    }
}