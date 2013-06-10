<?php
namespace Kadeke\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class BlogEntryController extends Controller
{

    /**
     * @Route("/blog/latest/{limit}", name="kadekeblogbundle_mostrecentblogentries")
     * @Template("KadekeBlogBundle:Blog:home-teaser.html.twig")
     *
     * @param     $_locale
     * @param int $limit
     *
     * @return array
     */
    public function getMostRecentBlogEntriesAction($_locale, $limit)
    {
        $limit = (int) $limit;
        $em = $this->getDoctrine()->getManager();
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');
        $blogentries = $blogEntryRepository->getMostRecentBlogEntries($_locale, $limit);

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

    /**
     * @Route("/blog/infinite", name="kadekeblogbundle_infinite_articles")
     * @Template("KadekeBlogBundle:BlogOverviewPage:content.html.twig")
     *
     * @param  Request $request
     * @return array
     */
    public function infiniteAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('KadekeBlogBundle:BlogEntry');
        $now = date('Y-m-d');
        $page = $request->get('page');
        if (!$page) {
            $nextArticle = $repository->getNextArticleDate(null, 0);
        } else {
            $nextArticle = $repository->getNextArticleDate($now, $page - 1);
        }
        if (count($nextArticle) > 0) {
            $pagedate = $nextArticle[0]->getDate();
            $day = $pagedate->format('Y-m-d');
            $articles = $repository->getArticles($day);
            $next = date('Y-m-d', strtotime($day . ' - 1 day'));

            return array(
                'articles' => $articles,
                'day' => $pagedate,
                'next' => $next
            );
        }

        return array();
    }

}
