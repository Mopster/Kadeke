<?php

namespace Kadeke\TravelBundle\Entity\Travel;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\TravelBundle\Form\Travel\TravelOverviewPageAdminType;
use Kadeke\TravelBundle\PagePartAdmin\Travel\TravelOverviewPagePagePartAdminConfigurator;
use Kunstmaan\ArticleBundle\Entity\AbstractArticleOverviewPage;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The article overview page which shows its articles
 *
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="Kadeke\TravelBundle\Repository\Travel\TravelOverviewPageRepository")
 * @ORM\Table(name="kd_traveloverviewpages")
 */
class TravelOverviewPage extends AbstractArticleOverviewPage
{

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new TravelOverviewPagePagePartAdminConfigurator());
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
        return $em->getRepository('KadekeTravelBundle:Travel\TravelPage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KadekeTravelBundle:Travel/TravelOverviewPage:view.html.twig";
    }

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new TravelOverviewPageAdminType();
    }

}
