<?php

namespace Kadeke\TripBundle\Entity\Pages\Trip;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\TripBundle\PagePartAdmin\Trip\TripOverviewPagePagePartAdminConfigurator;
use Kunstmaan\ArticleBundle\Entity\AbstractArticleOverviewPage;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The article overview page which shows its articles
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_tripoverviewpages")
 */
class TripOverviewPage extends AbstractArticleOverviewPage
{

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new TripOverviewPagePagePartAdminConfigurator());
    }

    /**
     * @param ContainerInterface $container
     * @param Request            $request
     * @param RenderContext      $context
     */
    public function service(ContainerInterface $container, Request $request, RenderContext $context)
    {
        parent::service($container, $request, $context);
    }

    public function getArticleRepository($em)
    {
        return $em->getRepository('KadekeTripBundle:Pages\Trip\TripPage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KadekeTripBundle:Pages/Trip/TripOverviewPage:view.html.twig";
    }

}
