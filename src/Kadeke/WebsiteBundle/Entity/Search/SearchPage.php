<?php

namespace Kadeke\WebsiteBundle\Entity\Search;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\SearchBundle\Helper\IndexControllerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_searchpage")
 */
class SearchPage extends AbstractPage implements IndexControllerInterface {

    public function service(ContainerInterface $container, Request $request, RenderContext $context)
    {
        $querystring = $request->get("query");
        $querytag = $request->get("tag");
        $queryrtag = $request->get("rtag");
        $querytype = $request->get("type");
        $tags = array();
        if($querytag and $querytag != ''){
            $tags = explode(',', $querytag);
            if($queryrtag and $queryrtag != '') {
                unset($tags[$queryrtag]);
                $tags = array_merge(array_diff($tags, array($queryrtag)));
            }
        }
        if ($querystring and $querystring != "") {
            $search = $container->get('kunstmaan_search.search');
            $response = $search->search($querystring, $querytype, $tags);

            $context['hits'] = $response->hits;
            $context['q_query'] = $querystring;
            $context['q_tags'] = implode(',', $tags);
            $context['s_tags'] = $tags;
            $context['q_type'] = $querytype;
            $context['facets'] = $response->responseData['facets'];
        }
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array();
    }

    /*
     * return string
     */
    public function getDefaultView()
    {
        return "KadekeWebsiteBundle:Search\SearchPage:view.html.twig";
    }

    /**
     * @return boolean
     */
    public function shouldBeIndexed()
    {
        return false;
    }
}