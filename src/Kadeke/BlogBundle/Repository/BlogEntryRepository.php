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

    /**
     * Returns an array of all BlogEntries
     *
     * @param datetime $date Date to get the blog entries from
     *
     * @return array
     */
    public function getArticles($date = null)
    {
        $rsm = new ResultSetMappingBuilder($this->_em);
        $rsm->addRootEntityFromClassMetadata('Kadeke\BlogBundle\Entity\BlogEntry', 'qp');

        $query = "SELECT";
        $query .= " article.*";
        $query .= " FROM";
        $query .= " kd_blog_entries as article";
        $query .= " INNER JOIN";
        $query .= " kuma_node_versions nv ON nv.ref_id = article.id";
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
        if ($date) {
            $query .= " AND";
            $query .= " article.date > ?";
            $query .= " AND";
            $query .= " article.date < ?";
        }
        $query .= " ORDER BY article.date DESC";

        $q = $this->_em->createNativeQuery($query, $rsm);
        $q->setParameter(1, $date . " 00:00:00");
        $q->setParameter(2, $date . " 23:59:59");

        return $q->getResult();
    }

    public function getNextArticleDate($date, $offset)
    {
        $rsm = new ResultSetMappingBuilder($this->_em);
        $rsm->addRootEntityFromClassMetadata('Kadeke\BlogBundle\Entity\BlogEntry', 'qp');

        $query = "SELECT";
        $query .= " article.*, DATE(article.date) DateOnly";
        $query .= " FROM";
        $query .= " kd_blog_entries as article";
        $query .= " INNER JOIN";
        $query .= " kuma_node_versions nv ON nv.ref_id = article.id";
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
        if ($date) {
            $query .= " AND";
            $query .= " article.date < ?";
        }
        $query .= " GROUP BY DateOnly";
        $query .= " ORDER BY DateOnly DESC";
        $query .= " limit 1 offset ?";

        $q = $this->_em->createNativeQuery($query, $rsm);
        if ($date) {
            $q->setParameter(1, $date . " 00:00:00");
            $q->setParameter(2, $offset);
        } else {
            $q->setParameter(1, $offset);
        }

        return $q->getResult();
    }
}