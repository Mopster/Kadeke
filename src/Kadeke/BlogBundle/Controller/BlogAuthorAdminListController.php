<?php

namespace Kadeke\BlogBundle\Controller;

use Kadeke\BlogBundle\AdminList\BlogAuthorAdminListConfigurator;
use Kunstmaan\AdminListBundle\Controller\AdminListController;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AdminListConfiguratorInterface;

use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * The admin list controller for BlogAuthor
 */
class BlogAuthorAdminListController extends AdminListController
{

    /**
     * @var AdminListConfiguratorInterface
     */
    private $configurator;

    /**
     * @return AdminListConfiguratorInterface
     */
    public function getAdminListConfigurator()
    {
        if (!isset($this->configurator)) {
            $this->configurator = new BlogAuthorAdminListConfigurator($this->getDoctrine()->getManager());
        }
        return $this->configurator;
    }

    /**
     * The index action
     *
     * @Route("/", name="KadekeBlogBundle_admin_blogauthor")
     * @Template("KunstmaanAdminListBundle:Default:list.html.twig")
     */
    public function indexAction()
    {
        return parent::doIndexAction($this->getAdminListConfigurator());
    }

    /**
     * The add action
     *
     * @Route("/add", name="KadekeBlogBundle_admin_blogauthor_add")
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
     * @Route("/{id}", requirements={"id" = "\d+"}, name="KadekeBlogBundle_admin_blogauthor_edit")
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
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="KadekeBlogBundle_admin_blogauthor_delete")
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
     * @Route("/export.{_format}", requirements={"_format" = "csv"}, name="KadekeBlogBundle_admin_blogauthor_export")
     * @Method({"GET", "POST"})
     * @return array
     */
    public function exportAction($_format)
    {
        return parent::doExportAction($this->getAdminListConfigurator(), $_format);
    }

}
