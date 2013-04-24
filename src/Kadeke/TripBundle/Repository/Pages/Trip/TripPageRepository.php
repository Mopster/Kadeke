<?php

namespace Kadeke\TripBundle\Repository\Pages\Trip;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Kunstmaan\ArticleBundle\Repository\AbstractArticlePageRepository;

/**
 * Repository class for the TripPage
 */
class TripPageRepository extends AbstractArticlePageRepository
{
    /**
     * Returns an array of all TripPages
     *
     * @return array
     */
    public function getArticles()
    {
        $rsm = new ResultSetMappingBuilder($this->_em);
        $rsm->addRootEntityFromClassMetadata('Kadeke\TripBundle\Entity\Pages\Trip\TripPage', 'qp');

        $query = "SELECT";
        $query .= " article.*";
        $query .= " FROM";
        $query .= " kd_trippages as article";
        $query .= " INNER JOIN";
        $query .= " kuma_node_versions nv ON nv.ref_id = article.id";
        $query .= " INNER JOIN";
        $query .= " kuma_node_translations nt ON nt.public_node_version_id = nv.id and nt.id = nv.node_translation_id";
        $query .= " INNER JOIN";
        $query .= " kuma_nodes n ON n.id = nt.node_id";
        $query .= " WHERE";
        $query .= " n.deleted = 0";
        $query .= " AND";
        $query .= " n.ref_entity_name = 'Kadeke\\\\TripBundle\\\\Entity\\\\Pages\\\\Trip\\\\TripPage'";
        $query .= " AND";
        $query .= " nt.online = 1 ";
        //$query .= " ORDER BY article.date DESC";

        $q = $this->_em->createNativeQuery($query, $rsm);

        return $q->getResult();
    }

}
