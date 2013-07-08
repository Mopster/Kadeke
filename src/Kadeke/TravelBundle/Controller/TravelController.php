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

    /**
     * Find the comments of the TravelComment and render the comments template of the TravelPage
     *
     * @Route("/travel/comments/{travelPage}", name="kadeketravelbundle_comments")
     * @Template("KadekeTravelBundle:Travel/TravelPage:comments.html.twig")
     * @param $travelPage int
     *
     * @return array
     */
    public function getCommentsAction($travelPage)
    {
        $em = $this->getDoctrine()->getManager();
        $travelCommentRepository = $em->getRepository('KadekeTravelBundle:Travel\TravelComment');
        $comments = $travelCommentRepository->findByTravelPage($travelPage);

        return array('comments' => $comments);
    }

}
