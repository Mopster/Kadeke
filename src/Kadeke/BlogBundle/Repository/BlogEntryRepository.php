<?php

namespace Kadeke\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class BlogEntryRepository extends EntityRepository
{
    /**
     * @var QueryBuilder
     */
    public $qb;

    /**
     * Retrieve the most recent blog entries
     *
     * @param int $limit How much blog entries to return
     *
     * @return array
     */
    public function getMostRecentBlogEntries($limit)
    {
        $rsm = new ResultSetMappingBuilder($this->_em);
        $rsm->addRootEntityFromClassMetadata('Kadeke\BlogBundle\Entity\BlogEntry', 'qp');

        $query = "SELECT";
        $query .= " entry.*";
        $query .= " FROM";
        $query .= " kd_blog_entries entry";
        $query .= " INNER JOIN";
        $query .= " kuma_node_versions nv ON nv.ref_id = entry.id";
        $query .= " INNER JOIN";
        $query .= " kuma_node_translations nt ON nt.public_node_version_id = nv.id and nt.id = nv.node_translation_id";
        $query .= " INNER JOIN";
        $query .= " kuma_nodes n ON n.id = nt.node_id";
        $query .= " WHERE";
        $query .= " n.deleted = 0";
        $query .= " AND";
        $query .= " n.ref_entity_name = 'Kadeke\\\\BlogBundle\\\\Entity\\\\BlogEntry'";
        $query .= " AND";
        $query .= " nt.online = 1 ";
        $query .= " ORDER BY entry.date DESC";
        $query .= " limit " . $limit;

        $q = $this->_em->createNativeQuery($query, $rsm);

        return $q->getResult();
    }

    public function getBlogEntries()
    {
        $rsm = new ResultSetMappingBuilder($this->_em);
        $rsm->addRootEntityFromClassMetadata('Kadeke\BlogBundle\Entity\BlogEntry', 'qp');

        $query = "SELECT";
        $query .= " entry.*";
        $query .= " FROM";
        $query .= " kd_blog_entries entry";
        $query .= " INNER JOIN";
        $query .= " kuma_node_versions nv ON nv.ref_id = entry.id";
        $query .= " INNER JOIN";
        $query .= " kuma_node_translations nt ON nt.public_node_version_id = nv.id and nt.id = nv.node_translation_id";
        $query .= " INNER JOIN";
        $query .= " kuma_nodes n ON n.id = nt.node_id";
        $query .= " WHERE";
        $query .= " n.deleted = 0";
        $query .= " AND";
        $query .= " n.ref_entity_name = 'Kadeke\\\\BlogBundle\\\\Entity\\\\BlogEntry'";
        $query .= " AND";
        $query .= " nt.online = 1 ";
        $query .= " ORDER BY entry.date DESC";

        $q = $this->_em->createNativeQuery($query, $rsm);

        return $q->getResult();
    }
}