<?php

namespace Kadeke\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use Kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;

/**
 * Blog overviewpage to showcase the infinite scrolling
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_blog_overviewpages")
 */
class BlogOverviewPage extends AbstractPage implements HasPagePartsInterface
{

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KadekeBlogBundle:BlogOverviewPage:view.html.twig";
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array();
    }

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
    }
}
