<?php

namespace Kadeke\BlogBundle\Entity;

use Kadeke\WebsiteBundle\Entity\ContentPage;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kd_blog_entries")
 * @ORM\HasLifecycleCallbacks()
 */
class BlogEntry extends ContentPage
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
     * @ORM\JoinColumn(name="blogauthor_id", referencedColumnName="id")
     */
    protected $author;

    public function setDate($date)
    {
        $this->date;
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
            $this->setDate(new \DateTime('now'));
        }
    }
}
