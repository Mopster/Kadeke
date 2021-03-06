<?php

namespace Kadeke\TravelBundle\AdminList\Travel;

use Doctrine\ORM\EntityManager;

use Kadeke\TravelBundle\Form\Travel\TravelCommentAdminType;
use Kunstmaan\AdminListBundle\AdminList\FilterType\ORM;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AbstractDoctrineORMAdminListConfigurator;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;

/**
 * The admin list configurator for TravelComment
 */
class TravelCommentAdminListConfigurator extends AbstractDoctrineORMAdminListConfigurator
{

    /**
     * @param EntityManager $em        The entity manager
     * @param AclHelper     $aclHelper The acl helper
     */
    public function __construct(EntityManager $em, AclHelper $aclHelper = null)
    {
        parent::__construct($em, $aclHelper);
        $this->setAdminType(new TravelCommentAdminType());
    }

    /**
     * Configure the visible columns
     */
    public function buildFields()
    {
        $this->addField('title', 'title', true);
        $this->addField('text', 'text', true);
        $this->addField('name', 'name', true);
        $this->addField('email', 'email', true);
        $this->addField('website', 'website', true);
        $this->addField('created', 'created', true);
    }

    /**
     * Build filters for admin list
     */
    public function buildFilters()
    {
        $this->addFilter('title', new ORM\StringFilterType('title'), 'Title');
        $this->addFilter('text', new ORM\StringFilterType('text'), 'Text');
        $this->addFilter('name', new ORM\StringFilterType('name'), 'Name');
        $this->addFilter('email', new ORM\StringFilterType('email'), 'Email');
        $this->addFilter('website', new ORM\StringFilterType('website'), 'Website');
        $this->addFilter('created', new ORM\DateFilterType('created'), 'Created');
    }

    /**
     * Get bundle name
     *
     * @return string
     */
    public function getBundleName()
    {
        return 'KadekeTravelBundle';
    }

    /**
     * Get entity name
     *
     * @return string
     */
    public function getEntityName()
    {
        return 'Travel\TravelComment';
    }

    public function canAdd()
    {
        return false;
    }


}