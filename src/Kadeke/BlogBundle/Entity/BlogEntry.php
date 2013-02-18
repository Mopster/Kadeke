<?php

namespace Kadeke\BlogBundle\Entity;

use Kadeke\WebsiteBundle\Entity\AbstractContentPage;
use Kadeke\BlogBundle\Form\BlogEntryAdminType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="kd_blog_entries")
 * @ORM\HasLifecycleCallbacks
 */
class BlogEntry extends AbstractContentPage
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
}