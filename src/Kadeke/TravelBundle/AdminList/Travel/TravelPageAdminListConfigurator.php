<?php

namespace Kadeke\TravelBundle\AdminList\Travel;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticlePageAdminListConfigurator;
use Kadeke\TravelBundle\Entity\Travel\TravelOverviewPage;

/**
 * The AdminList configurator for the TravelPage
 */
class TravelPageAdminListConfigurator extends AbstractArticlePageAdminListConfigurator
{

    /**
     * Return current bundle name.
     *
     * @return string
     */
    public function getBundleName()
    {
        return "KadekeTravelBundle";
    }

    /**
     * Return current entity name.
     *
     * @return string
     */
    public function getEntityName()
    {
        return "Travel\TravelPage";
    }

    /**
     * @param QueryBuilder $queryBuilder The query builder
     */
    public function adaptQueryBuilder(QueryBuilder $queryBuilder)
    {
        parent::adaptQueryBuilder($queryBuilder);

        $queryBuilder->setParameter('class', 'Kadeke\TravelBundle\Entity\Travel\TravelPage');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getOverviewPageRepository()
    {
        return $this->em->getRepository('KadekeTravelBundle:Travel\TravelOverviewPage');
    }

    /**
     * @return string
     */
    public function getListTemplate()
    {
        return 'KadekeTravelBundle:AdminList/Travel/TravelPageAdminList:list.html.twig';
    }

}
