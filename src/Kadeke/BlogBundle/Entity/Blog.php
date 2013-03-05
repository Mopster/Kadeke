<?php

namespace Kadeke\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use Kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kadeke\BlogBundle\Form\BlogAdminType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_blog_blog")
 */
class Blog extends AbstractPage implements HasPagePartsInterface
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

    public function getDefaultAdminType()
    {
        return new BlogAdminType();
    }

    public function getDefaultView()
    {
        return "KadekeBlogBundle:Blog:view.html.twig";
    }

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
    }

    public function service(ContainerInterface $container, Request $request, RenderContext $context)
    {
        parent::service($container, $request, $context);

        $em = $container->get('doctrine')->getManager();
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');
        $context['blogentries'] = $blogEntryRepository->getBlogEntries();
    }


}
