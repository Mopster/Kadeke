<?php
namespace Kadeke\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogEntryController extends Controller
{

    /**
     * @param int $limit
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMostRecentBlogEntriesAction($limit = 3)
    {
        $em = $this->getDoctrine()->getManager();
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');
        $blogentries = $blogEntryRepository->getMostRecentBlogEntries($limit);

        return $this->render('KadekeBlogBundle:Blog:home-teaser.html.twig',
            array('blogentries' => $blogentries)
        );
    }

}
