<?php

namespace Kadeke\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kadeke\BlogBundle\Form\BlogCommentType;
use Kadeke\BlogBundle\Entity\BlogComment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogCommentController extends Controller
{

    /**
     * @Route("/blog/comment/new/{blogentry_id}", name="kadekeblogbundle_comment_new")
     * @Template("KadekeBlogBundle:BlogComment:form.html.twig")
     * @param $blogentry_id
     * @return array
     */
    public function newCommentAction($blogentry_id)
    {
        $em = $this->getDoctrine()->getManager();
        // Find the NodeTranslation for the BlogEntry, since that will be the parent of our comment
        $blogentry = $this->getBlogEntry($em, $blogentry_id);
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($blogentry);
        // Create a new Entity
        $comment = new BlogComment();
        $comment->setParent($nodetranslation);
        // Create the form based on the BlogCommentType
        $form = $this->createForm(new BlogCommentType(), $comment);

        return array(
            'comment' => $comment,
            'page' => $blogentry,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/blog/comment/create/{blogentry_id}", name="kadekeblogbundle_comment_create")
     * @param $blogentry_id
     * @return array
     */
    public function createCommentAction($blogentry_id)
    {
        $em = $this->getDoctrine()->getManager();
        // Find the NodeTranslation for the BlogEntry, since that will be the parent of our comment
        $blogentry = $this->getBlogEntry($em, $blogentry_id);
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($blogentry);
        // Create a new Entity
        $comment = new BlogComment();
        $comment->setParent($nodetranslation);
        $request = $this->getRequest();
        // Create the form based on the BlogCommentType
        $form = $this->createForm(new BlogCommentType(), $comment);
        // Has the Form been posted
        if ('POST' == $request->getMethod()) {
            $form->bind($request);
            // Check for validation error
            if ($form->isValid()) {
                // Persist the comment
                $em->persist($comment);
                $em->flush();

                // And redirect the user back to the blog entry
                return $this->redirect($this->get('router')->generate('_slug', array('url' => $nodetranslation->getUrl())). '#comment-' . $comment->getId());
            }
        }

        return $this->render('KadekeBlogBundle:BlogComment:create.html.twig', array(
            'comment' => $comment,
            'page' => $blogentry,
            'form'    => $form->createView()
        ));
    }

    /**
     * Get the BlogEntry for the given id
     *
     * @param $em
     * @param $blogentry_id
     *
     * @return mixed
     */
    public function getBlogEntry($em, $blogentry_id)
    {
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');

        return $blogEntryRepository->find($blogentry_id);
    }

}
