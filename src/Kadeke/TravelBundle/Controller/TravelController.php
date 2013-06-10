<?php
namespace Kadeke\TravelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TravelController extends Controller
{

    /**
     * @Route("/travel/latest/{limit}", name="kadeketravelbundle_mostrecent")
     * @Template("KadekeTravelBundle:Travel/TravelOverviewPage:home-teaser.html.twig")
     *
     * @param     $request
     * @param int $limit
     *
     * @return array
     */
    public function getMostRecentAction(Request $request, $limit)
    {
        $_locale = $request->get('_locale');
        $limit = (int) $limit;
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('KadekeTravelBundle:Travel\TravelPage');
        $pages = $repository->getArticles($_locale, 0, $limit);

        $nodeTranslationRepository = $em->getRepository('KunstmaanNodeBundle:NodeTranslation');
        $nodes = array();
        foreach ($pages as $entry){
            $nodes[] = array('nodetranslation' => $nodeTranslationRepository->getNodeTranslationFor($entry), 'page' => $entry);
        }

        return array('travelpages' => $nodes);
    }

}
