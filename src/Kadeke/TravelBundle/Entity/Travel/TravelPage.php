<?php

namespace Kadeke\TravelBundle\Entity\Travel;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\TravelBundle\Form\Travel\TravelCommentType;
use Kunstmaan\ArticleBundle\Entity\AbstractArticlePage;
use Kadeke\TravelBundle\Entity\Travel\TravelAuthor;
use Kadeke\TravelBundle\Form\Travel\TravelPageAdminType;
use Kadeke\TravelBundle\PagePartAdmin\Travel\TravelPagePagePartAdminConfigurator;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity(repositoryClass="Kadeke\TravelBundle\Repository\Travel\TravelPageRepository")
 * @ORM\Table(name="kd_travelpages")
 * @ORM\HasLifecycleCallbacks
 */
class TravelPage extends AbstractArticlePage
{

    /**
     * @var TravelAuthor
     *
     * @ORM\ManyToOne(targetEntity="TravelAuthor")
     * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new TravelPageAdminType();
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new TravelPagePagePartAdminConfigurator());
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDefaultView()
    {
        return "KadekeTravelBundle:Travel/TravelPage:view.html.twig";
    }

    /**
     * Before persisting this entity, check the date.
     * When no date is present, fill in current date and time.
     *
     * @ORM\PrePersist
     */
    public function _prePersist()
    {
        // Set date to now when none is set
        if ($this->date == null) {
            $this->setDate(new \DateTime());
        }
    }
    
    public function service(ContainerInterface $container, Request $request, RenderContext $context)
    {
        parent::service($container, $request, $context);
        $em = $container->get('doctrine')->getManager();
        // Find the NodeTranslation for the TravelPage, since that will be the parent of our comment
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($this);
        // Create a new Entity
        $comment = new TravelComment();
        $comment->setParent($nodetranslation);
        // Create the form based on the TravelCommentType
        $form = $container->get('form.factory')->create( new TravelCommentType(), $comment);
        // Has the Form been posted
        if ('POST' == $request->getMethod()) {
            $form->bind($request);
            // Check for validation error
            if ($form->isValid()) {
                // Persist the comment
                $em->persist($comment);
                $em->flush();
                $context['success'] = true;
                return;
            }
        }
        $context['form'] = $form->createView();
        $context['comment'] = $comment;
    }   
}
