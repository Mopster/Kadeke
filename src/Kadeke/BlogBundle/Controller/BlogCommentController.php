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
        $blogentry = $this->getBlogEntry($em, $blogentry_id);
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($blogentry);

        $comment = new BlogComment();
        $comment->setParent($nodetranslation);

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
        $blogentry = $this->getBlogEntry($em, $blogentry_id);
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($blogentry);

        $comment  = new BlogComment();
        $comment->setParent($nodetranslation);
        $request = $this->getRequest();
        $form = $this->createForm(new BlogCommentType(), $comment);

        if ('POST' == $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($comment);
                $em->flush();

                return $this->redirect($this->get('router')->generate('_slug', array('url' => $nodetranslation->getUrl())). '#comment-' . $comment->getId());
            }
        }

        return $this->render('KadekeBlogBundle:BlogComment:create.html.twig', array(
            'comment' => $comment,
            'page' => $blogentry,
            'form'    => $form->createView()
        ));
    }

    public function getBlogEntry($em, $blogentry_id)
    {
        $blogEntryRepository = $em->getRepository('KadekeBlogBundle:BlogEntry');

        return $blogEntryRepository->find($blogentry_id);
    }

}
