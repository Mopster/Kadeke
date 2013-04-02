<?php

namespace Kadeke\BlogBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use DoctrineExtensions\Taggable\Doctrine;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kadeke\BlogBundle\Form\BlogCommentType;
use Kunstmaan\TaggingBundle\Entity\Taggable;
use Symfony\Component\HttpFoundation\Request;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use Kadeke\WebsiteBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;
use Kadeke\BlogBundle\Form\BlogEntryAdminType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Kadeke\BlogBundle\Repository\BlogEntryRepository")
 * @ORM\Table(name="kd_blog_entries")
 * @ORM\HasLifecycleCallbacks
 */
class BlogEntry extends AbstractPage implements HasPagePartsInterface, Taggable
{

    /**
     * The blog entry's date, set automatically to 'now' before persisting when empty
     *
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @var BlogAuthor
     *
     * @ORM\ManyToOne(targetEntity="BlogAuthor")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    protected $tags;

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * The blog entry does not have any children
     *
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array();
    }

    public function getDefaultAdminType()
    {
        return new BlogEntryAdminType();
    }

    public function getDefaultView()
    {
        return "KadekeBlogBundle:BlogEntry:view.html.twig";
    }

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
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
        // Find the NodeTranslation for the BlogEntry, since that will be the parent of our comment
        $nodetranslation = $em->getRepository('KunstmaanNodeBundle:NodeTranslation')->getNodeTranslationFor($this);
        // Create a new Entity
        $comment = new BlogComment();
        $comment->setParent($nodetranslation);
        // Create the form based on the BlogCommentType
        $form = $container->get('form.factory')->create( new BlogCommentType(), $comment);
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
        $content['tags'] = $this->getTags();
    }


    /**
     * Returns the unique taggable resource type
     *
     * @return string
     */
    function getTaggableType()
    {
        return "blogentry";
    }

    /**
     * Returns the unique taggable resource identifier
     *
     * @return string
     */
    function getTaggableId()
    {
        return $this->getId();
    }

    /**
     * Returns the collection of tags for this Taggable entity
     *
     * @return Doctrine\Common\Collections\Collection
     */
    function getTags()
    {
        $this->tags = $this->tags ?: new ArrayCollection();
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}
