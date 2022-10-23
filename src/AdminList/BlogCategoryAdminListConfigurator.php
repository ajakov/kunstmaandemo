<?php

namespace App\AdminList;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\BlogCategoryAdminType;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticleCategoryAdminListConfigurator;

class BlogCategoryAdminListConfigurator extends AbstractArticleCategoryAdminListConfigurator
{
    public function __construct(EntityManagerInterface $em, AclHelper $aclHelper)
    {
        parent::__construct($em, $aclHelper);
        $this->setAdminType(BlogCategoryAdminType::class);
    }

    public function getBundleName(): string
    {
        return 'App';
    }

    public function getEntityName(): string
    {
        return 'BlogCategory';
    }
}
