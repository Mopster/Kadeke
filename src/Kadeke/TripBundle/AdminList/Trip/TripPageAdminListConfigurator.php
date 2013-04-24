<?php

namespace Kadeke\TripBundle\AdminList\Trip;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticlePageAdminListConfigurator;
use Kadeke\TripBundle\Entity\Pages\Trip\TripOverviewPage;

/**
 * The AdminList configurator for the TripPage
 */
class TripPageAdminListConfigurator extends AbstractArticlePageAdminListConfigurator
{

    /**
     * Return current bundle name.
     *
     * @return string
     */
    public function getBundleName()
    {
        return "KadekeTripBundle";
    }

    /**
     * Return current entity name.
     *
     * @return string
     */
    public function getEntityName()
    {
        return "TripPage";
    }

    /**
     * @param QueryBuilder $queryBuilder The query builder
     */
    public function adaptQueryBuilder(QueryBuilder $queryBuilder)
    {
        parent::adaptQueryBuilder($queryBuilder);

        $queryBuilder->setParameter('class', 'Kadeke\TripBundle\Entity\Pages\Trip\TripPage');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getOverviewPageRepository()
    {
        $repository = $this->em->getRepository('KadekeTripBundle:Pages\Trip\TripOverviewPage');
        return $repository;
    }

    /**
     * @return string
     */
    public function getListTemplate()
{
    return 'KadekeTripBundle:AdminList/TripPageAdminList:list.html.twig';
}

}
