<?php

namespace Kadeke\TravelBundle\Controller\Travel;

use Kadeke\TravelBundle\AdminList\Travel\TravelAuthorAdminListConfigurator;
use Kunstmaan\AdminBundle\Helper\Security\Acl\Permission\PermissionMap;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AdminListConfiguratorInterface;
use Kunstmaan\ArticleBundle\Controller\AbstractArticleAuthorAdminListController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * The AdminList controller for the TravelAuthor
 */
class TravelAuthorAdminListController extends AbstractArticleAuthorAdminListController
{

    /**
     * @return AdminListConfiguratorInterface
     */
    public function createAdminListConfigurator()
    {
        return new TravelAuthorAdminListConfigurator($this->em, $this->aclHelper, $this->locale, PermissionMap::PERMISSION_EDIT);
    }

    /**
     * The index action
     *
     * @Route("/", name="KadekeTravelBundle_admin_travel_travelauthor")
     * @Template("KunstmaanAdminListBundle:Default:list.html.twig")
     */
    public function indexAction()
    {
        return parent::doIndexAction($this->getAdminListConfigurator());
    }

    /**
     * The add action
     *
     * @Route("/add", name="KadekeTravelBundle_admin_travel_travelauthor_add")
     * @Method({"GET", "POST"})
     * @Template("KunstmaanAdminListBundle:Default:add.html.twig")
     * @return array
     */
    public function addAction()
    {
        return parent::doAddAction($this->getAdminListConfigurator());
    }

    /**
     * The edit action
     *
     * @param int $id
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="KadekeTravelBundle_admin_travel_travelauthor_edit")
     * @Method({"GET", "POST"})
     * @Template("KunstmaanAdminListBundle:Default:edit.html.twig")
     *
     * @return array
     */
    public function editAction($id)
    {
        return parent::doEditAction($this->getAdminListConfigurator(), $id);
    }

    /**
     * The delete action
     *
     * @param int $id
     *
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="KadekeTravelBundle_admin_travel_travelauthor_delete")
     * @Method({"GET", "POST"})
     * @Template("KunstmaanAdminListBundle:Default:delete.html.twig")
     *
     * @return array
     */
    public function deleteAction($id)
    {
        return parent::doDeleteAction($this->getAdminListConfigurator(), $id);
    }

    /**
     * Export action
     *
     * @param $_format
     *
     * @Route("/export.{_format}", requirements={"_format" = "csv"}, name="KadekeTravelBundle_admin_travel_travelauthor_export")
     * @Method({"GET", "POST"})
     *
     * @return array
     */
    public function exportAction($_format)
    {
        return parent::doExportAction($this->getAdminListConfigurator(), $_format);
    }

}
