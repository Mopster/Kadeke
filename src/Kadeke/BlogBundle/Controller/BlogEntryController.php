<?php
namespace Kadeke\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogEntryController extends Controller
{

    /**
     * @Route("/blog/latest/{limit}", name="kadekeblogbundle_mostrecentblogentries")
     * @Template("KadekeBlogBundle:Blog:home-teaser.html.twig")
     * @param int $limit
     *
     * @return array
     */
    public function getMostRecentBlogEntriesAction($limit)
    {
        $limit = (int) $limit;
        $em = $this->getDoctrine()->getManager();
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');
        $blogentries = $blogEntryRepository->getMostRecentBlogEntries($limit);

        $nodeTranslationRepository = $em->getRepository('KunstmaanNodeBundle:NodeTranslation');
        $blognodes = array();
        foreach ($blogentries as $entry){
            $blognodes[] = array('nodetranslation' => $nodeTranslationRepository->getNodeTranslationFor($entry), 'page' => $entry);
        }

        return array('blogentries' => $blognodes);
    }

    /**
     * Find the comments of the BlogEntry and render the comments template of the BlogEntry
     *
     * @Route("/blog/comments/{blogEntry}", name="kadekeblogbundle_comments")
     * @Template("KadekeBlogBundle:BlogEntry:comments.html.twig")
     * @param $blogEntry int
     *
     * @return array
     */
    public function getCommentsAction($blogEntry)
    {
        $em = $this->getDoctrine()->getManager();
        $blogCommentRepository = $em->getRepository('KadekeBlogBundle:BlogComment');
        $comments = $blogCommentRepository->findByBlogEntry($blogEntry);

        return array('comments' => $comments);
    }

}
