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
     * @param     $_locale
     * @param int $limit How much blog entries to return
     *
     * @return array
     */
    public function getMostRecentBlogEntries($_locale, $limit)
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
        $query .= " AND";
        $query .= " nt.lang = ? ";
        $query .= " ORDER BY entry.date DESC";
        $query .= " limit ?";

        $q = $this->_em->createNativeQuery($query, $rsm);
        $q->setParameter(1, $_locale);
        $q->setParameter(2, $limit);

        return $q->getResult();
    }

    /**
     * @param $_locale
     *
     * @return array
     */
    public function getBlogEntries($_locale)
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
        $query .= " AND";
        $query .= " nt.lang = ? ";
        $query .= " ORDER BY entry.date DESC";

        $q = $this->_em->createNativeQuery($query, $rsm);
        $q->setParameter(1, $_locale);

        return $q->getResult();
    }

    /**
     * Returns an array of all BlogEntries
     *
     * @param          $_locale
     * @param datetime $date Date to get the blog entries from
     *
     * @return array
     */
    public function getArticles($_locale, $date = null)
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
        $query .= " AND";
        $query .= " nt.lang = ? ";
        if ($date) {
            $query .= " AND";
            $query .= " article.date > ?";
            $query .= " AND";
            $query .= " article.date < ?";
        }
        $query .= " ORDER BY article.date DESC";

        $q = $this->_em->createNativeQuery($query, $rsm);
        $q->setParameter(1, $_locale);
        $q->setParameter(2, $date . " 00:00:00");
        $q->setParameter(3, $date . " 23:59:59");

        return $q->getResult();
    }

    /**
     * @param $_locale
     * @param $date
     * @param $offset
     *
     * @return array
     */
    public function getNextArticleDate($_locale, $date, $offset)
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
        $query .= " AND";
        $query .= " nt.lang = ? ";
        if ($date) {
            $query .= " AND";
            $query .= " article.date < ?";
        }
        $query .= " GROUP BY DateOnly";
        $query .= " ORDER BY DateOnly DESC";
        $query .= " limit 1 offset ?";

        $q = $this->_em->createNativeQuery($query, $rsm);
        $q->setParameter(1, $_locale);
        if ($date) {
            $q->setParameter(2, $date . " 00:00:00");
            $q->setParameter(3, $offset);
        } else {
            $q->setParameter(2, $offset);
        }

        return $q->getResult();
    }
}