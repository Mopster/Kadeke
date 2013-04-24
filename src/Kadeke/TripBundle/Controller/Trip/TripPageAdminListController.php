<?php

namespace Kadeke\TripBundle\Controller\Trip;

use Kadeke\TripBundle\AdminList\Trip\TripPageAdminListConfigurator;
use Kunstmaan\AdminBundle\Helper\Security\Acl\Permission\PermissionMap;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AdminListConfiguratorInterface;
use Kunstmaan\ArticleBundle\Controller\AbstractArticlePageAdminListController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * The AdminList controller for the TripPage
 */
class TripPageAdminListController extends AbstractArticlePageAdminListController
{

    /**
     * @return AdminListConfiguratorInterface
     */
    public function getAdminListConfigurator()
    {
        $this->initAdminListConfigurator();
        if (!isset($this->configurator)) {
            $this->configurator = new TripPageAdminListConfigurator($this->em, $this->aclHelper, $this->locale, PermissionMap::PERMISSION_EDIT);
        }

        return $this->configurator;
    }

    /**
     * The index action
     *
     * @Route("/", name="KadekeTripBundle_admin_trippage")
     * @Template("KunstmaanAdminListBundle:Default:list.html.twig")
     */
    public function indexAction()
    {
        return parent::doIndexAction($this->getAdminListConfigurator());
    }

    /**
     * The add action
     *
     * @Route("/add", name="KadekeTripBundle_admin_trippage_add")
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
     * @Route("/{id}", requirements={"id" = "\d+"}, name="KadekeTripBundle_admin_trippage_edit")
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
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="KadekeTripBundle_admin_trippage_delete")
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
     * @Route("/export.{_format}", requirements={"_format" = "csv"}, name="KadekeTripBundle_admin_trippage_export")
     * @Method({"GET", "POST"})
     *
     * @return array
     */
    public function exportAction($_format)
    {
        return parent::doExportAction($this->getAdminListConfigurator(), $_format);
    }

}
