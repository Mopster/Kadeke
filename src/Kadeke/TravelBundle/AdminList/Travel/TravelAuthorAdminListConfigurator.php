<?php

namespace Kadeke\TravelBundle\AdminList\Travel;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticleAuthorAdminListConfigurator;

/**
 * The AdminList configurator for the TravelAuthor
 */
class TravelAuthorAdminListConfigurator extends AbstractArticleAuthorAdminListConfigurator
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
        return "Travel\TravelAuthor";
    }

}
