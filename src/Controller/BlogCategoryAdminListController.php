<?php

namespace App\Controller;

use App\AdminList\BlogCategoryAdminListConfigurator;
use Kunstmaan\ArticleBundle\Controller\AbstractArticleCategoryAdminListController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/{_locale}/%kunstmaan_admin.admin_prefix%/blog-category", requirements={"_locale"="%requiredlocales%"})
 */
class BlogCategoryAdminListController extends AbstractArticleCategoryAdminListController
{
    /**
     * @Route("/", name="app_admin_blogcategory")
     */
    public function indexAction(Request $request): Response
    {
        return parent::doIndexAction($this->getAdminListConfigurator($request), $request);
    }

    /**
     * @Route("/add", name="app_admin_blogcategory_add", methods={"GET", "POST"})
     */
    public function addAction(Request $request): Response
    {
        return parent::doAddAction($this->getAdminListConfigurator($request), null, $request);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="app_admin_blogcategory_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, int $id): Response
    {
        return parent::doEditAction($this->getAdminListConfigurator($request), $id, $request);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="app_admin_blogcategory_view", methods={"GET"})
     */
    public function viewAction(Request $request, int $id): Response
    {
        return parent::doViewAction($this->getAdminListConfigurator($request), $id, $request);
    }

    /**
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="app_admin_blogcategory_delete", methods={"GET", "POST"})
     */
    public function deleteAction(Request $request, int $id): Response
    {
        return parent::doDeleteAction($this->getAdminListConfigurator($request), $id, $request);
    }

    /**
     * @Route("/export.{_format}", requirements={"_format" = "csv|xlsx|ods"}, name="app_admin_blogcategory_export", methods={"GET", "POST"})
     */
    public function exportAction(Request $request, string $_format): Response
    {
        return parent::doExportAction($this->getAdminListConfigurator($request), $_format, $request);
    }

    /**
     * @Route("/{id}/move-up", requirements={"id" = "\d+"}, name="app_admin_blogcategory_move_up", methods={"GET"})
     */
    public function moveUpAction(Request $request, int $id): Response
    {
        return parent::doMoveUpAction($this->getAdminListConfigurator($request), $id, $request);
    }

    /**
     * @Route("/{id}/move-down", requirements={"id" = "\d+"}, name="app_admin_blogcategory_move_down", methods={"GET"})
     */
    public function moveDownAction(Request $request, int $id): Response
    {
        return parent::doMoveDownAction($this->getAdminListConfigurator($request), $id, $request);
    }

    public function createAdminListConfigurator(): BlogCategoryAdminListConfigurator
    {
        return new BlogCategoryAdminListConfigurator($this->em, $this->aclHelper);
    }
}
