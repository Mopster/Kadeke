<?php

namespace Kadeke\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kadeke\BlogBundle\Form\BlogAuthorAdminType;
use Kunstmaan\AdminBundle\Entity\AbstractEntity;

/**
 * The author for a blog entry
 *
 * @ORM\Entity(repositoryClass="Kadeke\BlogBundle\Repository\BlogAuthorRepository")
 * @ORM\Table(name="kd_blog_authors")
 */
class BlogAuthor extends AbstractEntity
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, name="name")
     */
    protected $name;


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getDefaultAdminType()
    {
        return new BlogAuthorAdminType();
    }
}